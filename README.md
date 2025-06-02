# Sistema de Login Profissional com PHP (MVC)

Este projeto é um sistema de login seguro, utilizando PHP puro no padrão MVC, com suporte a rotas amigáveis, sessões, autenticação com `password_hash` e estrutura organizada com autoload PSR-4 via Composer.

---

## ✅ Funcionalidades

- Login com senha segura usando `password_hash` e `password_verify`
- Controle de sessão e logout
- Proteção de rotas (ex: `/dashboard` acessível apenas logado)
- Organização em MVC (Model, View, Controller)
- Roteador simples que aceita URLs com parâmetros (`/controller/metodo/id`)
- Autoload com Composer
- Redirecionamento global para `/public` via `.htaccess`

---

## 🗂️ Estrutura de Pastas

```
Sistema-de-login-profissional-com-php/
├── app/
│   ├── Controllers/       # Controladores do sistema
│   ├── Models/            # Lógica de banco de dados
│   ├── Views/             # Arquivos de interface (HTML/PHP)
│   └── Core/              # Autenticação, helpers, etc
│
├── config/
│   └── database.php       # Conexão com MySQL via PDO
│
├── public/
│   └── index.php          # Ponto de entrada da aplicação
│
├── vendor/                # Autoload gerado pelo Composer
├── .htaccess              # Redireciona tudo para /public
├── composer.json
└── README.md
```

---

## ⚙️ Requisitos

- PHP 7.4 ou superior
- MySQL
- Apache (com mod_rewrite ativado)
- Composer

---

## 🚀 Instalação

1. **Clone o repositório**

```bash
git clone https://github.com/seu-usuario/Sistema-de-login-profissional-com-php.git
```

2. **Configure o banco de dados MySQL**

```sql
CREATE DATABASE login_mvc;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. **Configure o arquivo de conexão**

Edite o arquivo `config/database.php` e insira seus dados

4. **Instale o autoload do Composer**

```bash
composer dump-autoload
```

5. **Inicie o servidor PHP local**

```bash
php -S localhost:8000 -t public
```

6. **Acesse no navegador**

```
http://localhost:8000
```

---

## 👤 Criar usuário manualmente (opcional)

```php
<?php
$pdo = new PDO('mysql:host=localhost;dbname=login_mvc', 'root', '');
$hash = password_hash('123456', PASSWORD_DEFAULT);
$pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)")
    ->execute(['Admin', 'admin@example.com', $hash]);
```

- **Email:** `admin@example.com`  
- **Senha:** `123456`

---

## 📌 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

## ✍️ Autor

Desenvolvido por Francisco Junior  
GitHub: [https://github.com/franjuniorofcbr](https://github.com/franjuniorofcbr)