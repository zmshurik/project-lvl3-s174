<?php

namespace App\Http\Controllers;

use \App\Domains;
use \GuzzleHttp\Client;

class DomainController extends Controller
{
    private $guzzleClient;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->$guzzleClient = $client;
    }

    public function index()
    {
        $domains = Domains::paginate(10);
        return view('domains', ["domains" => $domains, 'isSingleRow' => false]);
    }

    public function show($id)
    {
        $domain = Domains::find($id);
        return view('domains', ["domains" => [$domain], 'isSingleRow' => true]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return view('home', ['errors' => $validator->errors()->all()]);
        }

        $url = $request['url'];
        try {
            $response = $this->client->get($url);
        } catch (\Exception $e) {
            return view('home', ['errors' => ["Something was wrong within request to $url"]]);
        }

        $pageBody = $response->getBody();
        $responseCode = $response->getStatusCode();
        $headers = $response->getHeader('Content-Length');
        $contentLength = empty($headers) ? null : $headers[0];


        $domainName = parse_url($url, PHP_URL_HOST);
        $domain = Domains::updateOrCreate(['name' => $domainName], [
            'page_body' => $pageBody,
            'response_code' => $responseCode,
            'content_length' => $contentLength
        ]);
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }
}
