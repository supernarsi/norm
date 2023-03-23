# 简介
Norm 是一个 PHP 语言编写的 ORM 库，它提供了一种方便的方法来连接数据库，并将对象映射到数据库表中。该库旨在提供简单易用的 API，让开发者可以轻松地创建和操作数据库。

# 安装
使用 Composer 安装：

```shell
composer require nineton-nasa/norm
```

# 创建 Model & Mapper

## 1. 创建数据库配置文件

在项目 vendor 同级目录下创建 `.norm-db.env` 文件，并修改相应参数（文件内容参考 `.norm-db.env.example`）

```dotenv
[DATABASE]
HOSTNAME=127.0.0.1
DATABASE=db
USERNAME=user
PASSWORD=pass
HOSTPORT=3306
```

## 2. 执行命令

在 vendor 目录执行以下命令，并根据提示输入相应参数

```shell
./bin/norm-create
```

# 功能
以下是 Norm ORM Library 的主要功能：

- 连接数据库
- 映射对象到数据库表
- 通过模型类访问数据库表中的数据
- 支持复杂的查询
- 支持事务处理

# 贡献者
Norm 是一个开源项目，欢迎所有开发者参与其中。如果您发现了任何错误或缺陷，请提交 issue 或 pull request。

# 许可
Norm 遵循 MIT 许可证。请参阅 LICENSE 文件以获取更多信息。
