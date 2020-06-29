# career-board
経歴の一覧機能

## 必要なもの

* Docker

### 開発環境セットアップ手順

```
docker-compose up -d --build
docker-compose exec app ash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
exit
```

### アクセス
- 以下のURLにアクセスし、laravelの初期表示画面が正常に表示されることの確認

[http://localhost:10080]


## その他コマンド

### 開発環境コマンド

- コンテナ起動
docker-compose start

- コンテナ停止
docker-compose stop

- コンテナ削除
docker-compose down

- コンテナの中に入る
docker-compose exec app ash

- データベースのアクセス
docker-compose exec db bash -c 'mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE}'
