# ゴルフ場DBメンテナンスシステム

## 概要
ゴルフ場のデータを一元管理するための社内向けマスタ管理システムです。

## 使用技術
- PHP 8.5.1
- Laravel 13
- MySQL 8.4
- Laravel Sail（Docker開発環境）

## セットアップ手順

### 1. リポジトリをクローン

```bash
git clone https://github.com/waya-kkazuya/golf-course-admin.git
cd golf-course-admin
```

### 2. 環境変数ファイルを作成

```bash
cp .env.example .env
```

### 3. Composerパッケージをインストール

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Sailを起動

```bash
./vendor/bin/sail up -d
```

#### sailコマンドのエイリアスを設定すると便利です（任意）

```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

以降は`sail`コマンドで実行できます。

### 5. アプリケーションキーを生成

```bash
sail artisan key:generate
```

### 6. マイグレーションとダミーデータを投入

```bash
sail artisan migrate:fresh --seed
```

※インデックスの効果を検証するために、5,000件のゴルフ場のダミーデータが自動生成されます。少し時間がかかります。

### 7. シンボリックリンクを作成

```bash
sail artisan storage:link
```

### 8. ブラウザでアクセス

```
http://localhost:8000
```
