<?php

class ZeroMQTest extends TestCase
{
    /**
     * Set up environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        if (! class_exists('Denpaw\ZeroMQ\Manager')) {
            class_alias('FakeManager', 'Denpaw\ZeroMQ\Manager');
        }

        if (! class_exists('Denpaw\ZeroMQ\Connection')) {
            class_alias('FakeConnection', 'Denpaw\ZeroMQ\Connection');
        }

        $this->manager = $this->getMockBuilder('Denpaw\ZeroMQ\Manager')
            ->getMock();
        $this->connection = $this->getMockBuilder('Denpaw\ZeroMQ\Connection')
            ->getMock();

        $this->app->extend(
            Denpaw\ZeroMQ\Manager::class,
            function ($service) {
                return $this->manager;
            }
        );
    }

    /**
     * Test subscribe.
     *
     * @return void
     */
    public function testSubscribe()
    {
        $blockhash = '0000000000000000001509883deaf5c2bf026625c9d95247343336359a803b6d';

        $callback = function ($message, $sequence) use ($blockhash) {
            $this->assertEquals($blockhash, $message);
            $this->assertSame($sequence, 1);
        };

        $this->manager->expects($this->once())
            ->method('make')
            ->with(config('playcoind.default.zeromq'))
            ->willReturn($this->connection);

        $this->connection
            ->expects($this->once())
            ->method('subscribe')
            ->with(['hashblock'])
            ->will($this->returnCallback(function ($event, $callback) use ($blockhash) {
                $callback([
                    'hashblock',
                    pack('H*', $blockhash),
                    pack('I', 0x01),
                ]);
            }));

        $this->playcoind()->on('hashblock', $callback);
    }

    /**
     * Test exception on broken sequence.
     *
     * @return void
     */
    public function testBrokenSequence()
    {
        $callback = function ($message, $sequence) {
            //
        };

        $this->manager->expects($this->once())
            ->method('make')
            ->with(config('playcoind.default.zeromq'))
            ->willReturn($this->connection);

        $this->connection
            ->expects($this->once())
            ->method('subscribe')
            ->with(['hashblock'])
            ->will($this->returnCallback(function ($event, $callback) {
                // sequence number 1
                $callback([
                    'hashblock',
                    pack('H', 0x00),
                    pack('I', 0x01),
                ]);

                // sequence number 3
                $callback([
                    'hashblock',
                    pack('H', 0x00),
                    pack('I', 0x03),
                ]);
            }));

        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(
            'Broken sequence on sequence number 3. Detected lost notifications.'
        );

        $this->playcoind()->on('hashblock', $callback);
    }

    /**
     * Test with null config.
     *
     * @return void
     */
    public function testNullConfig()
    {
        $callback = function ($message, $sequence) {
            //
        };

        $this->connection
            ->expects($this->never())
            ->method('subscribe');

        $this->playcoind()
            ->client('litecoin')
            ->on('hashblock', $callback);
    }
}

class FakeManager
{
    public function make(array $config)
    {
        //
    }
}

class FakeConnection
{
    public function subscribe($topic, callable $callback)
    {
        //
    }
}
