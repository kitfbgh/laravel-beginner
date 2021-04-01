# Laravel beginner

## 運行環境需求

參照官方文件 [Laravel 6 requirements](https://laravel.com/docs/6.x#server-requirements) 可達最低運行需求。

## 必要工具

- Docker
- Docker Compose

## 建置
- 建立 Laravel 專案
```bash=
$ composer create-project --prefer-dist laravel/laravel 104-project "6.*"

$ cd 104-project
```
- 下載 Laradock repo
```bash=
$ git clone https://github.com/Laradock/laradock.git

$ cd laradock
```
- 複製env-example內容到.env
```bash=
$ cp env-example .env
```
- run containers
```bash=
$ docker-compose up -d nginx mysql redis workspace
```
- 回到專案目錄，複製.env.example內容到.env
```bash=
$ cd ..

$ cp .env.example .env
```
- 產生APP_KEY
```bash=
$ php artisan key:generate
```

## 本地測試
- [localhost](http://localhost)

## API文件
```
/api/documentation
```


