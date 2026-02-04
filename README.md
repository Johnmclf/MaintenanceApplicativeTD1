# Installation et Mise en route

## Prérequis

- Docker et Docker Compose
- PHP et Composer (uniquement pour les tests et l'analyse statique)

## Démarrage

1. Cloner le projet.
2. Lancer les conteneurs :

   ```bash
   docker-compose up -d --build
   ```

### Base de données

1. Exécuter les migrations :

   ```bash
   docker exec -it apache_php php migrate.php
   ```

## Accès

- Application : http://localhost:8080
- PhpMyAdmin : http://localhost:8081

## Tests et Qualité

Ces commandes s'exécutent localement.

1. Installer les dépendances :

   ```bash
   composer install
   ```

2. Lancer les tests unitaires :

   ```bash
   DB_HOST=127.0.0.1 ./vendor/bin/phpunit tests
   ```

3. Lancer l'analyse statique (PHPStan) :
   ```bash
   ./vendor/bin/phpstan analyse src tests --level 3
   ```
