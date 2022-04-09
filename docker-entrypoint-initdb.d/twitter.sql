CREATE DATABASE IF NOT EXISTS twitter;

USE twitter;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql
-- 生成日時: 2021 年 2 月 04 日 05:05
-- サーバのバージョン： 5.7.32-log
-- PHP のバージョン: 7.4.11

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `users`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users`
(
    `id`         int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '管理番号',
    `name`       varchar(15) NOT NULL COMMENT 'ユーザー名',
    `email`      varchar(255) NOT NULL COMMENT 'メールアドレス',
    `password`   varchar(255) NOT NULL COMMENT 'パスワード',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ユーザー情報';

-- --------------------------------------------------------

--
-- テーブルの構造 `tweets`
--

CREATE TABLE `tweets`
(
    `id`         int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '管理番号',
    `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
    `tweet`  varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ツイート',
    `reply_tweet_id` int(11) DEFAULT NULL COMMENT 'リプライツイートID',
    `device` text,
    `deleted_at` datetime DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='カテゴリ位置情報';

-- --------------------------------------------------------
