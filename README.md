## Instalação do projeto

Requisitos:
<br>PHP 7
<br>Composer
<br>Mysql
<br>Git

Clone o projeto do repositorio<br>
https://github.com/felipe1102/userMovimatation

Após clonado,
entre na pasta do projeto e duplique o arquivo .env.example renomeando para .env
<br>configure o banco de dados no arquivo .env com suas configurações.
<br>DB_CONNECTION=mysql
<br>DB_HOST=127.0.0.1
<br>DB_PORT=3306
<br>DB_DATABASE=system
<br>DB_USERNAME=root
<br>DB_PASSWORD=

Rode os comandos: 
<br>composer install
<br>php artisan key:generate
<br>php artisan migrate --seed

Comando para rodar teste de login
<br>php artisan test
