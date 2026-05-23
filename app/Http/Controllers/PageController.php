<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function accueil()
    {
        $stats = [
            'memoires'    => '500+',
            'satisfaction' => '4.9/5',
            'experts'     => '100%',
            'pays'        => '17',
        ];
        return view('pages.accueil', compact('stats'));
    }

    public function services()
    {
        return view('pages.services');
    }

    public function memoires()
    {
        $disciplines = $this->getDisciplines();
        return view('pages.memoires', compact('disciplines'));
    }

    public function tarifs()
    {
        $tarifsMaster  = $this->getTarifsMaster();
        $tarifsLicence = $this->getTarifsLicence();
        $modificateurs = $this->getModificateurs();
        return view('pages.tarifs', compact('tarifsMaster', 'tarifsLicence', 'modificateurs'));
    }

    public function aPropos()
    {
        $garanties   = $this->getGaranties();
        $institutions = $this->getInstitutions();
        return view('pages.a-propos', compact('garanties', 'institutions'));
    }

    public function equipe()
    {
        return view('pages.equipe');
    }

    public function ressources()
    {
        return view('pages.ressources');
    }

    // ─── Données ─────────────────────────────────────────────────────────────

    private function getDisciplines(): array
    {
        return [
            'Français'                   => ['Littérature générale', 'Linguistique', 'Lettres modernes', 'Lettres classiques'],
            'Sciences Sociales'          => ['Sociologie', 'Sciences politiques', 'Comptabilité'],
            'Sciences Économiques'       => ['Économie', 'Finance', 'Développement', 'Commerce international'],
            'Sciences Juridiques'        => ['Droit public', 'Droit privé', 'Fiscalité'],
            'Sciences Juridiques & Politiques' => ['Droit OHADA', 'Relations internationales', 'Droit communautaire CEDEAO/UEMOA'],
            'Autres'                     => ['Informatique & SI', 'Marketing & Communication', 'Ressources Humaines', 'Santé & Médecine', 'Sciences de l\'éducation', 'Géographie & Aménagement'],
        ];
    }

    private function getTarifsMaster(): array
    {
        return [
            ['label' => 'Choix du sujet',             'prix' => 5000],
            ['label' => 'Problématique & hypothèses',  'prix' => 8000],
            ['label' => 'Plan détaillé',               'prix' => 5000],
            ['label' => 'Méthodologie',                'prix' => 10000],
            ['label' => 'Introduction',                'prix' => 25000],
            ['label' => '1ère Partie',                 'prix' => 50000],
            ['label' => '2ème Partie',                 'prix' => 50000],
            ['label' => 'Conclusion',                  'prix' => 10000],
            ['label' => 'Mémoire complet',             'prix' => 100000, 'economie' => 25000, 'highlight' => true],
        ];
    }

    private function getTarifsLicence(): array
    {
        return [
            ['label' => 'Choix du sujet',             'prix' => 3000],
            ['label' => 'Problématique & hypothèses',  'prix' => 5000],
            ['label' => 'Plan détaillé',               'prix' => 3000],
            ['label' => 'Méthodologie',                'prix' => 7000],
            ['label' => 'Introduction',                'prix' => 15000],
            ['label' => '1ère Partie',                 'prix' => 30000],
            ['label' => '2ème Partie',                 'prix' => 30000],
            ['label' => 'Conclusion',                  'prix' => 7000],
            ['label' => 'Mémoire complet',             'prix' => 60000, 'economie' => 15000, 'highlight' => true],
        ];
    }

    private function getModificateurs(): array
    {
        return [
            ['delai' => '30 jours',         'mod' => '+25%',  'classe' => 'urgent'],
            ['delai' => '4 mois (Standard)','mod' => 'Normal','classe' => 'normal'],
            ['delai' => 'Plus de 4 mois',   'mod' => '−10%',  'classe' => 'confort'],
        ];
    }

    private function getGaranties(): array
    {
        return [
            ['icon' => '✅', 'titre' => 'Révisions illimitées',       'texte' => 'Sans frais supplémentaires'],
            ['icon' => '⏱️', 'titre' => 'Livraison dans les délais',   'texte' => 'Remise automatique si retard de notre fait'],
            ['icon' => '🔒', 'titre' => 'Confidentialité totale',      'texte' => 'Données jamais partagées'],
            ['icon' => '💳', 'titre' => 'Paiement en 2 fois',          'texte' => '50% commande + 50% livraison'],
            ['icon' => '📦', 'titre' => 'Paiement par partie',         'texte' => 'Commandez partie par partie'],
            ['icon' => '⚡', 'titre' => 'Devis gratuit sous 2h',       'texte' => 'Sans engagement'],
            ['icon' => '🇸🇳', 'titre' => 'Experts locaux sénégalais',  'texte' => 'Diplômés Master ou Doctorat'],
            ['icon' => '🎓', 'titre' => 'Suivi soutenance gratuit',    'texte' => 'Inclus avec tout mémoire complet'],
            ['icon' => '📜', 'titre' => 'Assurance qualité',           'texte' => 'Conformité normes CEDEAO, UEMOA et OHADA'],
            ['icon' => '📚', 'titre' => 'Normes académiques',          'texte' => 'APA, MLA, normes internes établissement'],
        ];
    }

    private function getInstitutions(): array
    {
        return [
            [
                'nom'   => 'OHADA',
                'pays'  => ['Bénin','Burkina Faso','Cameroun','Centrafrique','Comores','Congo','Côte d\'Ivoire','Gabon','Guinée','Guinée-Bissau','Guinée équatoriale','Mali','Niger','RDC','Sénégal','Tchad','Togo'],
                'color' => '#1a2e4a',
            ],
            [
                'nom'   => 'UEMOA',
                'pays'  => ['Bénin','Burkina Faso','Côte d\'Ivoire','Guinée-Bissau','Mali','Niger','Sénégal','Togo'],
                'color' => '#f97316',
            ],
            [
                'nom'   => 'CEDEAO',
                'pays'  => ['Bénin','Burkina Faso','Cap-Vert','Côte d\'Ivoire','Gambie','Ghana','Guinée','Guinée-Bissau','Libéria','Mali','Niger','Nigeria','Sénégal','Sierra Leone','Togo'],
                'color' => '#16a34a',
            ],
        ];
    }
}
