<?php

namespace App\Domain\ValueObject;

use Exception;

final class Name
{
    private $value;

    public function __construct(string $value)
    {
        if ($value > 5) {
            throw new Exception('Nameは1以上,5以下で指定してください');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
