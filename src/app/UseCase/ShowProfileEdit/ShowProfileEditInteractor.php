<?php

namespace App\UseCase\ShowProfileEdit;

use App\Lib\Session;
use App\Lib\Redirect;
use App\Adapter\QueryService\ProfileQueryService;

final class ShowProfileEditInteractor implements ShowProfileEdit
{
    private $profileQueryService;

    public function __construct(ProfileQueryService $profileQueryService)
    {
        $this->profileQueryService = $profileQueryService;
    }

    public function handler(): ShowProfileEditOutput
    {
        $session = Session::getInstance();
        $authUser = $session->auth();

        if (is_null($authUser)) {
            Redirect::handler('/signin.php');
        }

        $profileView = $this->profileQueryService->findById(
            $authUser->userId()
        );

        return new ShowProfileEditOutput($profileView);
    }
}
