<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class HomeControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrlsAndCodes
     * @group unit
     */
    public function testHomePage(string $url, int $code): void
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, $url);

        $this->assertResponseStatusCodeSame($code);
    }

    public function provideUrlsAndCodes(): \Generator
    {
        yield 'homepage' => ['/', 200];
        yield 'contact' => ['/contact', 200];
        yield 'book' => ['/book', 200];
        yield 'toto' => ['/toto', 404];
    }
}
