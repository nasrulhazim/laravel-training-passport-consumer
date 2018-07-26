<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', function(\Illuminate\Http\Request $request) {
	$http = new \GuzzleHttp\Client;

    $response = $http->post('https://passport.app/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 4,
            'client_secret' => 'n773TprB3Km13MWsAZi6kQz3o3UDxEdk0sFQkGUf',
            'redirect_uri' => 'https://passport-consumer.app/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
})->name('api.auth.login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
