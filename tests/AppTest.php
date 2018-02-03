<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;


class AppTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testMainPage()
    {
        $this->get('/');
        $this->assertResponseOk();
    }

    public function testDomainsPage()
    {
        DB::insert('insert into domains (name, page_body, content_length, response_code) values (?, ?, ?, ?)', ['domain1', 'body', 4, 200]);
        DB::insert('insert into domains (name, page_body, content_length, response_code) values (?, ?, ?, ?)', ['domain2', 'body2', 5, 200]);
        $this->get('/domains');
        $this->assertResponseOk();
    }

    public function testDatabaseCreateRaw()
    {
        $html = <<<DOC
        <!DOCTYPE html>
        <html>
        <head>
            <meta <meta name="keywords" content="content of keywords">
            <meta <meta name="content" content="my keywords">
        </head>
        <body>

        <h1>Header</h1>

        <p>My first paragraph.</p>

        </body>
        </html>
DOC;
        $mock = new MockHandler([
            new Response(200, ['Content-Length' => 4], 'body'),
            new Response(200, [], $html)
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(\GuzzleHttp\Client::class, $client);

        $this->post('/domains', ['url' => 'http://domain.com']);
        $this->seeInDatabase('domains', [
            'name' => 'domain.com',
            'page_body' => 'body',
            'content_length' => 4,
            'response_code' => 200
        ]);
        $this->post('/domains', ['url' => 'http://domain2.com']);
        $this->seeInDatabase('domains', [
            'name' => 'domain2.com',
            'response_code' => 200,
            'main_header' => 'Header',
            'meta_keywords' => 'my keywords'
        ]);
    }
}
