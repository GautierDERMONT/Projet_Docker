#!/bin/bash
exec > >(tee -a setup.log) 2>&1  

echo "🚀 Début de l'installation et configuration..."


echo "⏳ Attente du démarrage des containers (20s)..."
sleep 20


echo "🔧 Configuration des bases de données..."
docker exec laravel_db mysql -u root -psecret -e "CREATE DATABASE IF NOT EXISTS projet_docker;"
docker exec laravel_db mysql -u root -psecret -e "CREATE DATABASE IF NOT EXISTS projet_docker_test;"
docker exec laravel_db mysql -u root -psecret -e "GRANT ALL PRIVILEGES ON projet_docker_test.* TO 'laravel_user'@'%';"
docker exec laravel_db mysql -u root -psecret -e "FLUSH PRIVILEGES;"


echo "📦 Installation des dépendances Laravel..."
docker exec laravel_app composer install --no-interaction --optimize-autoloader
docker exec laravel_app php artisan key:generate --force


echo "🔄 Exécution des migrations..."
docker exec laravel_app php artisan migrate --force
docker exec laravel_app php artisan db:seed --force


echo "🧪 Exécution des tests PHPUnit..."
docker exec laravel_app php artisan test


echo "🌅 Installation de Laravel Dusk..."
if ! docker exec laravel_app composer require --dev laravel/dusk --no-interaction; then
    echo "❌ Échec de l'installation de Laravel Dusk"
    exit 1;
fi
if ! docker exec laravel_app php artisan dusk:install; then
    echo "❌ Échec de l'installation de Dusk"
    exit 1;
fi
docker exec laravel_app rm tests/Browser/ExampleTest.php



echo "🔍 Vérification de l'installation Dusk..."
docker exec laravel_app php artisan dusk --help | grep -q dusk || {
    echo "❌ La commande Dusk n'est pas disponible"
    exit 1;
}


echo "⏳ Attente que Selenium soit prêt (15s)..."
sleep 15


echo "🌐 Exécution des tests Dusk..."
if ! docker exec laravel_app php artisan dusk --debug; then
    echo "❌ Les tests Dusk ont échoué"
    exit 1;
fi

echo "✅ Toutes les commandes ont été exécutées avec succès !"
echo "🖥️  Application disponible sur http://localhost:8008"

