<?php

namespace App\Adapter\QueryService;

use App\Domain\Entity\User;
use App\Infrastructure\Dao\ProfileBirthdaysDao;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\ProfileBirthdayId;
use App\Infrastructure\Dao\ProfileIntroductionsDao;
use App\Infrastructure\Dao\ProfilePlacesDao;
use App\Infrastructure\Dao\ProfileWebsitesDao;
use App\Domain\ValueObject\ProfileView;
use App\Infrastructure\Dao\UserDao;
use DateTime;

final class ProfileQueryService
{
    private $profileBirthdayDao;
    private $profileIntroductionsDao;
    private $profilePlacesDao;
    private $profileWebsiteDao;
    private $userDao;

    public function __construct()
    {
        $this->profileBirthdayDao = new ProfileBirthdaysDao();
        $this->profileIntroductionsDao = new ProfileIntroductionsDao();
        $this->profilePlacesDao = new ProfilePlacesDao();
        $this->profileWebsiteDao = new ProfileWebsitesDao();
        $this->userDao = new UserDao();
    }

    public function findById(UserId $id): ProfileView
    {
        $profileBirthdayMapper = $this->profileBirthdayDao->findByUserId($id);
        $profileIntroductionMapper = $this->profileIntroductionsDao->findByUserId(
            $id
        );
        $profilePlacesMapper = $this->profilePlacesDao->findByUserId($id);
        $profileWebsiteMapper = $this->profileWebsiteDao->findByUserId($id);
        $userMapper = $this->userDao->findById($id->value());
        $birthday = is_null($profileBirthdayMapper)
            ? null
            : new DateTime($profileBirthdayMapper['birthday']);

        return new ProfileView(
            new Name($userMapper['name']),
            $profileIntroductionMapper['introduction'] ?? null,
            $profilePlacesMapper['place'] ?? null,
            $profileWebsiteMapper['website'] ?? null,
            $birthday
        );
    }
}
