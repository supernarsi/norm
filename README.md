# Introduction

Norm is an ORM library written in PHP language. 
It provides a convenient way to connect to databases and map objects to database tables. 
The library aims to provide a simple and easy-to-use API, allowing developers to create and manipulate databases with ease.


# Installation

Install using Composer:

```shell
composer require nineton-nasa/norm
```

# Creating Model & Mapper

## 1. Create a Database Configuration File

Create a `.norm-db.env` file in the same directory as the vendor directory, and modify the corresponding parameters (file content reference `.norm-db.env.example`).

```dotenv
[DATABASE]
HOSTNAME=127.0.0.1
DATABASE=db-name
USERNAME=root
PASSWORD=pass
HOSTPORT=3306
```

## 2. Execute Commands

Execute the following commands in the vendor directory, and enter the corresponding parameters as prompted:

```shell
./bin/norm-create
```

# Features

The main features of Norm ORM Library are:
- Map objects to database tables
- Access data in database tables through model classes
- Support complex queries
- Support transaction processing

# Contributors

Norm is an open-source project, and all developers are welcome to participate. 
If you find any errors or defects, please submit an issue or pull request.

# License

Norm is licensed under the MIT license. See [LICENSE](LICENSE) for the full license text.
