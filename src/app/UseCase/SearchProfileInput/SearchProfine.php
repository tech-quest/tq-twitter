<?php

namespace App\UseCase\SearchProfile;

use App\Adapter\QueryService\ProfileQueryService;

interface SearchProfile
{
    public function __construct(
        SearchProfileInput $input,
        ProfileQueryService $tweetQueryService
    );
    public function handler(): SearchProfileOutput;
}
