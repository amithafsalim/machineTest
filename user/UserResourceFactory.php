<?php

namespace User\V1\Rest\User;

class UserResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get(\User\V1\Rest\User\UserService::class);
        return new UserResource($mapper);
    }
}
