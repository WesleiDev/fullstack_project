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
<p><b>Caso você tenha alterado a porta ou o host que a API está sendo executada, você precisa alterar a URL BASE no arquivo de configuração do axios. Acesse,
src\boot\axios.js e altere a linha 10 informando qual o endereço da API, por padrão, vai tentar consumir a API na rota http://localhost:8000</b></p>

<img src="https://user-images.githubusercontent.com/20250407/133933977-d7987b16-90ad-4493-be64-dcdc1d07ccc9.png" />
