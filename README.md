# 確認テスト

## 環境構築
Dockerビルド
1. git clone git@github.com:Takaaki39/confirmation-test.git
2. docker-compose up -d --build

※MySQLはOSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. cp .env.example .env
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術(実行環境)
- php 8.1
- Laravel 10.0
- MySQL 8.0.26

## ER図
< - - - 作成したER図の画像 - - - >

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
