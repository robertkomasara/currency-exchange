#!/bin/bash

set -euo pipefail;

# Envs
export DEBIAN_FRONTEND=noninteractive;
# Locales
locale-gen pl_PL pl_PL.UTF-8 en_US en_US.UTF-8 && dpkg-reconfigure locales;
# Packages
apt-get update && add-apt-repository ppa:ondrej/php;
apt-get -y install net-tools acl iptables-persistent software-properties-common;
apt-get -y install php7.4 php7.4-cli php7.4-xml php7.4-curl php7.4-mbstring php7.4-bcmath;
# Composer
wget https://getcomposer.org/download/latest-2.2.x/composer.phar;
mv composer.phar /usr/local/bin/composer;
chown -v vagrant:vagrant /usr/local/bin/composer;
chmod +x /usr/local/bin/composer;
composer --version;