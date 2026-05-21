<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\NotificationAdmin;
use App\Notifications\NouveauDevisNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DevisController extends Controller
{
    // Tarifs de base
    const TARIFS_MASTER = [
        'choix_sujet'    => 5000,
        'problematique'  => 8000,
        'plan'           => 5000,
        'methodologie'   => 10000,
        'introduction'   => 25000,
        'partie1'        => 50000,
        'partie2'        => 50000,
        'conclusion'     => 10000,
        'complet'        => 100000,
    ];

    const TARIFS_LICENCE = [
        'choix_sujet'    => 3000,
        'problematique'  => 5000,
        'plan'           => 3000,
        'methodologie'   => 7000,
        'introduction'   => 15000,
        'partie1'        => 30000,
        'partie2'        => 30000,
        'conclusion'     => 7000,
        'complet'        => 60000,
    ];

    const MODIFICATEURS_DELAI = [
        '30j'            => 1.25,
        'Quatre(4) mois' => 1.00,
        'Plus de 4 mois' => 0.90,
    ];

    const OPTIONS = [
        'powerpoint'     => 5000,
        'correction'     => 15000,
        'cv_lettre'      => 5000,
        'accompagnement' => 5000,
    ];

    public function index()
    {
        $paysOhada = $this->listePays();
        return view('pages.devis', compact('paysOhada'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prenom'       => 'required|string|max:100',
            'nom'          => 'required|string|max:100',
            'email'        => 'required|email',
            'telephone'    => 'required|string|max:30',
            'ville'        => 'nullable|string|max:100',
            'pays'         => 'nullable|string|max:100',
            'etablissement'=> 'nullable|string|max:200',
            'categorie'    => 'required|in:Mémoire,Rédaction,Correction,Accompagnement,Visuel',
            'niveau'       => 'nullable|in:Master,Licence',
            'parties'      => 'nullable|array',
            'filiere'      => 'nullable|string|max:200',
            'sujet'        => 'required|string|max:500',
            'date_soutenance' => 'nullable|date',
            'instructions' => 'nullable|string|max:2000',
            'delai'        => 'required|in:30j,Quatre(4) mois,Plus de 4 mois',
            'options'      => 'nullable|array',
            'mode_paiement'=> 'nullable|string|max:50',
            'fichier'      => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'envoi_type'   => 'nullable|in:whatsapp,email',
        ]);

        // Calcul du montant
        $montant     = $this->calculerMontant($data);
        $fichierPath = null;

        if ($request->hasFile('fichier')) {
            $uuid        = Str::uuid();
            $ext         = $request->file('fichier')->getClientOriginalExtension();
            $fichierPath = "private/devis/{$uuid}.{$ext}";
            Storage::put($fichierPath, file_get_contents($request->file('fichier')));
        }

        // Créer la commande (statut = nouveau)
        $commande = Commande::create([
            'user_id'              => auth()->id(),
            'client_prenom'        => $data['prenom'],
            'client_nom'           => $data['nom'],
            'client_email'          => $data['email'],
            'client_telephone'     => $data['telephone'],
            'client_pays'          => $data['pays'],
            'client_ville'         => $data['ville'],
            'client_etablissement' => $data['etablissement'],
            'envoi_type'           => $data['envoi_type'] ?? 'whatsapp',
            'service'              => $data['categorie'],
            'niveau'               => $data['niveau'] ?? null,
            'parties'              => $data['parties'] ?? [],
            'filiere'              => $data['filiere'] ?? null,
            'sujet'                => $data['sujet'],
            'instructions'         => $data['instructions'] ?? null,
            'date_soutenance'      => $data['date_soutenance'] ?? null,
            'delai'                => $data['delai'],
            'options'              => $data['options'] ?? [],
            'montant'              => $montant,
            'mode_paiement'        => $data['mode_paiement'] ?? null,
            'fichier_client'       => $fichierPath,
            'statut'               => 'nouveau',
        ]);

        // Notifications admin
        NotificationAdmin::creer(
            'devis',
            'Nouveau devis soumis',
            "{$data['prenom']} {$data['nom']} — {$data['categorie']} — " . number_format($montant, 0, ',', ' ') . ' FCFA',
            route('admin.commandes.show', $commande)
        );

        Notification::route('mail', config('app.admin_email', 'academie.redactionohada@gmail.com'))
            ->notify(new NouveauDevisNotification($commande, $data));

        // Notification client (Toujours par mail)
        Notification::route('mail', $data['email'])
            ->notify(new \App\Notifications\ConfirmationDevisClient($commande));

        // Rediriger selon le mode choisi
        if (($data['envoi_type'] ?? 'whatsapp') === 'whatsapp') {
            $waUrl = $this->genererWhatsApp($data, $montant, $commande->reference);
            return redirect()->away($waUrl);
        }

        return redirect()->route('accueil')->with('success', 'Votre demande de devis a été envoyée avec succès par email. Nous vous répondrons sous 2h.');
    }

    private function calculerMontant(array $data): int
    {
        $base  = 0;
        $tarifs = $data['niveau'] === 'Master' ? self::TARIFS_MASTER : self::TARIFS_LICENCE;

        if ($data['categorie'] === 'Mémoire' && !empty($data['parties'])) {
            $isComplet = in_array('complet', $data['parties']);
            foreach ($data['parties'] as $partie) {
                if ($partie === 'choix_sujet' && $isComplet) continue; // Offert si complet
                $base += $tarifs[$partie] ?? 0;
            }
        }

        // Options
        foreach (($data['options'] ?? []) as $opt) {
            $base += self::OPTIONS[$opt] ?? 0;
        }

        // Modificateur délai
        $coeff = self::MODIFICATEURS_DELAI[$data['delai']] ?? 1;
        return (int) round($base * $coeff);
    }

    private function genererWhatsApp(array $data, int $montant, string $ref): string
    {
        $parties   = !empty($data['parties']) ? implode(', ', $data['parties']) : 'N/A';
        $options   = !empty($data['options']) ? implode(', ', $data['options']) : 'Aucune';
        $montantFr = number_format($montant, 0, ',', ' ');

        $message = "📋 *NOUVEAU DEVIS — AcadémieOHADA*\n\n"
            . "🔖 Réf : {$ref}\n"
            . "👤 {$data['prenom']} {$data['nom']}\n"
            . "📧 {$data['email']}\n"
            . "📱 {$data['telephone']}\n"
            . "🌍 {$data['pays']}\n\n"
            . "📝 *Prestation :* {$data['categorie']}"
            . (isset($data['niveau']) ? " ({$data['niveau']})" : '') . "\n"
            . "📚 *Parties :* {$parties}\n"
            . "🎯 *Sujet :* {$data['sujet']}\n"
            . "⏱️ *Délai :* {$data['delai']}\n"
            . "➕ *Options :* {$options}\n"
            . "💰 *Montant estimé :* {$montantFr} FCFA\n\n"
            . "Bonjour, je souhaite obtenir un devis pour ce service.";

        return 'https://wa.me/' . config('app.admin_whatsapp', '221775646246')
            . '?text=' . rawurlencode($message);
    }

    private function listePays(): array
    {
        return [
            'Sénégal', 'Bénin', 'Burkina Faso', 'Cameroun', 'Centrafrique',
            'Comores', 'Congo', 'Côte d\'Ivoire', 'Gabon', 'Guinée',
            'Guinée-Bissau', 'Guinée équatoriale', 'Mali', 'Niger',
            'RDC', 'Tchad', 'Togo', 'Cap-Vert', 'Gambie', 'Ghana',
            'Libéria', 'Nigeria', 'Sierra Leone', 'Autre',
        ];
    }
}
