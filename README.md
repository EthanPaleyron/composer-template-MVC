# Name Project

<!-- ## Problems -->

## Use of [MVC model](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller), [Composer](https://getcomposer.org) and [SASS](https://sass-lang.com/).

## Project Installation

- Install the following software to proceed with the project installation:

  - **[WampServer](https://sourceforge.net/projects/wampserver/)**
  - **[Composer](https://getcomposer.org/download/)**

## Importing the Database into phpMyAdmin

- Launch **WampServer**.
- From the hidden applications, click on **WampServer**, then on **phpMyAdmin**.
- Create a database named **`gestion_hotel`** in **phpMyAdmin**.
- Import the **SQL** file located in the **DB** folder, named **`gestion_hotel.sql`**, into the **gestion_hotel** database.

### Composer Installation

- Generate the **Composer** autoloader:

```shell
composer dump-autoload
```

### Lancement du projet

- Start WampServer if not already running to have the **`phpMyAdmin`** database.

- Navigate to the **`public`** folder via the terminal:

```shell
cd .\public\
```

- Launch a local server in the public folder:

## Installing live-sass for SCSS

- Install the **[live-sass]("https://marketplace.visualstudio.com/items?itemName=ritwickdey.live-sass")** extension on **vscode**
- And click on `watch sass`
