<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/passport', function () {
    $query = http_build_query([
        'client_id' => 4,
        'redirect_uri' => 'https://passport-consumer.app/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('https://passport.app/oauth/authorize?'.$query);
});

Route::get('/callback', function (\Illuminate\Http\Request $request) {

    // if the oauth server redirect to this route,
    // means that user authorise to access to the oauth2 server
    // and we can use the auhorization code to get the 
    // access token
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
});

// eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBiZDA1ODMwNDBmNTgyYzIyY2E1YTBmYTBkNjcyMzM2OTZhMDk0Yzc0NzFjZDExMWUxZGYwMmU1MTVkMzZjNzFiMDAzZmM4ZWMwNTA3ODQ5In0.eyJhdWQiOiI0IiwianRpIjoiMGJkMDU4MzA0MGY1ODJjMjJjYTVhMGZhMGQ2NzIzMzY5NmEwOTRjNzQ3MWNkMTExZTFkZjAyZTUxNWQzNmM3MWIwMDNmYzhlYzA1MDc4NDkiLCJpYXQiOjE1MzIyMjEwNzUsIm5iZiI6MTUzMjIyMTA3NSwiZXhwIjoxNTYzNzU3MDc1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.a4oVBdn47ByieZnsfw5HeODYrW6sXFjejliTLG_GIAx5I-bx5SAZdf3bxJ4dL9rRZusEVQyeCpkeo5uxHf9Ac1eSEXjBd7lAjkAS61dMNPlI5VBFrF-3BEsn9GTvndURDcDgRoMfIG22prkVvfZA8GV-VjPgE5JDMkobthz80gGmjGmTHxS_lAf8xbg5fVAce80f-6bOrot23MDQqneVuXJQH_I1Uh6ILHuH62VjZW24VLLyqUNG_W8wKhoMmwY-WAqsblTIR-KBfFeOxvoDPA0PjyLyeGsm5MwivOVRHyC6yw5ykzhZSXVg3uVIAug_M4HNizZw1K7YzTnXTOvLEHrIaUtOdoNutGwpAmofnC4tgt-s2lbZjk-zpvB1iAx40olkHBlA2UPIWHUqrdgJGy7VvovkK2LEvBsA2vyGa7F7CHVDwrAUDuzGenXETBtAlpo1EeZrAXKpXdOVWaSV07g0tVgIiMqBojPAVUvwclRGIbn0FSq_Dd5-9SEXtJ8lKoknOOpBPDeawPqaO6aouNmz2tMYKiwf0nWvE2VDd_klEp0umsny6lpoC6dGKtMdWfK8ANrBlFU70YlzCK5nJVupgl80oFB8IkjFTK1o_19FSZLrhYJLgMbQnINPb01vO-rcTd4A29gksC1txBAyTjROJRAuoISh9OK1jIPENoI","refresh_token":"def50200971948118e13b0253f3a41e3d0b67775f7d041807c56b2cd7f3d002ae5cdaade296b80ca0e4964f3ed6d56c4432b50ad356fb955e69c92c3a56eb882ff54e90ceed1972880eecb68b375e66a8d5ee9720ba54b4d81b459c0bb52596e24dbe3c2a7ae8579cc140d9a64f3d2be2f639baee601f4ffb8f79e5f3b2cc22d42751b6926f73aa7d2143daffcd95d9a01302ace530fe832d56f5366f69af7f6f40fecfaee9fe244bb965fea8df60d84ad1d69169ea8bc46a098aa2093f930bfc2849cbdb241345dcb12df73378ff2b21b85517024e8bde1420aba657fcc5fb9ddbb62977157e16681beb1c6dc32cc10315da211fc0071f3343daa2c3943ea039117a48f44137ed0e0eb062ee040a546f02f74f94ff5ede40a355afb19313f1336ee9d1d91452b61b8b675e5ac627a34b351ae6617abed91e7bfe5a71ac8c131277bb07e50e68f832261d943f78c0b73b6639c9a0cfc3dbf841fafe0223e629b75
