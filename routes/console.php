<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('api:get:user', function() {
	$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImMxZDIwMWVlZGRmOGU0MzE5MmU4MWFhYzk1N2RkMjFkMjJjZTQ1NmIyNDNmNzgzYzA2Y2JiOTgxZDc3YzdkOTgyNzdjOTQ2YTg0YjFmMDVmIn0.eyJhdWQiOiIxIiwianRpIjoiYzFkMjAxZWVkZGY4ZTQzMTkyZTgxYWFjOTU3ZGQyMWQyMmNlNDU2YjI0M2Y3ODNjMDZjYmI5ODFkNzdjN2Q5ODI3N2M5NDZhODRiMWYwNWYiLCJpYXQiOjE1MzIyMTgzMTMsIm5iZiI6MTUzMjIxODMxMywiZXhwIjoxNTYzNzU0MzEzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jihU8qdIt3Y9-PwKEZLQcZnSvF7aZlSrPHI1xYJ34ALI6vragZztxoq3LpdTn_M55wlM3kBhBvdjH3M-htvqJJoZUYBw4OrH0wYOpW9DW4a02dHm9mXEdk2VbxOolqbzV8VADgcyq7Qgbk84SZnj-j9aOxC3kts_1CXlyVnZTWKVTHz2D5tTS9w3R4lO3EkquUgjiyV-y_6NqmkQ8mBzq52s0CDcIM72_vKJ6naDviuh3G8D9sV_XAVYtoAVQ_EKdB0wX_zZ0qyJNOyD_6DfalU2LwFeq326CEagK0U6gRH_xWtYLYyS1da9XX2lKML2AizISb8iWNAPjPNDdNNYEy1AqFg6njRNr3YS-url1Nk-PIswC8GiWpiieBANxzYZXMUovPCq2zLkT1FKlTWU8UvqkfOKGeZ9ACloE_ynbRRv9wHeX0V0c0g5PUwDF5DlO0SYaagGhEnD5JLJCkY_oZJDsg0SZ4XXUl3hwU1CN47rie8rocY0uBZfyJ3VL85axty1TVh-U3guZnYxS_cUHaalbMqqH1EYM1SxZCEWzrT6vr7h1eXdIYllXE_B05GYSuplEDbzBG95JCPKWp6g8YDecjU-uAFSnAvvskdsy-kc7dWxPLsk-snTK592ec-0z_iiezxjYMPv87LaS7Zr-ssJE0IxQdNhpyz4Zaj5a2w';

	$http = new \GuzzleHttp\Client;

	$response = $http->get('https://passport.app/api/user', [
	    'headers' => [
	        'Accept' => 'application/json',
	        'Authorization' => 'Bearer '.$accessToken,
	    ],
	]);
	$user = json_decode((string) $response->getBody(), true);
	dd($user);
});
