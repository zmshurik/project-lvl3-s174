<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use App\Domain;

$router->get('/', function () use ($router) {
    return view('home');
});

$router->post('/domains', function (Illuminate\Http\Request $request) use ($router) {
    $validator = \Validator::make($request->all(), [
        'url' => 'required|url',
        ]);


    if ($validator->fails()) {
        return view('home', ['errors' => $validator->errors()->all()]);
    }
    $url = parse_url($request['url'], PHP_URL_HOST);
    $domain = Domain::updateOrCreate(['name' => $url]);
    $domain->touch();
    return redirect()->route('domain', ['id' => $domain->id]);
});

$router->get('/domains/{id}', ['as' => 'domain', function ($id) use ($router) {
    $domain = Domain::find($id);
    return view('domains', ["domains" => [$domain]]);
}]);

$router->get('/domains', function () use ($router) {
    $domains = Domain::all();
    return view('domains', ["domains" => $domains]);
});
