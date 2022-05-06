<?php

namespace App\UseCase\ShowProfileEdit;

use App\Domain\ValueObject\ProfileView;

final class ShowProfileEditOutput
{
    private $profileView;

    public function __construct(ProfileView $profileView)
    {
        $this->profileView = $profileView;
    }

    /**
     * ProfileViewを返す
     *
     * @return ProfileView
     */
    public function profileView(): ProfileView
    {
        return $this->profileView;
    }
}
