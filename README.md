# Habit Tracker

> Aplicação web para rastreamento de hábitos diários.

---

## Sobre o projeto

O **Habit Tracker** é um site que permite criar, gerenciar e acompanhar hábitos do dia a dia. A ideia é simples: cadastre seus hábitos, marque os que foram cumpridos e acompanhe sua evolução ao longo do tempo.

Projeto desenvolvido com foco em aprendizado prático de Laravel.

---

## Tecnologias

- **[Laravel 13](https://laravel.com/)** — Framework PHP
- **[PHP 8.3](https://www.php.net/releases/8.5/pt_BR.php)** — Linguagem utilizada
- **[Blade](https://laravel.com/docs/blade)** — Engine de templates
- **[Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)** — Debugging em desenvolvimento
- **[MySQL](https://www.mysql.com/)** — Banco de dados

---

## Estrutura principal do projeto

```
habit-tracker/
├── app/
│   ├── Http/Controllers/   # Controllers da aplicação
│   └── Models/             # Models Eloquent
├── database/
│   ├── migrations/         # Estrutura do banco de dados
│   ├── factories/          # Factories para testes
│   └── seeders/            # Dados iniciais
├── resources/
│   └── views/              # Templates Blade
├── routes/
│   └── web.php             # Rotas da aplicação
└── tests/                  # Testes automatizados
```

---

## Pré-requisitos

Certifique-se de ter instalado na sua máquina:

- PHP >= 8.3
- Composer
- Node.js & npm
- MySQL (ou outro banco compatível com Laravel)

> Se você usa **[Laragon](https://laragon.org/)**, todos esses requisitos já estão disponíveis.

---

## Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/vini-campos/habit-tracker.git
cd habit-tracker
```

### 2. Instale as dependências PHP

```bash
composer install
```

### 3. Instale as dependências Node

```bash
npm install
```

### 4. Configure o ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` e configure os dados do seu banco:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=habit_tracker
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Execute as migrations

```bash
php artisan migrate
```

### 6. (Opcional) Popule o banco com dados de exemplo

```bash
php artisan migrate:fresh --seed
```
---

## Rodando o projeto

###  desenvolvimento

```bash
php artisan serve
npm run dev
```

Acesse em: **http://localhost:8000**

---

##  Scripts disponíveis para limpar cache

| Comando | Descrição |
|---|---|
| `php artisan optimize:clear` | Limpa todos os caches da aplicação|
| `php artisan route:clear` | Limpa o cache das rotas |
| `php artisan view:clear   ` | Limpa o cache das views |
| `php artisan cache:clear   ` | Limpa o cache da aplicação |

---
