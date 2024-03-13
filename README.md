## Sobre
A **PBSOFT** é uma empresa que atende a uma variedade de sistemas, incluindo sites destacados por distribuir informações entre estados. Diante dessa situação, surgiu uma demanda premente por desenvolver um novo sistema capaz de gerenciar os clientes de forma eficiente.

### Desafio
- Criar um CRUD (Create, Read, Update, Delete) dos clientes.
- Cada cliente deve ter **NOME, DATA DE NASCIMENTO, CPF OU CNPJ, FOTO e NOME SOCIAL**.

### Desenvolvido com as seguintes tecnologias:
- Conceitos de boas práticas e qualidade no código, usando Design Patterns, Clean Architecture, Domain Driven Design (DDD) e Princípios SOLID
- Abordagem SSR(Server-Side Rendering)
- Laravel
- Vue 3
- Vuex
- Bootstrap
- Banco de dados relacional MySQL
- Docker
- Testes automatizados
- Swagger para **Documentação**

### Documentação Swagger
![DOCUMENTACAOAPI](https://github.com/juniorsilvacc/desafio-backend-pbsoft/assets/43589505/8e9aee25-d2ac-49d3-9517-681a84cc5cc7)

### Front-End
![WEB](https://github.com/juniorsilvacc/desafio-backend-pbsoft/assets/43589505/c18e68b0-d9e4-48c1-9d6a-af02b4481919)

### Passo a passo para inicialização
Para clonar este repositório, use o seguinte comando:
```sh 
git clone https://github.com/juniorsilvacc/desafio-backend-pbsoft.git
```

Crie o arquivo .env
```sh 
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Desafio Backend PBSoft"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=desafio-backend-pbsoft
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Contruir novas imagens a parti do Dockfile
```sh 
docker compose build
```

Inicializar os contêineres da aplicação
```sh 
docker compose up -d
```

Acessar o contâiner da aplicação
```sh 
docker exec -it desafio-backend-pbsoft-app-1 bash
```

Instalar as dependências da aplicação
```sh 
composer install
```

Gerar a key da aplicação Laravel
```sh 
php artisan key:generate
```

Executar as migrations
```sh 
php artisan migrate
```

Inserir dados fictícios para popular o banco de dados
```sh 
php artisan db:seed
```

Executar testes para garantir a validação contínua da integridade e funcionalidade do software
```sh 
php artisan test
```

Instalar dependências listadas no arquivo package.json
```sh 
npm install
```

Inicializar a aplicação
```sh 
npm run dev
```

Acessar a aplicação
[http://localhost:8989](http://localhost:8989)
