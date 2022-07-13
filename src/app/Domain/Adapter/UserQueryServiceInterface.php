<?php

namespace App\Domain\Adapter;

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;

interface UserQueryServiceInterface
{
  public function findById(UserId $id): ?User;
  public function findByEmail(Email $email): ?User;
}
