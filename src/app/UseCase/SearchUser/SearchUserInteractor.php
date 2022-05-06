<?php

namespace App\UseCase\SearchUser;

use App\Adapter\QueryService\UserQueryService;
use App\Domain\ValueObject\UserId;
use App\Domain\Entity\User;
use App\Domain\ValueObject\ProfileView;


final class SearchUserInteractor implements SearchUser
{
  private $input;
  private $userQueryService;

  public function __construct(
    SearchUserInput $input,
    UserQueryService $userQueryService
  ) {
    $this->input = $input;
    $this->userQueryService = $userQueryService;
  }

  public function handler(): SearchUserOutput
  {
    $user = $this->searchUser();
    //TODO: ユーザーがnullの場合も考慮する
    $profileView = new ProfileView($user->name(), null, null, null, null);
    return new SearchUserOutput($profileView);
  }

  private function searchUser(): ?User
  {
    $userId = $this->userId();
    $user = $this->userQueryService->findById($userId);
    return $user;
  }

  private function userId(): UserId
  {
    return new UserId($this->input->userId());
  }
}
