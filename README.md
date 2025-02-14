# BotMan Chatbot com Laravel 11

Este projeto implementa um chatbot utilizando **BotMan** integrado a uma aplicação **Laravel 11**. O chatbot permite coletar feedbacks de usuários de forma interativa e salvar as informações no banco de dados.

## 🚀 Tecnologias Utilizadas

- **Laravel 11** - Framework PHP para construção da API.
- **BotMan** - Biblioteca para criação de chatbots em PHP.
- **Bootstrap 5.3.3** - Framework CSS para estilização do frontend.
- **JavaScript** - Utilizado para integração do chatbot na interface web.
- **MySql** (ou outro banco de dados suportado pelo Laravel) - Armazenamento dos feedbacks coletados.

## 📥 Instalação e Configuração

### 1️⃣ Clonar o Repositório
```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2️⃣ Instalar as Dependências
```bash
composer install
npm install
```

### 3️⃣ Configurar o Ambiente
Crie o arquivo `.env` baseado no `.env.example` e configure a conexão com o banco de dados.
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Rodar as Migrações do Banco
```bash
php artisan migrate
```

### 5️⃣ Iniciar o Servidor
```bash
php artisan serve
```

O chatbot estará acessível em `http://127.0.0.1:8000`.

## 💬 Como Funciona o Chatbot

1. O usuário inicia o chat digitando **"feedback"**.
2. O chatbot faz perguntas sobre o nível de satisfação e experiência do usuário.
3. Opcionalmente, o usuário pode se identificar com **nome e CPF**.
4. As respostas são salvas no banco de dados.
5. O chatbot agradece a participação.

## 📜 Licença
Este projeto é de código aberto e pode ser utilizado livremente para estudos e modificações.

---



