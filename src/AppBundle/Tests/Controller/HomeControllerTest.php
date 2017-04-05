<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
	
	$this->assertContains(
            'Welcome to the Home:index page',
            $client->getResponse()->getContent()
        );
    }

}
