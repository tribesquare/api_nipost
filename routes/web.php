<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json([
    'message' => 'Welcome to the API',
    'data' => [
        'product' => 'Nipost Parcel Api',
        'postman_documentation' => '',
        'company' => 'tribesquare',
    ]
]));
