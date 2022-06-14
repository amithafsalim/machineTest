<?php

namespace User\V1\Rest\Message;

use ZF\ApiProblem\ApiProblem;


class MessageService
{
    public function __invoke($container) 
    {   
        $adapter = $container->get('dbrw');
        return new \User\V1\Rest\Message\MessageMapper($adapter);
    }


}
