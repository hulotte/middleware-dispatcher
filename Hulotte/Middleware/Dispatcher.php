<?php

namespace Hulotte\Middleware;

use GuzzleHttp\Psr7\Response;
use Psr\Http\{
    Message\ResponseInterface,
    Message\ServerRequestInterface,
    Server\RequestHandlerInterface
};

/**
 * Class Dispatcher
 * @author Sébastien CLEMENT<s.clement@la-taniere.net>
 * @package Hulotte\Middleware
 */
class Dispatcher implements RequestHandlerInterface
{
    /**
     * @var int
     */
    private $index = 0;

    /**
     * @var array
     */
    private $middlewares;

    /**
     * Dispatcher constructor
     * @param array $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = $this->getMiddleware();
        $this->index++;

        if ($middleware === null) {
            return new Response();
        }

        return $middleware->process($request, $this);
    }

    /**
     * Get the current middleware
     * @return mixed|null
     */
    private function getMiddleware()
    {
        if (isset($this->middlewares[$this->index])) {
            return $this->middlewares[$this->index];
        }

        return null;
    }
}
