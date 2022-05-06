<?php

namespace App\UseCase\ShowProfileEdit;

use App\Adapter\QueryService\UserQueryService;
use App\Domain\Entity\User;
use App\Domain\ValueObject\ProfileView;
use App\Lib\Session;
use App\Lib\Redirect;
use App\Domain\ValueObject\AuthUser;

final class ShowProfileEditInteractor implements ShowProfileEdit
{
    private $userQueryService;

    public function __construct(UserQueryService $userQueryService)
    {
        $this->userQueryService = $userQueryService;
    }

    public function handler(): ShowProfileEditOutput
    {
        $session = Session::getInstance();
        $authUser = $session->auth();

        if (is_null($authUser)) {
            Redirect::handler('/signin.php');
        }

        $user = $this->searchUser($authUser);

        if (is_null($user)) {
            Redirect::handler('/signin.php');
        }

        //TODO: 他のテーブルから情報取得しProfileViewに渡す
        $profileView = new ProfileView($user->name(), null, null, null, null);
        return new ShowProfileEditOutput($profileView);
    }

    private function searchUser(AuthUser $authUser): ?User
    {
        return $this->userQueryService->findById($authUser->userId());
    }
}
