<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

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

    public function testDatabaseCreateRaw()
    {
        $this->post('/domains', ['url' => 'http://domain.com']);
        $this->seeInDatabase('domains', ['name' => 'domain.com']);
    }
}
