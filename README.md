## Sobre
A PBSOFT é uma empresa que atende a uma variedade de sistemas, incluindo sites destacados por distribuir informações entre estados. Diante dessa situação, surgiu uma demanda premente por desenvolver um novo sistema capaz de gerenciar os clientes de forma eficiente.

### Desafio
- Criar um CRUD (Create, Read, Update, Delete) dos clientes.
- Cada cliente deve ter **NOME, DATA DE NASCIMENTO, CPF OU CNPJ, FOTO e NOME SOCIAL**.

### Desenvolvido com as seguintes tecnologias:
- Conceitos de boas práticas e qualidade no código, usando Design Patterns, Clean Architecture, Domain Driven Design (DDD) e Princípios SOLID
- PHP
- Laravel
- Vue 3
- Banco de dados relacional MySQL
- Docker
- Testes Automatizados

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

Contrua novas imagens a parti do Dockfile
```sh 
docker compose build
```

Inicialize os contêineres da aplicação
```sh 
docker compose up -d
```

Acesse o conainter da aplicação
```sh 
docker exec -it desafio-backend-pbsoft-app-1 bash
```

Instale as dependências da aplicação
```sh 
composer install
```

Gere a key da aplicação Laravel
```sh 
php artisan key:generate
```

Execute as migrations
```sh 
php artisan migrate
```

Acessar o projeto
[http://localhost:8989](http://localhost:8989)
