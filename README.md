# Expense Tracker

Um sistema de controle de despesas pessoais desenvolvido em Laravel, permitindo aos usuários registrar despesas em diferentes moedas e visualizar conversões automáticas para Real Brasileiro (BRL).

## Funcionalidades

- **Autenticação de Usuários**: Registro e login com validação de CPF brasileiro
- **Registro de Despesas**: Adicione despesas em USD, EUR ou GBP com conversão automática para BRL
- **Dashboard**: Visualize totais, estatísticas e últimas despesas
- **Gerenciamento de Despesas**: Liste, visualize e exclua despesas
- **Interface Responsiva**: Design moderno com Tailwind CSS e Alpine.js

## Tecnologias Utilizadas

- **Backend**: Laravel 12 (PHP 8.2+)
- **Banco de Dados**: PostgreSQL
- **Frontend**: Tailwind CSS, Alpine.js, Vite
- **Testes**: Pest
- **Containerização**: Docker & Docker Compose
- **API de Câmbio**: ExchangeRate.host

## Pré-requisitos

- PHP 8.2 ou superior
- Composer
- Node.js e npm
- Docker e Docker Compose
- Chave da API ExchangeRate.host (gratuita)

## Instalação

1. **Clone o repositório**:
   ```bash
   git clone <url-do-repositorio>
   cd teste-dirmod-helder-saraive-de-oliveira
   ```

2. **Instale as dependências PHP**:
   ```bash
   composer install
   ```

3. **Instale as dependências JavaScript**:
   ```bash
   npm install
   ```

4. **Configure o ambiente**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure as variáveis de ambiente**:
   Edite o arquivo `.env` e configure:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=localhost
   DB_PORT=5432
   DB_DATABASE=dirmod
   DB_USERNAME=admin
   DB_PASSWORD=12345678

   EXCHANGE_API_KEY=sua-chave-api-aqui
   ```

6. **Inicie o banco de dados**:
   ```bash
   docker-compose up -d
   ```

7. **Execute as migrações**:
   ```bash
   php artisan migrate
   ```

8. **Construa os assets**:
   ```bash
   npm run build
   ```

9. **Inicie o servidor de desenvolvimento**:
   ```bash
   php artisan serve
   ```

   Ou use o comando de desenvolvimento completo:
   ```bash
   composer run dev
   ```

## Uso

1. Acesse `http://localhost:8000` no navegador
2. Registre uma nova conta com CPF válido e dados de endereço
3. Faça login no sistema
4. No dashboard, visualize estatísticas das despesas
5. Acesse "Expenses" para adicionar novas despesas
6. Preencha nome, valor e moeda da despesa
7. O sistema converterá automaticamente para BRL usando a API de câmbio

## Estrutura do Banco de Dados

### Usuários (`users`)
- `name`: Nome do usuário
- `email`: Email (único)
- `password`: Senha (hash)
- `cpf`: CPF brasileiro (validado)
- `cep`: CEP
- `street`: Rua
- `district`: Bairro
- `city`: Cidade
- `state`: Estado

### Despesas (`expenses`)
- `user_id`: ID do usuário (chave estrangeira)
- `name`: Nome da despesa
- `original_value`: Valor original
- `currency`: Moeda (USD/EUR/GBP)
- `exchange_rate`: Taxa de câmbio
- `brl_value`: Valor convertido em BRL
- `status`: Status da despesa (padrão: 'completed')

## API de Câmbio

O sistema utiliza a API gratuita do ExchangeRate.host para obter taxas de câmbio em tempo real. Certifique-se de configurar a chave da API no arquivo `.env`.

## Testes

Execute os testes com Pest:

```bash
php artisan test
```

## Desenvolvimento

Para desenvolvimento com hot reload:

```bash
npm run dev
```

Para executar o servidor Laravel com queue worker e logs:

```bash
composer run dev
```

## Docker

O projeto inclui configuração Docker para PostgreSQL. Para iniciar:

```bash
docker-compose up -d
```

Para parar:

```bash
docker-compose down
```

## Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request

## Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## Autor

Helder Saraiva de Oliveira