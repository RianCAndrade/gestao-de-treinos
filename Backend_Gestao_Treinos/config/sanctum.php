<?php 

// 'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
//     '%s%s',
//     'localhost,localhost:5500,127.0.0.1,127.0.0.1:8000,::1',
//     Sanctum::currentApplicationUrlWithPort()
// )))

use Laravel\Sanctum\Sanctum;

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:5000,127.0.0.1,127.0.0.1:8000,::1',
    Sanctum::currentApplicationUrlWithPort()
    ))),
];
