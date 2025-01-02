FROM wordpress
COPY ./wp-content/uploads /var/www/html/wp-content/uploads
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN apt update -y && apt install git zip zsh wget -y
RUN docker-php-ext-install pdo pdo_mysql
RUN sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v1.1.5/zsh-in-docker.sh)"
WORKDIR /luir/wp-content