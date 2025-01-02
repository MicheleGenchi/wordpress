@echo off
set ROOTPATH=D:\Documenti\Wordpress

echo Enter your nome sito : 
set /p NOMESITO=

echo Inserire una PORTA  per il sito "(8000->...)" : 
set /p PORTA=

echo Inserire una PORTA  per phpadmin "(8080->...)" : 
set /p PORTAPHP=

if "%PORTA%"=="" set PORTA=8000

if "%PORTAPHP%"=="" set PORTAPHP=8080

if exist %NOMESITO% goto progetto_esiste

rem kill all container
FOR /f "tokens=*" %%i IN ('docker ps -q') DO docker stop %%i

rem scrivi Dockerfile
md %NOMESITO%
cd %NOMESITO%
echo %NOMESITO% %PORTA%

cd %ROOTPATH%
copy upload.ini %NOMESITO%
rem copy Dockerfile %NOMESITO%

cd %ROOTPATH%/%NOMESITO%
rem scrivi Dockerfile
echo %NOMEPROGETTO% %PORTA%
(
echo FROM wordpress
echo COPY ./%NOMESITO%/wp-content/uploads /var/www/html/wp-content/uploads
echo RUN pecl install xdebug
echo RUN docker-php-ext-enable xdebug
echo RUN apt update -y && apt install git zip zsh wget -y
echo RUN docker-php-ext-install pdo pdo_mysql
echo RUN sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v1.1.5/zsh-in-docker.sh)"
echo WORKDIR /%NOMESITO%/wp-content
)>Dockerfile

rem DOCKER-COMPOSE init
(
echo services:
echo.
)>docker-compose.yml

rem DOCKER-COMPOSE db
(
echo   db_%NOMESITO%:
echo     container_name: db_%NOMESITO%
echo     image: mysql:8.0.32
echo     environment:
echo       MYSQL_ROOT_PASSWORD: root
echo       MYSQL_DATABASE: db_%NOMESITO%
echo       MYSQL_USER: wordpress
echo       MYSQL_PASSWORD: wordpress
echo     volumes:
echo       - data_%NOMESITO%:/var/lib/mysql
echo     networks:
echo       - net_%NOMESITO%
)>>docker-compose.yml

rem DOCKER-COMPOSE phpadmin
(
echo.
echo   phpmyadmin_%NOMESITO%:
echo     container_name: phpmyadmin_%NOMESITO%
echo     depends_on:
echo       - db_%NOMESITO%
echo     image: phpmyadmin/phpmyadmin
echo     ports:
echo       - %PORTAPHP%:80
echo     environment:
echo        PMA_HOST: db_%NOMESITO%
echo        MYSQL_ROOT_PASSWORD: root
echo     networks:
echo       - net_%NOMESITO%
)>>docker-compose.yml

rem DOCKER-COMPOSE wordpress
(
echo.
echo # wordpress %NOMESITO%
echo   wordpress_%NOMESITO%:
echo     container_name: wordpress_%NOMESITO%
echo     build:
echo       context: .
echo       dockerfile: ./Dockerfile
echo     depends_on:
echo       - db_%NOMESITO%
echo     volumes:
echo       - type: bind
echo         source: ./wp-content/uploads
echo         target: /var/www/html/wp-content/uploads
echo       - ./wp-content:/var/www/html/wp-content
echo       - ./upload.ini:/usr/local/etc/php/conf.d/upload.ini
echo     environment:
echo       WORDPRESS_DB_HOST: db_%NOMESITO%
echo       WORDPRESS_DB_USER: wordpress
echo       WORDPRESS_DB_PASSWORD: wordpress
echo       WORDPRESS_DB_NAME: db_%NOMESITO%
echo     ports:
echo       - %PORTA%:80
echo     networks:
echo       - net_%NOMESITO%
)>>docker-compose.yml

rem DOCKER-COMPOSE networks and volumes
(
echo.
echo networks:
echo   net_%NOMESITO%:
echo.
echo volumes:
echo   data_%NOMESITO%: {}
)>>docker-compose.yml


docker compose build --no-cache
docker compose up -d

echo Sito pronto
GOTO fine

:progetto_esiste 
    echo %NOMESITO% gia' presente

:fine
    cd %ROOTPATH%
    echo buon lavoro!