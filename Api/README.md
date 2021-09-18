## Sobre o Projeto

Este projeto foi desenvolvido utilizando a versão 8 do Laravel.
O projeto é uma API com todos os recusos do CRUD disponponíveis. A API foi desenvolvida pensando sempre no 
reaproveitamento do código, manter um código limpo, documento e organizado.
Os seguintes recursos foram utilizados.

- [x] Resources
- [x] FormRequest
- [x] Seeder
- [x] Factory
- [x] Mutators
- [x] Casts


## Instruções para utilização

<p>Clone o repositório, acesse o diretório e <b>crie um arquivo .env na pasta root do a aplicação com as segunites opções</b>  </p>
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:Y4WUlwdGhGZW7SLlIB1n9/gUP2XseePF4IbISSTh7RY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1 (HOST DA MÁQUINA ONDE ESTA O BANCO DE DADOS)
DB_PORT=3306(PORTA EM QUE SEU BANCO DE DADOS ESTA RODANDO)
DB_DATABASE=NOME DO BANCO DE DADOS (CRIE UM BANCO DE DADOS ZERADO)
DB_USERNAME=NOME DO SEU USUÁRIO NO BANCO DE DADOS
DB_PASSWORD=SENH DO USUÁRIO NO BANCO DE DADOS
```

```bash
composer install
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
``` 

```bash
php artisan serve
```

Assim que inicializado, o servidor irá subir na porta 8000, caso precise alterar a porta em que a aplicação é inicializada execute
```bash
php artisan serve --port=NUMERO_DA_PORTA_AQUI
```

