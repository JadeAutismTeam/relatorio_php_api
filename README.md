# API Relatório Jade

API para gerenciamento e sincronização de relatórios do sistema Jade.

## Requisitos

- PHP 8.0 ou superior
- Composer
- MySQL 5.7 ou superior
- Apache/Nginx

## Instalação

1. Clone o repositório:
```bash
git clone [URL_DO_REPOSITÓRIO]
cd relatorio-jade-api
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

5. Configure o servidor web:
   - Para Apache, certifique-se de que o mod_rewrite está habilitado
   - Configure o DocumentRoot para apontar para a pasta `public`
   - Exemplo de configuração Apache:
   ```apache
   <VirtualHost *:80>
       ServerName localhost
       DocumentRoot /caminho/para/relatorio-jade-api/public
       
       <Directory /caminho/para/relatorio-jade-api/public>
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
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

## Desenvolvimento

1. Para executar os testes:
```bash
./vendor/bin/phpunit
```

2. Para gerar relatório de cobertura de código:
```bash
./vendor/bin/phpunit --colors --coverage-text=tests/coverage.txt --coverage-html=tests/coverage/
```

## Suporte

Para suporte, entre em contato através do email: support@example.com
