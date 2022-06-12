<?php

namespace App\UseCase\PasswordReset\SearchUserDetail;

use App\Infrastructure\Dao\UserDao;
use App\UseCase\PasswordReset\SearchUserDetail\Input;
use App\UseCase\PasswordReset\SearchUserDetail\Output;

final class Interactor
{
    private Input $input;

    public function __construct(Input $input)
    {
        $this->input = $input;
        $this->userDao = new UserDao();
    }

    public function handler(): Output
    {
        $user = $this->findByUser();

        if (is_null($user)) {
            return new Output(false, null);
        }

        return new Output(true, $user['email']);
    }

    private function findByUser()
    {
        return $this->userDao->findByEmail($this->input->email()->value());
    }
}
