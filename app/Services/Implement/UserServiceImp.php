<?php

namespace App\Services\Implement;

use App\Services\UserService;

class UserServiceImp implements UserService
{
    private array $users = [
        "abc" => "sosial"
    ];

    function login(string $user, string $pwd): bool
    {

        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $pwd == $correctPassword;
    }
}
