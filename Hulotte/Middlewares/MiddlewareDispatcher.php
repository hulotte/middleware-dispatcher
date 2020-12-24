<?php

namespace Hulotte\Middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\{
    Message\ResponseInterface,
    Message\ServerRequestInterface,
    Server\MiddlewareInterface,
    Server\RequestHandlerInterface
};

/**
 * Class Dispatcher
 * @author Sébastien CLEMENT<s.clement@la-taniere.net>
 * @package Hulotte\Middlewares
 */
class MiddlewareDispatcher implements RequestHandlerInterface
{
    /**
     * Dispatcher constructor
     * @param array $middlewares
     * @param int $index
     */
    public function __construct(private array $middlewares, private int $index = 0)
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
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
     * @return MiddlewareInterface|null
     */
    private function getMiddleware(): ?MiddlewareInterface
    {
        if (isset($this->middlewares[$this->index])) {
            return $this->middlewares[$this->index];
        }

        return null;
    }
}
