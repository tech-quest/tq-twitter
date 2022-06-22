<?php

namespace App\Adapter\Mail;

use App\Domain\Adapter\Mailer;
use App\Infrastructure\Mail\MailTrap;

final class MailerFactory
{
    public static function create(string $subject, string $body): Mailer
    {
        return new MailTrap($subject, $body);
    }
}
