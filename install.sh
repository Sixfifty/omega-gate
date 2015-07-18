# #Set the mysql password to root
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

#Install the server software
sudo apt-get update
sudo apt-get install -y vim git curl nginx mysql-server php5-fpm php5-mysql php5-mcrypt php5-curl php5-cli

#Copy the config files
sudo cp /var/www/dev/fpm-php.ini /etc/php5/fpm/php.ini
sudo cp /var/www/dev/nginx-default /etc/nginx/sites-available/default

#Enable mcrypt
sudo php5enmod mcrypt

#Restart the services
sudo service php5-fpm restart
sudo service nginx restart

#Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer


cd /var/www;
composer install;

#Copy in the default environment
cp .env.example .env;

#Database setup...
mysql -u root -proot -e "CREATE DATABASE homestead; CREATE USER 'homestead'@'localhost' IDENTIFIED BY 'secret'; GRANT ALL ON homestead.* TO 'homestead'@'localhost';"
php /var/www/artisan migrate
php /var/www/artisan db:seed
php /var/www/artisan key:generate

#Make the 'vagrant ssh' command always open /var/www
echo "cd /var/www;" >> /home/vagrant/.profile

#Create a shortcut to the db
echo "alias db='mysql -uroot -proot homestead';" >> /home/vagrant/.profile
echo "alias mirs='php artisan migrate:refresh --seed';" >> /home/vagrant/.profile
