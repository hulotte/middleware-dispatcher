<?php

namespace tests\Hulotte\Middleware;

use Hulotte\Middleware\Dispatcher;
use PHPUnit\Framework\TestCase;
use Psr\Http\{
    Message\ResponseInterface,
    Message\ServerRequestInterface,
    Server\MiddlewareInterface
};

/**
 * Class DispatcherTest
 * @author Sébastien CLEMENT<s.clement@la-taniere.net>
 * @covers \Hulotte\Middleware\Dispatcher
 * @package tests\Hulotte\Middleware
 */
class DispatcherTest extends TestCase
{
    /**
     * @covers \Hulotte\Middleware\Dispatcher::handle
     * @test
     */
    public function handleWithMiddlewareInterface()
    {
        $middleware = $this->createMock(MiddlewareInterface::class);
        $middleware->expects($this->once())->method('process');
        $dispatcher = new Dispatcher([$middleware]);
        $request = $this->createMock(ServerRequestInterface::class);

        $dispatcher->handle($request);
    }

    /**
     * @covers \Hulotte\Middleware\Dispatcher::handle
     * @test
     */
    public function handleWithNoMiddleware()
    {
        $dispatcher = new Dispatcher([null]);
        $request = $this->createMock(ServerRequestInterface::class);

        $result = $dispatcher->handle($request);

        $this->assertInstanceOf(ResponseInterface::class, $result);
    }
}
