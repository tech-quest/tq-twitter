<?php

namespace App\Adapter\Mail;

use App\Domain\Adapter\Mailer;
use App\Infrastructure\Mail\MailTrap;
use App\Infrastructure\Mail\Gmail;

final class MailerFactory
{
  public static function create(string $subject, string $body): Mailer
  {
    // if ($_ENV['env'] === 'production') {
    //   return new Gmail($subject, $body);
    // }
    return new MailTrap($subject, $body);
  }
}
