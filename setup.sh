echo "Exécution des commandes..."

# bdd
docker exec laravel_db mysql -u root -psecret -e "CREATE DATABASE IF NOT EXISTS projet_docker;"
docker exec laravel_db mysql -u root -psecret -e "CREATE DATABASE IF NOT EXISTS projet_docker_test;"
docker exec laravel_db mysql -u root -psecret -e "GRANT ALL PRIVILEGES ON projet_docker_test.* TO 'laravel_user'@'%';"
docker exec laravel_db mysql -u root -psecret -e "FLUSH PRIVILEGES;"

# laravel
docker exec laravel_app composer update
docker exec laravel_app php artisan key:generate
docker exec laravel_app php artisan migrate
docker exec laravel_app php artisan db:seed
docker exec laravel_app php artisan test


echo "✅ Commandes exécutées !"