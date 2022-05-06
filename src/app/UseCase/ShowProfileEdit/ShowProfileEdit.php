<?php

namespace App\UseCase\ShowProfileEdit;

use App\Adapter\QueryService\UserQueryService;

interface ShowProfileEdit
{
    public function __construct(UserQueryService $userQueryService);
    public function handler(): ShowProfileEditOutput;
}
