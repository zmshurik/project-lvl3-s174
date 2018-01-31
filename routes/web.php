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

    $domain = Domain::updateOrCreate(['name' => $request['url']]);
    $id = $domain->id;
    return redirect()->route('domain', ['id' => $id]);
});

$router->get('/domains/{id}', ['as' => 'domain', function ($id) use ($router) {
    $domain = Domain::find($id);
    return view('domains', ["domain" => $domain]);
}]);
