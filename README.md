**Management Package**
--

Ever had a waste of time having to create models and controllers for some parts of the project and write down all seven controller functions or copy and paste from another controller and change it? 

This package create model, migration, controller, factory, seeder and routes with their default codes

The package purpose is avoid wasting time.

----
## 1: Setup

`composer require daniyal2959/management`

## 2: Launch

The main command is `php artisan crud:create`. if you want to set migration structure use `--scheme` option as below:

### Options

* **--scheme**= (optional) : this option create migration structure. this structure is:

`php artisan crud:create --scheme=<name>:<type>:<size>:<nullable>`

Explain:

1. First parameter is the name of the column
1. Second parameter is the column type
1. Third parameter is the column size
1. Fourth parameter is the column nullable -> default set Not Null

This is a sample for more information:

`php artisan crud:create --scheme=title:string:30,likes:integer:10:nullable`

* **--seed=** (optional) : this option create factory and seeder. if you want to create factory and seeder use this option. this structure is:

`php artisan crud:create --seed=<seed-count>`

Explain:

1. this parameter set how many fake data you want to create.

This is a sample for more information:

`php artisan crud:create --seed=300`
