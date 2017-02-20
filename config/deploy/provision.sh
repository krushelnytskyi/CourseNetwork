#!/bin/bash

#Update centos
sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm
sudo rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm
sudo yum -y update

#Copy /etc files
sudo cp -Rf /vagrant/coursenetwork/config/deploy/etc/* /etc/

#Install httpd
sudo yum install -y httpd
sudo service httpd start
sudo chkconfig httpd on

#Install mariaDB
sudo yum install -y MariaDB-server MariaDB-client
sudo service mysql start
sudo chkconfig mysql on

#Install PHP
sudo yum install -y php70w php70w-opcache
sudo yum install -y php70w-pear php70w-devel php70w-pdo php70w-pecl-redis php70w-bcmath \
                    php70w-dom php70w-eaccelerator php70w-gd php70w-imap php70w-intl php70w-mbstring \
                    php70w-mcrypt php70w-mysqlnd php70w-posix php70w-soap php70w-tidy php70w-xmlrpc \
                    php70w-pecl-xdebug php70w-zip

#Restart services
sudo service httpd restart
sudo service mysql restart

#Install application
php /vagrant/coursenetwork/installation.php