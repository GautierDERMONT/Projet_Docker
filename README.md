Zunaid Mougaidinessaib  
Gautier Dermont  
Mennan Selvaruaban  
---
# PROJET LISTING DEPART 
```
git clone https://github.com/GautierDERMONT/Projet_Docker.git

docker-compose up -d --build

docker exec -it laravel_db  mysql -u root -p

mot de passe : secret

CREATE DATABASE projet_docker;

exit

docker exec -it laravel_app bash

php artisan key:generate

php artisan migrate
ou en cas d'erreur :
php artisan migrate:refresh

php artisan db:seed

copier et coller cela dans le navigateur : 127.0.0.1:8008 ou http://localhost:8008/

Pour arrêter :
docker-compose down

Pour relancer :
docker-compose up -d
```

