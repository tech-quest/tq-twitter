<?php

namespace App\UseCase\SearchUser;

use App\Domain\Entity\User;
use App\Domain\ValueObject\ProfileView;

final class SearchUserOutput
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
