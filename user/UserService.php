<?php

namespace User\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;


class UserService
{
    public function __invoke($container) 
    {   
        $adapter = $container->get('dbrw');
        return new \User\V1\Rest\User\UserMapper($adapter);
    }


}
