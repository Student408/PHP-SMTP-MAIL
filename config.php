<?php
return [
    'smtp' => [
        'username' => 'admin.example@gmail.com', // Admin Email ID
        'password' => 'yourpassword',   // Password
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'encryption' => 'tls',
    ],
    'receiver' => [
        'email' => 'mrbean.example@gmail.com', // Monitor the response in different email ID
        'name' => 'Mr. Bean', // Site name / person name
    ],

// Allowed origins/addresses: Enter the addresses you want to allow

    'allowed_origins' => [ 
        'https://example.com',
        'https://mr.bean.example.com',
        'http://127.0.0.1',
        'http://localhost',
        'http://127.0.0.1:5500'
    ],
];
