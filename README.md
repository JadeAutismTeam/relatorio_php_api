# API Relatório Jade

API para gerenciamento e sincronização de relatórios do sistema Jade.

<img width="1440" alt="image" src="https://github.com/user-attachments/assets/4b593d2b-f40c-4a4b-8968-6e67069feaf2" />


## Requisitos

- PHP 8.0 ou superior
- Composer
- MySQL 5.7 ou superior
- Apache/Nginx

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/JadeAutismTeam/relatorio_php_api
cd relatorio_php_api
```

2. Instale as dependências via Composer:
```bash
composer install
```

3. Configure o ambiente:
   - Copie o arquivo `.env.example` para `.env`
   - Ajuste as configurações do banco de dados e outras variáveis de ambiente conforme necessário

4. Configure o banco de dados:
   - Crie um banco de dados MySQL
   - Execute as migrações:
   ```bash
   php spark migrate
   ```

## Executando o Projeto

1. Inicie o servidor de desenvolvimento:
```bash
php spark serve
```

2. Acesse a aplicação:
   - Documentação Swagger: http://localhost:8080/swagger-ui
   - Página inicial: http://localhost:8080

## Endpoints Disponíveis

### Relatório Toque

1. Sincronizar Relatório Único
   - Método: POST
   - URL: `/v2/relatorio-toque/{appSystemKey}/sincronizar`
   - Autenticação: Bearer Token

2. Sincronizar Múltiplos Relatórios
   - Método: POST
   - URL: `/v2/relatorio-toque/{appSystemKey}/sincronizar/massa`
   - Autenticação: Bearer Token

## Documentação

A documentação completa da API está disponível através do Swagger UI em:
```
http://localhost:8080/swagger-ui
```

## Estrutura do Projeto

```
relatorio-jade-api/
├── app/
│   ├── Config/         # Configurações da aplicação
│   ├── Controllers/    # Controladores
│   ├── Models/         # Modelos
│   └── Views/          # Views
├── public/             # Arquivos públicos
│   └── swagger.json    # Documentação Swagger
├── system/             # Core do CodeIgniter
└── writable/          # Arquivos de log e cache
```
