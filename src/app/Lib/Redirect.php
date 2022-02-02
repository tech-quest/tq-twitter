<?php

namespace App\Lib;

/**
 * リダイレクトを扱うクラス
 */
final class Redirect
{
    /**
     * 実行関数
     *
     * @param string $path リダイレクト先のパス
     */
    public static function handler(string $path): void
    {
        header('Location: ' . $path);
        die();
    }
}
