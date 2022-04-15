# tq-twitter

# 環境構築手順

1. ローカルに git clone する
2. [Docker]() のインストール
3. 以下のコマンドで Docker コンテナの起動

```bash
$ ./docker-compose-local.sh up
```

# ドキュメント

[要件定義書・設計書](https://www.notion.so/Twitter-3333e77a9d8842789957ce3f23046446)

# ページ紹介

[ローカルサーバー](http://localhost:8080)

[PHPMyAdmin](http://localhost:3306)

# .env ファイル設定手順

1. src ディレクトリにある.env.example をコピー
2. コピーした.env.example のファイル名を.env に変更

# Mailtrap

[Mailtrap 設定方法](https://taupe.site/entry/mailtrap/)

$phpmailer->Username の値を .env MAILTRAP_USERNAME に設定
$phpmailer->Password の値を .env MAILTRAP_PASSWORD に設定
