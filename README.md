# AssetTI

Sistema web para gerenciamento de ativos de Tecnologia da Informação, desenvolvido como projeto semestral da disciplina de Desenvolvimento Web utilizando Laravel.

---

## Sobre o Projeto

O **AssetTI** é uma plataforma de gestão de ativos de TI que permite o controle de equipamentos, categorias, marcas, setores e manutenções, oferecendo uma área administrativa completa e uma área pública para consulta de informações.

O objetivo do sistema é centralizar o gerenciamento de ativos de tecnologia de uma organização, facilitando o acompanhamento do patrimônio e do histórico de manutenções.

---

## Tecnologias Utilizadas

* PHP 8
* Laravel 12
* Blade
* Tailwind CSS
* MySQL
* JavaScript
* Chart.js
* Eloquent ORM
* Git e GitHub

---

## Funcionalidades

### Autenticação

* Login de usuários;
* Cadastro de usuários;
* Logout;
* Proteção de rotas administrativas.

### Gestão de Equipamentos

* Cadastro de equipamentos;
* Edição de equipamentos;
* Exclusão de equipamentos;
* Pesquisa e filtros;
* Visualização detalhada.

### Gestão de Categorias

* Cadastro;
* Edição;
* Exclusão.

### Gestão de Setores

* Cadastro;
* Edição;
* Exclusão.

### Gestão de Marcas

* Cadastro;
* Edição;
* Exclusão.

### Gestão de Manutenções

* Cadastro de manutenções;
* Histórico por equipamento;
* Controle de status;
* Filtros de consulta.

### Dashboard Administrativo

* Indicadores do sistema;
* Equipamentos por status;
* Equipamentos por categoria;
* Manutenções por mês;
* Gráficos interativos.

### Área Pública

* Página inicial;
* Catálogo público de equipamentos;
* Pesquisa e filtros;
* Visualização dos detalhes dos equipamentos.

### Relatórios

* Relatórios filtrados;
* Exportação em PDF.

### API JSON

Endpoints para consulta de:

* Equipamentos;
* Categorias;
* Setores;
* Marcas;
* Manutenções.

---

## Modelagem do Banco de Dados

Entidades principais:

* Usuários
* Equipamentos
* Categorias
* Marcas
* Setores
* Manutenções

Relacionamentos:

* Um equipamento pertence a uma categoria;
* Um equipamento pertence a uma marca;
* Um equipamento pertence a um setor;
* Um equipamento possui várias manutenções.

---

## Instalação

Clone o repositório:

```bash
git clone https://github.com/joaokleiin/assetti.git
```

Entre na pasta:

```bash
cd assetti
```

Instale as dependências:

```bash
composer install
npm install
```

Copie o arquivo de ambiente:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Configure o banco de dados no arquivo `.env`.

Execute as migrations:

```bash
php artisan migrate
```

Ou recrie o banco com dados de demonstração:

```bash
php artisan migrate:fresh --seed
```

Inicie o servidor:

```bash
php artisan serve
```

---

## Usuário de Demonstração

Caso os seeders estejam habilitados:

```text
E-mail: admin@assetti.com
Senha: password
```

*(Altere conforme configurado no seu UserSeeder.)*

---

## Endpoints da API

### Equipamentos

```http
GET /api/equipments
GET /api/equipments/{id}
```

### Categorias

```http
GET /api/categories
```

### Marcas

```http
GET /api/brands
```

### Setores

```http
GET /api/sectors
```

### Manutenções

```http
GET /api/maintenances
```

---

## 📸 Funcionalidades Principais

* Área administrativa completa;
* Área pública para visitantes;
* Dashboard com gráficos;
* Relatórios em PDF;
* API REST em JSON;
* Sistema responsivo.

---

## Autor

**João Arthur Klein**

Graduando em Análise e Desenvolvimento de Sistemas – Universidade de Passo Fundo (UPF).

---

## Projeto Acadêmico

Projeto desenvolvido para fins acadêmicos na disciplina de Desenvolvimento Web, aplicando conceitos de:

* Laravel;
* Banco de Dados Relacional;
* Desenvolvimento Full Stack;
* Modelagem de Dados;
* APIs REST;
* Boas práticas de programação.
