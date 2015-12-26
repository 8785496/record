<?php

namespace Tests\AppBundle\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function test1()
    {
        $client = static::createClient();

        $client->request('GET', '/1');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function test2()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/',
            [],
            [],
            ['accept' => 'application/json']
        );

        //dump($client->getResponse()->getContent());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
