<?php

namespace tests\Hulotte\Middleware;

use Hulotte\Middlewares\MiddlewareDispatcher;
use PHPUnit\Framework\TestCase;
use Psr\Http\{
    Message\ResponseInterface,
    Message\ServerRequestInterface,
    Server\MiddlewareInterface
};

/**
 * Class DispatcherTest
 * @author Sébastien CLEMENT<s.clement@la-taniere.net>
 * @covers \Hulotte\Middlewares\MiddlewareDispatcher
 * @package tests\Hulotte\Middlewares
 */
class MiddlewareDispatcherTest extends TestCase
{
    /**
     * @covers \Hulotte\Middlewares\MiddlewareDispatcher::handle
     * @test
     */
    public function handleWithMiddlewareInterface()
    {
        $middleware = $this->createMock(MiddlewareInterface::class);
        $middleware->expects($this->once())->method('process');
        $dispatcher = new MiddlewareDispatcher([$middleware]);
        $request = $this->createMock(ServerRequestInterface::class);

        $dispatcher->handle($request);
    }

    /**
     * @covers \Hulotte\Middlewares\MiddlewareDispatcher::handle
     * @test
     */
    public function handleWithNoMiddleware()
    {
        $dispatcher = new MiddlewareDispatcher([null]);
        $request = $this->createMock(ServerRequestInterface::class);

        $result = $dispatcher->handle($request);

        $this->assertInstanceOf(ResponseInterface::class, $result);
    }
}
