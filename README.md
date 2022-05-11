# tq-twitter

# 環境構築手順

1. ローカルに `$ git clone` する
2. [Docker](https://www.docker.com/get-started/) のインストール
3. 環境の初期化を行う

```bash
$ make init
```

4. マイグレーション(DB の更新)を実行する

```bash
$ make migrate
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

1. .env ファイルの MAILTRAP_USERNAME に値を設定
2. .env ファイルの MAILTRAP_PASSWORD に値を設定
