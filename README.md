# Group Management System

Bem-vindo ao **Group Management System**, um sistema de gerenciamento de grupos econômicos desenvolvido com Laravel + Livewire e TailwindCSS.

# ⚙️ Pré-requisitos

Antes de começar, certifique-se de ter os seguintes requisitos instalados:

-   [Git](https://git-scm.com/)
-   [Node.js (versão 16 ou superior)](https://nodejs.org/)
-   [PHP 8.2](https://www.php.net/releases/)
-   [Composer](https://getcomposer.org/)
-   [MySQL](https://www.mysql.com/)

## 🚀 Instalação e Configuração

Siga os passos abaixo para configurar e rodar o projeto corretamente em sua máquina.

### 1️⃣ Clone o repositório

```sh
git clone https://github.com/DaviTorelli/group-management-system.git
cd group-management-system
```

### 2️⃣ Configure o ambiente

Duplique o arquivo `.env.example` para `.env`:

```sh
cp .env.example .env
```

Atualize as configurações do banco de dados no arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1 (altere se for o seu caso)
DB_PORT=3306 (altere se for o seu caso)
DB_DATABASE=nome_da_base_de_dados
DB_USERNAME=seu_username
DB_PASSWORD=sua_senha
```

### 3️⃣ Instale as dependências do front-end

```sh
npm install
```

E em seguida, execute:

```sh
npm run dev
```

### 4️⃣ Instale as dependências do back-end

Abra outro terminal na mesma pasta e rode:

```sh
composer install
```

### 5️⃣ Configure o banco de dados

Com o `.env` configurado, execute:

```sh
php artisan migrate --seed
```

Caso não queira dados fictícios, no .env altere o APP_DEBUG para `false`:

```env
APP_DEBUG=false
```

### 6️⃣ Gere a chave da aplicação

```sh
php artisan key:generate
```

### 7️⃣ Inicie o servidor do Laravel

```sh
php artisan serve
```

Seu projeto deve estar rodando perfeitamente!

Acesse no navegador: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 🧪 Testes

-   Para acessar o sistema, use as seguintes credenciais:
    -   e-mail: "michael.jackson@email.com",
    -   senha: "password"
-   Ao cadastrar uma **unidade**, use esse [Gerador de CNPJ](https://www.geradorcnpj.com/):
-   Ao cadastrar um **colaborador**, use esse [Gerador de CPF](https://www.geradordecpf.org/):
