<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $username = 'Peter' . rand(1, 1000000);
        $password = 'pass';

        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['HTTP_ACCEPT' => 'application/json'],
            "{\"username\": \"$username\", \"password\": \"$password\"}"
        );
        $content = $client->getResponse()->getContent();
        $arr = json_decode($content, true);
        //dump($content);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $arr['code']);
    }

    public function testCreateAnonymous()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user/anonymous',
            [],
            [],
            ['HTTP_ACCEPT' => 'application/json']
        );
        $content = $client->getResponse()->getContent();
        $arr = json_decode($content, true);
        //dump($content);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $arr['code']);
    }

    public function testExist()
    {
        $username = 'Peter';
        $password = 'pass';

        $client = static::createClient();
        $client->request(
            'POST',
            '/user/exist',
            [],
            [],
            ['HTTP_ACCEPT' => 'application/json'],
            "{\"username\": \"$username\", \"password\": \"$password\"}"
        );
        $content = $client->getResponse()->getContent();
        $arr = json_decode($content, true);
        //dump($content);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $arr['code']);
    }
}
