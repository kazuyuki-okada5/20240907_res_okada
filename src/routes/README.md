# アプリケーション名
	　飲食店予約アプリ

# 作成した目的
	　飲食店の予約を管理するためのシステム

# アプリケーションURL
　管理者ログイン時はメールアドレス：aaaa　パスワード：aaaaaaaa

# 機能一覧
	　店舗一覧ページ
	　店舗詳細ページ
	　ログイン機能
	　ユーザー登録機能
	　エリア・ジャンル・ワードによる店舗検索機能
	　ユーザーお気に入り登録機能
	　店舗予約機能
	　バリデーション機能（認証と予約はFormRequest使用）
	　レスポンシブデザイン
	　マイページより予約変更機能（「✖️」で予約削除、変更で予約変更フォームより変更）
	　評価機能（マイページより予約日を過ぎた予約に評価機能追加）
	　管理画面（ロール認証）
	　管理者機能
	　　管理者画面メインページ下部の「管理者ページへ」ボタンで店舗代表者登録及び店舗編集権限付与
	　　追加で店舗権限の関連付け機能
	　　下部お知らせリンクでお知らせ内容作成後送信でユーザー全員にお知らせ一斉送信
	　店舗代表者機能
	　　店舗代表者画面メインページ下部の「店舗代表者ページへ」ボタンで店舗情報の新規登録及び管理者
	　に権限付与されている店舗が表示され、各店舗の「編集する」ボタンで編集画面表示され編集可能。
	　　編集後「更新」ボタンで更新完了する。

# テーブル設計
	usersテーブル（登録）
	カラム名        　型	            PRIMARY KEY	    UNIQUE KEY	NOT NULL	FOREIGN KEY
	id	           　unsigned bigint	　○		                   　 ○
	name	        varchar(255)			                        ○
	mail_address	varchar(255)		                    ○	    ○
	password	    varchar(255)		                        	○
	created_at	    timestamp
	updated_at	    timestamp

	storesテーブル（店舗）
	カラム名	        型	            PRIMARY KEY	    UNIQUE KEY	NOT NULL	FOREIGN KEY
	id	                unsigned bigint	    ○		                  ○
	name	            varchar(255)		                          ○
	area_id         	unsigned bigint		                          ○       	areas(id)
	genre_id        	unsigned bigint		                          ○	        genres(id)
	store_overview     	text			                              ○
	image_url          	varchar(255)			                      ○
	created_at      	timestamp
	updated_at      	timestamp

	areasテーブル（地域）
	カラム名	        型             	PRIMARY KEY 	UNIQUE KEY	NOT NULL	FOREIGN KEY
	id              	unsigned bigint	    ○                   	  ○
	area            	varchar(255)			                      ○
	created_at      	timestamp
	updated_at      	timestamp

	genresテーブル（ジャンル）
	カラム名	        型          	PRIMARY KEY	    UNIQUE KEY	NOT NULL	FOREIGN KEY
	id	                unsigned bigint    	○                   	  ○
	genre           	varchar(255)			                      ○
	created_at         	timestamp
	updated_at      	timestamp

	favoritesテーブル(お気に入り）
	カラム名        	型          	PRIMARY KEY 	UNIQUE KEY	NOT NULL	FOREIGN KEY
	id              	unsigned bigint 	○                   	  ○
	user_id         	unsigned bigint			                      ○     	users(id)
	store_id        	unsigned bigint			                      ○     	stores(id)
	created_at      	timestamp
	updated_at      	timestamp

	reservationsテーブル（予約）
	カラム名	        型             	PRIMARY KEY 	UNIQUE KEY	NOT NULL	FOREIGN KEY
	id              	unsigned bigint    	○                   	  ○
	user_id         	unsigned bigint			                      ○     	users(id)
	store_id        	unsigned bigint			                      ○     	stores(id)
	start_at        	datetime			                          ○
	number_of_people	Integer			                              ○
	created_at      	timestamp
	updated_at      	timestamp

	evaluationsテーブル（評価）
	カラム名        	型          	PRIMARY KEY 	UNIQUE KEY	NOT NULL	FOREIGN KEY
	id              	unsigned bigint	     ○                  	  ○
	reservation_id  	unsigned bigint			                      ○     	reservations(id)
	rating          	Integer                            			  ○
	comment         	text			                              ○
	created_at      	timestamp
	updated_at      	timestamp

	users_storesテーブル（店舗代表者店舗）
	カラム名	        型          	PRIMARY KEY 	UNIQUE KEY	NOT NULL	FOREIGN KEY
	id                 	unsigned bigint     ○                   	  ○
	representative_id	unsigned bigint			                      ○    	    representatives(id)
	store_id        	Integer                             	      ○     	stores(id)
	created_at	        timestamp
	updated_at	        timestamp

# ER図
　https://docs.google.com/spreadsheets/d/1t10kDiHte8iT4K38IrfgD2TRnGLOOVzZAmaw8B5qePE/edit#gid=1270192593
　　内、ER図シート参照

# 環境構築
　フレームワークはLaravelバージョン8を使用する
Dockerfile
# PHPコンテナをベースにする
FROM php:7.4.9-fpm

# PHP関連の設定
COPY php.ini /usr/local/etc/php/
RUN apt update \
&& apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
&& docker-php-ext-install pdo_mysql zip

# Composerのインストールと設定
RUN curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer \
&& composer self-update

# Node.jsのインストールと設定
RUN apt-get update && apt-get install -y \
curl \
&& curl -sL https://deb.nodesource.com/setup_16.x | bash - \
&& apt-get install -y nodejs

# npmパッケージをインストール
RUN npm install -g npm@10.2.4

docker-compsoe.yml

	version: '3.8'

	services:
	nginx:
	image: nginx:1.21.1
	ports:
	- "80:80"
	volumes:
	- ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
	- ./src:/var/www/
	depends_on:
	- php

	php:
	build: ./docker/php
	volumes:
	- ./src:/var/www/

	mysql:
	image: mysql:8.0.26
	environment:
	MYSQL_ROOT_PASSWORD: root
	MYSQL_DATABASE: laravel_db
	MYSQL_USER: laravel_user
	MYSQL_PASSWORD: laravel_pass
	command:
	mysqld --default-authentication-plugin=mysql_native_password
	volumes:
	- ./docker/mysql/data:/var/lib/mysql
	- ./docker/mysql/my.cnf:/etc/mysql/conf.d/my.cnf

	phpmyadmin:
	image: phpmyadmin/phpmyadmin
	environment:
	- PMA_ARBITRARY=1
	- PMA_HOST=mysql
	- PMA_USER=laravel_user
	- PMA_PASSWORD=laravel_pass
	depends_on:
	- mysql
	ports:
	- 8080:80

	mailhog:
	image: mailhog/mailhog
	ports:
	- "8025:8025" # メールのWebインターフェース用のポート
	- "1025:1025" # SMTPサーバー用のポート

composer.json
	{
	"name": "laravel/laravel",
	"type": "project",
	"description": "The Laravel Framework.",
	"keywords": ["framework", "laravel"],
	"license": "MIT",
	"require": {
	"php": "^7.4",
	"fruitcake/laravel-cors": "^2.0",
	"guzzlehttp/guzzle": "^7.0.1",
	"laravel/fortify": "^1.19",
	"laravel/framework": "^8.75",
	"laravel/sanctum": "^2.11",
	"laravel/tinker": "^2.5",
	"laravel/ui": "^3.4"
	},
	"require-dev": {
	"facade/ignition": "^2.5",
	"fakerphp/faker": "^1.9.1",
	"laravel-lang/lang": "~7.0",
	"laravel/sail": "^1.0.1",
	"mockery/mockery": "^1.4.4",
	"nunomaduro/collision": "^5.10",
	"phpunit/phpunit": "^9.5.10"
	},
	"autoload": {
	"psr-4": {
	"App\\": "app/",
	"App\\Http\\Controllers\\": "app/Http/Controllers/",
	"Database\\Factories\\": "database/factories/",
	"Database\\Seeders\\": "database/seeders/"
	}
	},
	"autoload-dev": {
	"psr-4": {
	"Tests\\": "tests/"
	}
	},
	"scripts": {
	"post-autoload-dump": [
	"Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
	"@php artisan package:discover --ansi"
	],
	"post-update-cmd": [
	"@php artisan vendor:publish --tag=laravel-assets --ansi --force"
	],
	"post-root-package-install": [
	"@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
	],
	"post-create-project-cmd": [
	"@php artisan key:generate --ansi"
	]
	},
	"extra": {
	"laravel": {
	"dont-discover": []
	}
	},
	"config": {
	"optimize-autoloader": true,
	"preferred-install": "dist",
	"sort-packages": true
	},
	"minimum-stability": "dev",
	"prefer-stable": true
	}

env.example
	APP_NAME=Laravel
	APP_ENV=local
	APP_KEY=
	APP_DEBUG=true
	APP_URL=http://localhost

	LOG_CHANNEL=stack
	LOG_DEPRECATIONS_CHANNEL=null
	LOG_LEVEL=debug

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=laravel
	DB_USERNAME=root
	DB_PASSWORD=

	BROADCAST_DRIVER=log
	CACHE_DRIVER=file
	FILESYSTEM_DRIVER=local
	QUEUE_CONNECTION=sync
	SESSION_DRIVER=file
	SESSION_LIFETIME=120

	MEMCACHED_HOST=127.0.0.1

	REDIS_HOST=127.0.0.1
	REDIS_PASSWORD=null
	REDIS_PORT=6379

	MAIL_MAILER=smtp
	MAIL_HOST=mailhog
	MAIL_PORT=1025
	MAIL_USERNAME=null
	MAIL_PASSWORD=null
	MAIL_ENCRYPTION=null
	MAIL_FROM_ADDRESS=null
	MAIL_FROM_NAME="${APP_NAME}"

	AWS_ACCESS_KEY_ID=
	AWS_SECRET_ACCESS_KEY=
	AWS_DEFAULT_REGION=us-east-1
.env	AWS_BUCKET=
	AWS_USE_PATH_STYLE_ENDPOINT=false

	PUSHER_APP_ID=
	PUSHER_APP_KEY=
	PUSHER_APP_SECRET=
	PUSHER_APP_CLUSTER=mt1

	MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
	MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

	DB_CONNECTION=mysql
	DB_HOST=mysql
	DB_PORT=3306
	DB_DATABASE=laravel_db
	DB_USERNAME=laravel_user
	DB_PASSWORD=laravel_pass

	BROADCAST_DRIVER=log
	CACHE_DRIVER=file
	FILESYSTEM_DRIVER=local
	QUEUE_CONNECTION=sync
	SESSION_DRIVER=file
	SESSION_LIFETIME=120

	MEMCACHED_HOST=127.0.0.1

	REDIS_HOST=127.0.0.1
	REDIS_PASSWORD=null
	REDIS_PORT=6379

	MAIL_MAILER=smtp
	MAIL_HOST=mailhog
	MAIL_PORT=1025
	MAIL_USERNAME=null
	MAIL_PASSWORD=null
	MAIL_ENCRYPTION=null
	MAIL_FROM_ADDRESS=null
	MAIL_FROM_NAME="${APP_NAME}"

	AWS_ACCESS_KEY_ID=
	AWS_SECRET_ACCESS_KEY=
	AWS_DEFAULT_REGION=us-east-1
	AWS_BUCKET=
	AWS_USE_PATH_STYLE_ENDPOINT=false

	PUSHER_APP_ID=
	PUSHER_APP_KEY=
	PUSHER_APP_SECRET=
	PUSHER_APP_CLUSTER=mt1

	MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
	MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"