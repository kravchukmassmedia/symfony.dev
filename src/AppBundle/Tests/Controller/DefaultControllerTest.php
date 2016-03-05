<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Search Form', $crawler->filter('#container h1')->text());


        $client = static::createClient();
        $crawler = $client->request('GET', '/?search=qwe');
        $this->assertGreaterThan(0, $crawler->filter('html:contains("File")')->count());
    }
}
