<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExceptionControllerTest extends WebTestCase
{
    public function testError404()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/error');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertContains('404', $crawler->filter('h1')->text());
    }

    public function testJsonError404()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/error',
            [],
            [],
            ['HTTP_ACCEPT' => 'application/json']
        );
        $content = $client->getResponse()->getContent();
        $arr = json_decode($content, true);

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertEquals(404, $arr['status']);
    }
}
