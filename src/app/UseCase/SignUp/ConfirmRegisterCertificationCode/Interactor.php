<?php

namespace App\UseCase\SignUp\ConfirmRegisterCertificationCode;

use App\Infrastructure\Dao\UserRegisterCertificationCodeDao;
use App\UseCase\SignUp\ConfirmRegisterCertificationCode\Input;
use App\UseCase\SignUp\ConfirmRegisterCertificationCode\Output;
use App\Domain\ValueObject\Certification;

final class Interactor
{
    private const CONFIRM_MESSAGE = '認証コードが見つかりました。';
    private const NOT_CONFIRM_MESSAGE = '認証コードが見つかりませんでした。';
    private Input $input;

    public function __construct(Input $input)
    {
        $this->userRegisterCertificationCodeDao = new UserRegisterCertificationCodeDao();
        $this->input = $input;
    }

    public function handler(): Output
    {
        if ($this->findByRegisterCertificationCode()) {
            return new Output(false, self::NOT_CONFIRM_MESSAGE);
        }
        return new Output(true, self::CONFIRM_MESSAGE);
    }

    private function findByRegisterCertificationCode(): bool
    {
        $certificationCode = new Certification($this->input->email());
        $hash = $certificationCode->generateHashByVerificationCode($this->input->code());
        $code = $this->userRegisterCertificationCodeDao->findByRegisterCertificationCode(
            $hash
        );
        return is_null($code);
    }
}
