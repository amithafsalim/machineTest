<?php
namespace User\V1\Rest\Message;

class MessageResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get(\User\V1\Rest\Message\MessageService::class);
        return new MessageResource($mapper);
    }
}
