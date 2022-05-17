<?php

namespace App\UseCase\ShowProfileEdit;

use App\Adapter\QueryService\ProfileQueryService;

interface ShowProfileEdit
{
    public function __construct(ProfileQueryService $profileQueryService);
    public function handler(): ShowProfileEditOutput;
}
