<?php 

// 'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
//     '%s%s',
//     'localhost,localhost:5500,127.0.0.1,127.0.0.1:8000,::1',
//     Sanctum::currentApplicationUrlWithPort()
// )))

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', '127.0.0.1:5500,127.0.0.1:8000')),
];
