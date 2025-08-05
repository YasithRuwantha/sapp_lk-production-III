# Script location should be at /var/www/html/venera/cms/agent/deployment.sh

cd /var/www/html/venera/cms/

chmod -R 777 ../cms

php spark migrate
php spark db:seed FileSeeder
php spark db:seed ConfigSeeder