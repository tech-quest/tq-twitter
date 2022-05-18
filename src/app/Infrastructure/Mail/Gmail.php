<?php

namespace App\Infrastructure\Mail;

use App\Domain\Adapter\Mailer;

final class Gmail implements Mailer
{
  private $subject;
  private $body;

  public function __construct(string $subject, string $body)
  {
    $this->subject = $subject;
    $this->body = $body;
  }

  public function send(): void
  {
  }
}
