<?php

namespace App\UseCase\GetTweetDetail;

interface GetTweetDetail
{
    public function __construct(GetTweetDetailInput $input);
    public function handler(): GetTweetDetailOutput;
}
