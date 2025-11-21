<?php 

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Rotas afetadas
    'allowed_methods' => ['*'], // Métodos permitidos (GET, POST, etc)
    'allowed_origins' => [
        'http://localhost:5500',
        'http://127.0.0.1:5500'
    ], // URLs de origem permitidas
    'allowed_headers' => ['*'], // Cabeçalhos permitidos
    'exposed_headers' => [],
    'max_age' => 3600,
    'supports_credentials' => true, // Defina como `true` para usar cookies/auth
];