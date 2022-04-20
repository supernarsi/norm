# norm

## 创建 Model & Mapper 方法：

### 1. 创建数据库配置文件

在项目 vendor 同级目录下创建 `.norm-db.env` 文件，并修改相应参数（文件内容参考 `.norm-db.env.example`）

```dotenv
[DATABASE]
HOSTNAME =
DATABASE =
USERNAME =
PASSWORD =
HOSTPORT = 3306
```

### 2. 执行命令

在 vendor 目录执行以下命令，并根据提示输入相应参数

```shell
./bin/norm-create
```
