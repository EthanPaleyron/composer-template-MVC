# How this repository works

**Prerequisites** : PHP basis, POO (object-oriented), MVC (Model-View-Controller), the validation

## Install Composer

- **[WampServeur](https://sourceforge.net/projects/wampserver/)**
- **[Composer](https://getcomposer.org/download/)**

## Composer and autoloading

- Initialize the folder as a compose project

```shell
composer init  # create file composer.json
composer install # install l'autoloader
```

- Fill the composer file with the autoloading rule

```json
"autoload": {
    "psr-4": {
        "Project\\": "src/"
    }
}
```

- In the `config.php` add the name of your DB

```php
define("SRC", '../src/');
define("CONTROLLERS", '../src/Controllers/');
define("MODELS", '../src/Models/');
define("VIEWS", '../src/Views/');

define('HOST', '127.0.0.1');
define('DATABASE', 'NAME_DB'); // the name of your DB
define('USER', 'root');
define('PASSWORD', '');
```

- Reset autoloader

```shell
composer dump-autoload
```

- Run php -S localhost:8000 in the public folder

```shell
cd .\public\
```

```shell
php -S localhost:8000
```

## SASS | SCSS

- Install the **[live-sass]("https://marketplace.visualstudio.com/items?itemName=ritwickdey.live-sass")** extension on **vscode**
- And click on `watch sass`
