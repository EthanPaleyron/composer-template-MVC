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
        "RootName\\": "src/"
    }
}
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
composer dump-autoload
```
