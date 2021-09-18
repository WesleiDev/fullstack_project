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

<p>Clone o repositório, acesse o diretório criado e execute os seguinte comandos  </p>

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

