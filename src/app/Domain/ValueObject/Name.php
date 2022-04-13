<?php

namespace App\Domain\ValueObject;

use Exception;

final class Name
{
  private $value;

  public function __construct(string $value)
  {
    $this->value = $value;
  }

  public function value(): string
  {
    return $this->value;
  }
}
