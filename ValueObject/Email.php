<?php

final class Email
{
    public function __construct(string $value)
    {
        if (empty($value)) throw new Exception("値を入力してください");

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
