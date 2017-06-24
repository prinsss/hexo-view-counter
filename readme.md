# Post View Counter for Hexo

基于 Lumen 框架编写的 Hexo 博客访问计数器。

A post view counter for Hexo blog built on Lumen.

## 快速安装 / Quick Install

从 GitHub 上下载源码并在 `.env` 文件中配置你的数据库连接，支持 MySQL 和 SQLite。

Download source code from GitHub and configure your database connection in `.env` file (both MySQL and SQLite are supported):

```
$ git clone https://github.com/printempw/hexo-view-counter.git
$ composer install
$ cp .env.example .env
```

运行数据库迁移程序来创建数据表。

Then run run database migration to create tables:

```
$ php artisan migrate
```

配置你的 Nginx 服务器（Apache 用户不需要进行任何操作）。

Configure your Nginx server (Apache users doesn't need to do anything extra):

```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

# Protect .env file if necessary
location ~ /\.env {
    deny all;
}
```

访问 `http://your-domain/`，安装成功后即可看到欢迎页面。

Navigate to `http://your-domain/`, you can see a welcome page if you have installed it successfully.

## 文档 / Documentation

GET 请求 `http://your-domain/get/{slug}` 来获取指定文章的访问数量（`slug` 为文章唯一标识符）。

Make a GET request to `http://your-domain/get/{slug}` to get the post views of a specific post (`slug` is the unique identification for each post).

POST 请求 `http://your-domain/increase/{slug}` 来递增指定文章的访问数量，如果 `slug` 不存在将会重新创建一个记录。

Make a POST request to `http://your-domain/increase/{slug}` to increase the post views of a specific post (a new record will be created if given `slug` does no exist).

GET 请求 `http://your-domain/popular-posts` 来获取 JSON 格式的热门文章（通过 PV 数倒序排列），可使用 `?limit=20` 来限制输出的文章数量。

Make a GET request to `http://your-domain/popular-posts` to get the popular posts in JSON format (sorting by pv desc), the parameter `?limit=20` can be used to limit the amount of posts.

## 许可证 / License

本程序是基于 GUN General Public License v3.0 协议开放源代码的自由软件。

The `hexo-view-counter` is open-sourced software licensed under the GUN General Public License v3.0.
