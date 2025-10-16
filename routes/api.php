<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/provinsi', function () {
    $response = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
    return response()->json($response->json());
});
