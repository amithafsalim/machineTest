<?php
namespace User\V1\Rest\Login;

class LoginResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get(\User\V1\Rest\Login\LoginService::class);
        return new LoginResource($mapper);
    }
}

