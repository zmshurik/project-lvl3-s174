<?php

namespace App\Http\Controllers;

use \App\Domains;

class DomainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $domains = Domains::all();
        return view('domains', ["domains" => $domains]);
    }

    public function show($id)
    {
        $domain = Domains::find($id);
        return view('domains', ["domains" => [$domain]]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'url' => 'required|url',
            ]);


        if ($validator->fails()) {
            return view('home', ['errors' => $validator->errors()->all()]);
        }
        $url = parse_url($request['url'], PHP_URL_HOST);
        $domain = Domains::firstOrCreate(['name' => $url]);
        $domain->touch();
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }
}
