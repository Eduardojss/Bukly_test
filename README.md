# Bukly_test

Este é um guia básico para executar um projeto Laravel usando Sail.

## Pré-requisitos

Certifique-se de ter os seguintes requisitos instalados em sua máquina:

- Docker
- Docker Compose
- php
- node
- mysql

## Configuração

1. Clone o repositório do projeto:

    ```
    git clone https://github.com/{SEU USUARIO}/Bukly_test.git
    ```

2. Navegue até o diretório do projeto:

    ```
    cd Bukly_test
    ```

3. Copie o arquivo `.env.example` para `.env`:

    ```
    cp .env.example .env
    ```

4. Edite o arquivo `.env` e configure as variáveis de ambiente necessárias para o seu projeto Laravel.

## OBS

<p> O Projeto foi criado pensando em usuários linux/ubuntu isso pode fazer com que algumas pastas possam ter caminhos diferentes dos definidos nas configurações.</p>

## Executando o projeto


1. Instale as dependências do Laravel:

    ```
    composer install
    ```
2. Instale as dependências do vue:
    
    ```
    npm install
    ```

3. Execute o Sail para mante-lo ativo:

    ```
    ./vendor/bin/sail up
    ```
4. Abra seu container:

    ```
    ./vendor/bin/sail shell

    ```

5. Gere a chave de criptografia do Laravel:

    ```
    php artisan key:generate
    ```

6. Execute as migrações do banco de dados:

    ```
    php artisan migrate
    ```

7. Popule o banco de dados com:

    ```
    php artisan db:seed
    ```

8. Saia do bash e rode:

    ```
    npm run dev
    ```

9. Acesse o projeto em seu navegador:

    ```
    http://localhost:80
    ```

## Encerrando o projeto

Para parar e remover os contêineres Docker, execute o seguinte comando:

```
./vendor/bin/sail down
```
