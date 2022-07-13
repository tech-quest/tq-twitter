<?php

namespace App\Domain\ValueObject;

use Exception;
use DateTime;

/**
 * Database で取り扱う日付の値オブジェクト
 */
final class DateTimeInDB
{
  const INVALID_MESSAGE = '日時の形式が正しくありません';
  const DEFAULT_FORMAT = 'Y-m-d H:i:s';

  /** @var string */
  private string $value;

  /**
   * @param string $value
   */
  public function __construct(string $value)
  {
    if (empty($value) || $this->isInvalidFormat($value)) {
      throw new Exception(self::INVALID_MESSAGE);
    }
    $this->value = $value;
  }

  /**
   * Value値を取得
   * @return string
   */
  public function value(): string
  {
    return $this->value;
  }

  /**
   * 日時形式チェック
   * @param string $value
   * @return bool
   */
  private function isInvalidFormat(string $value): bool
  {
    $datetime = DateTime::createFromFormat(self::DEFAULT_FORMAT, $value);
    return !$datetime || $datetime->format(self::DEFAULT_FORMAT) != $value;
  }
}
