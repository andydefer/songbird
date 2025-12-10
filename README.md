# Songbird

**Songbird** est un package Laravel pour gérer les fonctionnalités Songbird dans vos applications Laravel. Il fournit des routes, des migrations, une configuration et une façade pour une utilisation facile.

## Installation

Installez le package via Composer :

```bash
composer require andydefer/songbird
````

Le package utilise la **découverte automatique de Laravel**, donc vous n'avez pas besoin d'ajouter le fournisseur de services ou la façade manuellement.

## Publication des fichiers

Pour publier les fichiers de configuration, migrations, routes et tests, utilisez la commande artisan suivante :

```bash
php artisan vendor:publish --tag=songbird
```

Cela va créer :

* `config/songbird.php`
* `database/migrations/`
* `routes/songbird/`
* `tests/Packages/Songbird/`

## Routes

Les routes sont automatiquement chargées depuis `routes/web.php` dans votre package. Vous pouvez personnaliser ou ajouter de nouvelles routes dans le dossier `routes/songbird/`.

## Configuration

Le fichier de configuration `config/songbird.php` vous permet de modifier les paramètres du package.

## Utilisation de la façade

Vous pouvez utiliser la façade **Songbird** directement dans votre code :

```php
use Songbird;

Songbird::someMethod();
```

## Migration

Les migrations sont automatiquement chargées, mais vous pouvez les exécuter avec :

```bash
php artisan migrate
```

## License

Ce package est sous licence **MIT**.

```
