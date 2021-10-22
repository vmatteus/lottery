# Setup Lottery - Api

### Pré-requisitos:
Para trabalhar nesse projeto você ira precisar instalar:
     
*[ Docker ](https://www.docker.com/get-started)			

*[ Docker Compose ](https://docs.docker.com/compose/install/)

### Preparando o ambiente Docker:

    Subindo ambiente
        sudo docker-compose build
        sudo docker-compose up -d

    Entrando no ambiente docker:
        sudo docker exec -it lottery-api bash // ou nome do repositorio escolhido

    Renomeie o arquivo .env.example para .env
        chmod 777 .env.example
        cp .env.example .env

    Gerar key do laravel
        php artisan key:gen