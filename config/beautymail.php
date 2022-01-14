<?php

return [

    // These CSS rules will be applied after the regular template CSS


    'css' => [
        '.button-content .button { background: #3c1505 }',
    ],


    'colors' => [

        'highlight' => '#004ca3',
        'button' => '#004cad',

    ],

    'view' => [
        'senderName' => config('app.name'),
        'reminder' => null,
        'unsubscribe' => null,
        'address' => null,

        'logo' => [
            'path' => '%PUBLIC%/img/logo.png',
            'width' => '150',
            'height' => '',
        ],

        'twitter' => null,
        'facebook' => null,
        'flickr' => null,
    ],

];
