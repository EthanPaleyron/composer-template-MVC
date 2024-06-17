# Name Project

<!-- ## Problems -->

## Use of [MVC model](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller), [Composer](https://getcomposer.org) and [SASS](https://sass-lang.com/).

## Project Installation

- Install the following software to proceed with the project installation:

  - **[WampServer](https://sourceforge.net/projects/wampserver/)**
  - **[Composer](https://getcomposer.org/download/)**

## Importing the Database into phpMyAdmin

- Launch **WampServer**.
- From the hidden applications menu, click on **WampServer**, then on **phpMyAdmin**.
- Create a database named **`gestion_hotel`** in **phpMyAdmin**.
- Import the **SQL** file located in the **DB** folder, named **`gestion_hotel.sql`**, into the **gestion_hotel** database.

### Composer Installation

- Generate the **Composer** autoloader:

```shell
composer dump-autoload
```

### Launching the Project

- Start WampServer if it is not already running to have access to the phpMyAdmin database.

- Launch a local server in the public folder:

```shell
php -S localhost:8000 -t ./public/
```

## Installing live-sass for SCSS

- Install the **[live-sass]("https://marketplace.visualstudio.com/items?itemName=ritwickdey.live-sass")** extension on **vscode**
- And click on `Watch Sass`
