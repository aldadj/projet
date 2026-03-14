<?php

return [
    'cloud_url' => env('CLOUDINARY_URL'),

    /*
    | Cette section 'cloud' est CRITIQUE. 
    | C'est l'absence de ce bloc qui cause ton erreur.
    */
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],

    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),

    // Options optionnelles
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),
];