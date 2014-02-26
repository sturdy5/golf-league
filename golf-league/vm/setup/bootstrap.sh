#!/usr/bin/env bash

sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password vagrant'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password vagrant'

sudo apt-get update
sudo apt-get -y install mysql-server-5.5 php5-mysql apache2 php5
sudo apt-get install -y libapache2-mod-php5
sudo apt-get install -y libapache2-mod-auth-mysql

# initialize the database if the initialize script exists
if [ -f /vagrant/mysql/initialize.sql ];
then
  echo "create user 'wtfo'@'localhost' identified by 'JZEcZd6XJNCK5BXw'" | mysql -uroot -pvagrant
  echo "create database wtfo_jonathonsturdevant" | mysql -uroot -pvagrant
  echo "grant all on wtfo_jonathonsturdevant.* to 'wtfo'@'localhost'" | mysql -uroot -pvagrant
  echo "flush privileges" | mysql -uroot -pvagrant
  mysql wtfo_jonathonsturdevant -uroot -pvagrant < /vagrant/mysql/initialize.sql > /vagrant/mysql/initialize.log
fi

# if phpmyadmin doesn't exist
if [ ! -f /etc/phpmyadmin/config.inc.php ];
then
  echo 'phpmyadmin phpmyadmin/dbconfig-install boolean false' | debconf-set-selections
  echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | debconf-set-selections

  echo 'phpmyadmin phpmyadmin/app-password-confirm password vagrant' | debconf-set-selections
  echo 'phpmyadmin phpmyadmin/mysql/admin-pass password vagrant' | debconf-set-selections
  echo 'phpmyadmin phpmyadmin/password-confirm password vagrant' | debconf-set-selections
  echo 'phpmyadmin phpmyadmin/setup-password password vagrant' | debconf-set-selections
  echo 'phpmyadmin phpmyadmin/database-type select mysql' | debconf-set-selections
  echo 'phpmyadmin phpmyadmin/mysql/app-pass password vagrant' | debconf-set-selections
  echo 'dbconfig-common dbconfig-common/mysql/app-pass password vagrant' | debconf-set-selections
  echo 'dbconfig-common dbconfig-common/mysql/app-pass password' | debconf-set-selections
  echo 'dbconfig-common dbconfig-common/password-confirm password vagrant' | debconf-set-selections
  echo 'dbconfig-common dbconfig-common/app-password-confirm password vagrant' | debconf-set-selections
  echo 'dbconfig-common dbconfig-common/app-password-confirm password vagrant' | debconf-set-selections
  echo 'dbconfig-common dbconfig-common/password-confirm password vagrant' | debconf-set-selections
  
  sudo apt-get -y install phpmyadmin
fi

rm -rf /var/www
ln -fs /vagrant-web /var/www

# now we need to give appropriate permissions for apache to run the site
a2enmod rewrite
sed -i '/AllowOverride None/c AllowOverride All' /etc/apache2/sites-available/default

apache2ctl restart
