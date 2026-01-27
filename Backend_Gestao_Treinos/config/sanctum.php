<?php 

use Laravel\Sanctum\Sanctum;

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:5000,127.0.0.1,localhost:8001,::1',
    Sanctum::currentApplicationUrlWithPort()
    ))),
    "expiration" => 60
];
