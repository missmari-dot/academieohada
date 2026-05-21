<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\NotificationAdmin;
use App\Notifications\NouvelleCandidatureNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CandidatureController extends Controller
{
    public function showForm()
    {
        return view('auth.rejoindre');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prenom'               => 'required|string|max:100',
            'nom'                  => 'required|string|max:100',
            'email'                => 'required|email|unique:candidatures,email',
            'telephone'            => 'required|string|max:30',
            'pays'                 => 'required|string|max:100',
            'ville'                => 'required|string|max:100',
            'diplome'              => 'required|in:Licence,Master,Doctorat',
            'specialite'           => 'required|string|max:200',
            'etablissement_diplome'=> 'required|string|max:200',
            'annees_experience'    => 'required|in:0-1,1-3,3-5,5+',
            'services_proposes'    => 'nullable|array',
            'disponibilite'        => 'required|in:Temps plein,Temps partiel,Week-end',
            'cv'                   => 'required|file|mimes:pdf|max:5120',
            'lettre'               => 'nullable|file|mimes:pdf|max:5120',
            'travaux'              => 'nullable|file|mimes:pdf,docx,doc|max:5120',
            'password'             => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])/'],
            'message_libre'        => 'nullable|string|max:2000',
        ], [
            'email.unique'    => 'Une candidature avec cet email existe déjà.',
            'cv.required'     => 'Veuillez joindre votre CV (PDF).',
            'password.regex'  => 'Le mot de passe doit contenir 1 majuscule, 1 chiffre et 1 caractère spécial.',
        ]);

        // Stocker les fichiers
        $cvPath     = $this->storeFile($request->file('cv'), 'cvs');
        $lettrePath = $request->hasFile('lettre') ? $this->storeFile($request->file('lettre'), 'lettres') : null;
        $travauxPath= $request->hasFile('travaux') ? $this->storeFile($request->file('travaux'), 'travaux') : null;

        $candidature = Candidature::create([
            'prenom'               => $data['prenom'],
            'nom'                  => $data['nom'],
            'email'                => $data['email'],
            'telephone'            => $data['telephone'],
            'pays'                 => $data['pays'],
            'ville'                => $data['ville'],
            'diplome'              => $data['diplome'],
            'specialite'           => $data['specialite'],
            'etablissement_diplome'=> $data['etablissement_diplome'],
            'annees_experience'    => $data['annees_experience'],
            'services_proposes'    => $data['services_proposes'] ?? [],
            'disponibilite'        => $data['disponibilite'],
            'cv_path'              => $cvPath,
            'lettre_path'          => $lettrePath,
            'travaux_path'         => $travauxPath,
            'password_hash'        => bcrypt($data['password']),
            'message_libre'        => $data['message_libre'] ?? null,
            'statut'               => 'en_attente',
        ]);

        // Notification admin (email + dashboard)
        NotificationAdmin::creer(
            'candidature',
            'Nouvelle candidature expert',
            "{$candidature->prenom} {$candidature->nom} ({$candidature->specialite}) a soumis sa candidature.",
            route('admin.candidatures.show', $candidature)
        );

        Notification::route('mail', config('app.admin_email', config('mail.from.address')))
            ->notify(new NouvelleCandidatureNotification($candidature));

        return redirect()->route('candidature.confirmation');
    }

    public function confirmation()
    {
        return view('auth.candidature-recue');
    }

    private function storeFile($file, string $folder): string
    {
        $uuid = Str::uuid();
        $ext  = $file->getClientOriginalExtension();
        $path = "private/{$folder}/{$uuid}.{$ext}";
        Storage::put($path, file_get_contents($file));
        return $path;
    }
}
