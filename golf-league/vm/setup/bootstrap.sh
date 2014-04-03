#!/usr/bin/env bash

# initialize the database if the initialize script exists
if [ -f /vagrant/mysql/initialize.sql ];
then
  echo "create user 'bcbsscgl'@'localhost' identified by 'hnTCZXEN2Ab6tb'" | mysql -uroot -pvagrant
  echo "create database bcbsscgl" | mysql -uroot -pvagrant
  echo "grant all on bcbsscgl.* to 'bcbsscgl'@'localhost'" | mysql -uroot -pvagrant
  echo "flush privileges" | mysql -uroot -pvagrant
  mysql bcbsscgl -uroot -pvagrant < /vagrant/mysql/initialize.sql > /vagrant/mysql/initialize.log
fi
