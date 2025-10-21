FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
RUN sudo systemctl restart apache2
