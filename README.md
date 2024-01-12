# Création d'une Todo liste

**Prérequis**: Base PHP, les objets, le modèle MVC, la validation

**Objectif**: Savoir utiliser toutes les connaissances jusque là accumulé (voir prérequis)

Dans cet exercice, nous allons créer une app qui permettra aux utilisateur de s'inscrire et de créer des todo listes.

## Etape 1 - La structure de fichiers

Notre application aura la stucture suivante

```
TodoList
    public/
        index.php
        style.css
    src/
        Controllers/
            UserController.php
            TodoController.php
        Models/
            User.php
            Todo.php
            Task.php
            UserManager.php
            TodoManager.php
            TaskManager.php
        Views/
            Auth/
                login.php
                register.php
            Todo/
                index.php
                show.php
                create.php
        Router.php
```

## Etape 2 - Composer et l'autoloading

- Initialiser le dossier comme étant un projet composer

```shell
$ composer init  # crée le fichier composer.json
$ composer install # install l'autoloader
```

- Remplir le fichier composer avec la règle d'autoloading

```json
"autoload": {
    "psr-4": {
        "RootName\\": "src/"
    }
}
```

- Réinitialiser l'autoloader

```shell
$ composer dump-autoload
```

//lancer php -S localhost:8000 dans le dossier public

## Etape 3 - Le router



Voici une liste de route que l'on peut implementer:

- "/dashboard/{todo}task/{task}, GET => montre le détail d'une tache
- "/dashboard/task/nouveau, GET => création d'une tache
- "/dashboard/task/nouveau, POST => crée la tache en base dde données
- "/dashboard/{todo}/task/{task}, POST => met en jour la tache
- "/dashboard/{todo}/task/{task}/delete => supprime la tache

## Etape 3 - Les Models

Création des entitées  `Task` et des managers  `TaskManager``

Pour les manager, on va pouvoir implementer les methodes:

- `find($name, $listid)` => retrouve une entité grâce à son id
- `check($slug)` => retrouve une entité grâce à n'importe quel champs renseigné
- `getall($id)` => retrouve toutes les entité
- `store()` => enregistre une entité
- `update($param)` => met à jour une entité
- `delete($param)`=> supprime une entité

## Etape 4 - Le controller

Créer un `TodoController` avec les methodes suivante:


- `store()`=> enregistre la todoliste
- `check($param)` => formulaire pour editer la todoliste
- `update($param)`=> met à jour la todoliste
- `delete($param)`=> supprime la todo liste

## Etape 5 - Les views

Création des vues avec le framework css de votre choix


- "index" => montre toutes les todo liste avec leur tache
- "show" => montre une seule todo liste avec ses taches
- "create task" => montre le formulaire de création d'une tache
- "edit" => montre le formulaire d'edition d'une tache 
