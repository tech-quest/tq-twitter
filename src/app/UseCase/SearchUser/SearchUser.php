<?php

namespace App\UseCase\SearchUser;

use App\Adapter\QueryService\UserQueryService;

interface SearchUser
{
  public function __construct(
    SearchUserInput $input,
    UserQueryService $userQueryService
  );
  public function handler(): SearchUserOutput;
}
