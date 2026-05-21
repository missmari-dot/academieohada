<?php

return [
    'accepted'             => 'Le champ :attribute doit être accepté.',
    'email'                => 'Le champ :attribute doit être une adresse email valide.',
    'max'                  => ['string' => 'Le champ :attribute ne peut pas dépasser :max caractères.'],
    'min'                  => ['string' => 'Le champ :attribute doit avoir au moins :min caractères.'],
    'required'             => 'Le champ :attribute est obligatoire.',
    'unique'               => 'Cette valeur est déjà utilisée pour :attribute.',
    'confirmed'            => 'La confirmation du champ :attribute ne correspond pas.',
    'mimes'                => 'Le champ :attribute doit être un fichier de type : :values.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'in'                   => 'La valeur sélectionnée pour :attribute est invalide.',
    'date'                 => 'Le champ :attribute n\'est pas une date valide.',
    'attributes'           => [
        'email'            => 'adresse email',
        'password'         => 'mot de passe',
        'prenom'           => 'prénom',
        'nom'              => 'nom',
        'telephone'        => 'téléphone',
        'sujet'            => 'sujet',
        'message'          => 'message',
        'cv'               => 'CV',
    ],
];
