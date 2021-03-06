<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecordControllerTest extends WebTestCase
{
    // table record must br empty
    public function testCreate()
    {
        $username = 'Peter';
        $password = 'pass';
        $score = 500;

        $client = static::createClient();
        $client->request(
            'POST',
            '/record',
            [],
            [],
            ['HTTP_ACCEPT' => 'application/json'],
            "{\"score\": $score, \"user\": {\"username\": \"$username\", \"password\": \"$password\"}}"
        );

        $content = $client->getResponse()->getContent();
        dump($content);
        $arr = json_decode($content, true);


        $this->assertEquals(1, $arr['code']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testRecord()
    {
        $client = static::createClient();
        $client->request('GET', '/record');
        $content = $client->getResponse()->getContent();
        dump($content);
        $arr = json_decode($content, true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, count($arr));
    }

    public function testMyRecord()
    {
        $username = 'Peter';

        $client = static::createClient();
        $client->request('GET', "/record/$username");
        $content = $client->getResponse()->getContent();
        dump($content);
        $arr = json_decode($content, true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, count($arr));
    }

    public function testCreateAnonymously()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/record/anonymous',
            [],
            [],
            ['HTTP_ACCEPT' => 'application/json'],
            "{\"score\": 1000}"
        );

        $content = $client->getResponse()->getContent();
        dump($content);
        $arr = json_decode($content, true);

        $this->assertEquals(1, $arr['code']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
