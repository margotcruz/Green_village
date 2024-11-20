FROM php:8.3-apache

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    git \
    wget \
    unzip \
    mariadb-client \
    --no-install-recommends && \
    docker-php-ext-install pdo mysqli pdo_mysql zip && \
    rm -rf /var/lib/apt/lists/*

# Installer Composer
RUN wget https://getcomposer.org/installer -O composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer && \
    rm composer-setup.php

# Installer Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Configurer Git globalement
RUN git config --global user.name "margotcruz" && \
    git config --global user.email "cruzmargot2432@gmail.com"

# Copier la configuration Apache
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www
