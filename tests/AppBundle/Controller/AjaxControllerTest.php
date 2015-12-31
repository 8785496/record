<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjaxControllerTest extends WebTestCase
{
    public function testSendemail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/ajax/sendemail',
            ['form' => [
                'name' => 'Peter',
                'email' => 'georg.88@mail.ru',
                'phone' => '555',
                'message' => 'hello'
            ]]
        );
        $content = $client->getResponse()->getContent();
        $arr = json_decode($content, true);
        dump($content);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $arr['code']);
    }
}
