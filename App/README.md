# Aplicação front end para consumir a API
<p>Esta aplicação tem o objetivo de consumir a API deste projeto. Para configurar o projeto front-end basta seguir as etapas abaixo</p>

## Instalar dependências
```bash
yarn install
```

### Inicie o App em modo desenvolvimento (hot-code, reloading, error reporting ...)
```bash
quasar dev
```

<p>A aplicação deve subir na porta 3000 da máquina local e abrir automáticamente em seu navegador padrão</p>
<p><b>Caso você tenha alterado a porta ou o host que a API está sendo executado, você precisa alterar a URL BASE no arquivo de configuração do axios. Acesse,
src\boot\axios.js e altere a linha 10 informando qual o endereço da API, por padrão, vai tentar consumir a API na rota http://localhost:8000</b></p>
