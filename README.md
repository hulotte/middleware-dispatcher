# Hulotte Middleware Dispatcher
## Description
Hulotte Middleware Dispatcher is a package that allows you to manage the 
launch of middlewares with a queue system. This package respects PSR15 
standards.

## Installation
The easiest way to install Hulotte Middleware Dispatcher is to use 
[Composer](https://getcomposer.org/) with this command : 

```bash
$ composer require hulotte/middleware-dispatcher
```

## How to use Hulotte Middleware Dispatcher ?
First, instanciate the Dispatcher class with an array of middlewares.
```php
$dispatcher = new \Hulotte\Middleware\Dispatcher([
    new Middleware1(), 
    new Middleware2(),
]);
```
the order of the middlewares in the array is important: it represents 
the order in which the middlewares will be played.

Now you can call the handle method. The request must implement the 
ServerRequestInterface (PSR7 standards).

```php
$dispatcher->handle($request);
```
