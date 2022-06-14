<?php

namespace User\V1\Rest\Login;

use ZF\ApiProblem\ApiProblem;


class LoginService
{
    public function __invoke($container) 
    {   
        $adapter = $container->get('dbrw');
        return new \User\V1\Rest\Login\LoginMapper($adapter);
    }


}
