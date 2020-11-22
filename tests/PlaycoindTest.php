<?php

use Denpaw\Playcoin\ClientFactory;
use Denpaw\Playcoin\Facades\Playcoind as PlaycoindFacade;
use Denpaw\Playcoin\LaravelClient as PlaycoinClient;
use GuzzleHttp\Client as GuzzleHttp;

class PlaycoindTest extends TestCase
{
    /**
     * Assert that configs are equal.
     *
     * @param  \Denpaw\Playcoin\Client  $client
     * @param  array  $config
     *
     * @return void
     */
    protected function assertConfigEquals(PlaycoinClient $client, array $config)
    {
        $this->assertEquals($config['scheme'], $client->getConfig()['scheme']);
        $this->assertEquals($config['host'], $client->getConfig()['host']);
        $this->assertEquals($config['port'], $client->getConfig()['port']);
        $this->assertNotNull($client->getConfig()['user']);
        $this->assertNotNull($client->getConfig()['password']);
        $this->assertEquals($config['user'], $client->getConfig()['user']);
        $this->assertEquals($config['password'], $client->getConfig()['password']);
        $this->assertEquals($config['timeout'], $client->getConfig()['timeout']);
    }

    /**
     * Test service provider.
     *
     * @return void
     */
    public function testServiceIsAvailable()
    {
        $this->assertInstanceOf(
            ClientFactory::class, $this->app['playcoind']
        );

        $this->assertInstanceOf(
            PlaycoinClient::class, $this->app['playcoind.client']
        );

        $this->assertTrue($this->app->bound('playcoind'));
        $this->assertTrue($this->app->bound('playcoind.client'));
    }

    /**
     * Test facade.
     *
     * @return void
     */
    public function testFacade()
    {
        $this->assertInstanceOf(
            ClientFactory::class,
            PlaycoindFacade::getFacadeRoot()
        );

        $this->assertInstanceOf(
            PlaycoinClient::class,
            PlaycoindFacade::getFacadeRoot()->client()
        );

        $this->assertInstanceOf(
            PlaycoinClient::class,
            PlaycoindFacade::getFacadeRoot()->client('default')
        );
    }

    /**
     * Test helper.
     *
     * @return void
     */
    public function testHelper()
    {
        $this->assertInstanceOf(
            ClientFactory::class, playcoind()
        );

        $this->assertInstanceOf(
            PlaycoinClient::class, playcoind()->client()
        );

        $this->assertInstanceOf(
            PlaycoinClient::class, playcoind()->client('default')
        );
    }

    /**
     * Test trait.
     *
     * @return void
     */
    public function testTrait()
    {
        $this->assertInstanceOf(
            ClientFactory::class, $this->playcoind()
        );

        $this->assertInstanceOf(
            PlaycoinClient::class, $this->playcoind()->client()
        );

        $this->assertInstanceOf(
            PlaycoinClient::class, $this->playcoind()->client('default')
        );
    }

    /**
     * Test playcoin config.
     *
     * @return void
     *
     * @dataProvider nameProvider
     */
    public function testConfig($name)
    {
        $this->assertConfigEquals(
            playcoind()->client($name),
            config("playcoind.$name")
        );
    }

    /**
     * Name provider for config test.
     *
     * @return array
     */
    public function nameProvider()
    {
        return [
            ['default'],
            ['litecoin'],
        ];
    }

    /**
     * Test with non existent config.
     *
     * @return void
     */
    public function testNonExistentConfig()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Could not find client configuration [nonexistent]');

        $config = playcoind()->client('nonexistent')->getConfig();
    }

    /**
     * Test with legacy config format.
     *
     * @return void
     */
    public function testLegacyConfig()
    {
        config()->set('playcoind', [
            'scheme'   => 'http',
            'host'     => 'localhost',
            'port'     => 8332,
            'user'     => 'testuser3',
            'password' => 'testpass3',
            'ca'       => null,
            'timeout'  => false,
        ]);

        $this->assertConfigEquals(playcoind()->client(), config('playcoind'));
        $this->assertLogContains('You are using legacy config format');
    }

    /**
     * Test magic call to client through factory.
     *
     * @return void
     */
    public function testMagicCall()
    {
        $this->assertInstanceOf(GuzzleHttp::class, playcoind()->getClient());
    }

    /**
     * Test making new client instance.
     *
     * @return void
     */
    public function testFactoryMake()
    {
        $config = [
            'scheme'   => 'http',
            'host'     => '127.0.0.3',
            'port'     => 18332,
            'user'     => 'testuser3',
            'password' => 'testpass3',
            'timeout'  => false,
        ];

        $this->assertConfigEquals(playcoind()->make($config), $config);
    }
}
