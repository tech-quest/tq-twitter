<?php

namespace App\Domain\Adapter;

interface Mailer
{
  public function __construct(string $subject, string $body);

  public function send(): void;
}
