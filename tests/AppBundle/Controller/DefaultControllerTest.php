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
        $this->assertContains('German Chernyshov', $crawler->filter('h1')->text());
    }

    public function testBalda()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/balda');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('German Chernyshov', $crawler->filter('h1')->text());
    }
}
