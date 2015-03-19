<?php

namespace SimpleBus\Asynchronous\MessageBus;

use SimpleBus\Asynchronous\Publisher\Publisher;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Message;

class AlwaysPublishesMessages implements MessageBusMiddleware
{
    /**
     * @var \SimpleBus\Asynchronous\Publisher\Publisher
     */
    private $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * Handle a Message by publishing it to a queue (always), then calling the next middleware
     *
     * @{inheritdoc}
     */
    public function handle(Message $message, callable $next)
    {
        $this->publisher->publish($message);

        $next($message);
    }
}