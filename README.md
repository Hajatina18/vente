1. Créer une base de données nomée `vente`
2. Lancer l'installation du vendor du projet avec `composer install`
3. Executer la commande `php artisan migrate` dans le cmd
4. Créer deux utilisateur en tapant la commande `php artisan db:seed --class=UserSeeder`
5. Créer un lien de storage `php artisan storage:link`
6. User
    ```
        Admin : [
            username : aratomg
            password : arato
        ]
        Vente : [
            username : francki
            password : arato
        ]
    ```