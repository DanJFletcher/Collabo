<?php

return [
    'user' => [
        'model' => 'App\Models\Access\User\User',
    ],
    'broadcast' => [
        'enable' => true,
        'app_name' => 'donation-app-redding',
        'pusher' => [
            'app_id' => env('PUSHER_APP_ID'),
            'app_key' => env('PUSHER_APP_KEY'),
            'app_secret' => env('PUSHER_APP_SECRET'),
            'options' => [
                'cluster' => 'ap1',
                'encrypted' => true
            ]
        ],
    ],
];

