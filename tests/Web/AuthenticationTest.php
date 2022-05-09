<?php

namespace App\Tests\Web;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{
    public function testServerStart(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello IndexController');
    }

    public function testAuthentication(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/login',
        );

        $crawler = $client->followRedirect();
        $form = $crawler->filter('form')->first()->form();


        $form['username']->setValue('DCD');
        $form['password']->setValue('123456789');

        $client->submit($form);
        $crawler = $client->followRedirect();

        $navLinks = $crawler->filter('a.nav-link')->each(function ($node, $i) {
            if ($i == 2) {
                return $node->text();
            }
        });

        $this->assertEquals($navLinks[2], "Create a warrior");

        $this->assertTrue(true);

    }

    public function testAuthenticationWithRedirectionAim(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/homepage',
        );

        $crawler = $client->followRedirect();
        $form = $crawler->filter('form')->first()->form();


        $form['username']->setValue('DCD');
        $form['password']->setValue('123456789');

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertPageTitleContains('Homepage');

    }
}
