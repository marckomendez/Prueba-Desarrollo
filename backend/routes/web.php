<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Pastelería API',
        'version' => '1.0.0',
        'endpoints' => [
            'pasteles' => '/api/pasteles',
            'ingredientes' => '/api/ingredientes',
        ]
    ]);
});
