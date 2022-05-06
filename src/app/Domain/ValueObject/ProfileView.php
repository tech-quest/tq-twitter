<?php

namespace App\Domain\ValueObject;

use Exception;
use DateTime;

final class ProfileView
{
  private $name;
  private $introduction;
  private $location;
  private $website;
  private $birthday;

  public function __construct(
    ?Name $name,
    ?string $introduction,
    ?string $location,
    ?string $website,
    ?DateTime $birthday
  ) {
    $this->name = $name;
    $this->introduction = $introduction;
    $this->location = $location;
    $this->website = $website;
    $this->birthday = $birthday;
  }

  public function name(): string
  {
    if (is_null($this->name)) return '';
    return $this->name->value();
    //TODO: php8.1にしたら以下にする
    // return $this->name?->value() ?? '';

  }

  public function birthday(): string
  {
    if (is_null($this->birthday)) return '';
    return $this->birthday->format('Y年m月d日');
    //TODO: php8.1にしたら以下にする
    // return $this->birthday?->format('Y年m月d日') ?? '';
  }
}
