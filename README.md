<div align="center">

# 🏋️ Gestão de Treinos

### Seu personal trainer particular, agora movido por IA.

Uma plataforma full-stack para quem quer começar a treinar, mas não sabe por onde começar.
Catálogo completo de exercícios, treinos organizados por modalidade e nível, e uma **IA que monta e orienta seu treino** como um personal trainer de verdade.

![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Next.js](https://img.shields.io/badge/Next.js-16-000000?style=for-the-badge&logo=next.js&logoColor=white)
![React](https://img.shields.io/badge/React-19-61DAFB?style=for-the-badge&logo=react&logoColor=black)
![TypeScript](https://img.shields.io/badge/TypeScript-5.7-3178C6?style=for-the-badge&logo=typescript&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind-4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15-336791?style=for-the-badge&logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow?style=for-the-badge)

</div>

---

## 💡 Sobre o Projeto

**Gestão de Treinos** nasceu para resolver um problema real: muita gente quer treinar, mas não tem condição de pagar um personal e fica perdida sem saber **o que fazer, como fazer e quando fazer**.

A proposta é simples: oferecer uma plataforma onde o usuário consegue:

- 📚 **Acessar uma biblioteca de exercícios** organizados por modalidade (musculação, calistenia, etc.) e nível (iniciante, intermediário, avançado).
- 🤖 **Conversar com uma IA especialista** em treino, que age como um personal trainer particular — tira dúvidas, sugere progressões, monta treinos personalizados e ainda dá dicas de execução e nutrição.
- 👤 **Gerenciar seu próprio perfil**, treinos e progressão de forma simples.

A ideia é democratizar o acesso à orientação de treino, principalmente para quem está começando do zero.

---

## ✨ Funcionalidades

### 🧑‍🎓 Para o Usuário
- ✅ Cadastro e login com autenticação via **Laravel Sanctum**
- ✅ Catálogo de exercícios filtrável por **modalidade** e **nível**
- ✅ Pesquisa de exercícios e visualização detalhada de cada um
- ✅ **Chat com IA personal trainer** com streaming em tempo real (SSE)
- ✅ Histórico de conversas com a IA persistido no banco
- ✅ Edição de perfil e gerenciamento da própria conta

### 🛠️ Para o Administrador
- ✅ CRUD de **exercícios**
- ✅ CRUD de **modalidades**
- ✅ CRUD de **níveis** de dificuldade

### 🤖 IA — `GymTrainer`
A IA é construída sobre o pacote [`laravel/ai`](https://github.com/laravel/ai), atuando como um agente especializado:

> *"Você é um personal trainer especializado em calistenia e musculação. Ajude o usuário com treinos, exercícios, nutrição e dicas de fitness."*

- Modelo: `nvidia/nemotron-3-super-120b-a12b` (via OpenRouter)
- **Memória de conversa** — lembra do contexto entre mensagens
- **Tool calling** — capaz de criar treinos personalizados (`CreateWorkout`) consultando o próprio catálogo do sistema
- Resposta em **streaming** para uma experiência fluida no chat

---

## 🏗️ Arquitetura

```diagram
╭─────────────────────────╮         ╭──────────────────────────╮
│  Frontend (Next.js 16)  │         │   Backend (Laravel 13)   │
│  React 19 + TypeScript  │ ──────▶ │   API REST + Sanctum     │
│  Tailwind 4 + Radix UI  │  HTTP   │   Repository / Service   │
╰─────────────────────────╯         ╰────────────┬─────────────╯
                                                 │
                          ╭──────────────────────┼──────────────────────╮
                          ▼                      ▼                      ▼
                  ╭───────────────╮     ╭────────────────╮     ╭────────────────╮
                  │  PostgreSQL   │     │  Agente IA     │     │  OpenRouter    │
                  │  (Docker)     │     │  GymTrainer    │ ──▶ │  (LLM)         │
                  ╰───────────────╯     ╰────────────────╯     ╰────────────────╯
```

O backend segue uma separação em camadas:

```
app/
├── Ai/
│   ├── Agents/      → Agente GymTrainer (personal trainer IA)
│   └── Tools/       → Ferramentas que a IA pode chamar (ex.: CreateWorkout)
├── Http/
│   ├── Controllers/ → Endpoints da API
│   ├── DTO/         → Data Transfer Objects
│   ├── Repository/  → Acesso a dados
│   ├── Requests/    → Validação (Form Requests)
│   └── Service/     → Regras de negócio
└── Models/          → Eloquent (Exercicio, Modalidade, Nivel, Treino, Usuario...)
```

---

## 🚀 Stack Tecnológica

### Backend — `Backend_Gestao_Treinos/`
| Tecnologia | Versão | Uso |
|---|---|---|
| **PHP** | 8.4 | Linguagem |
| **Laravel** | 13 | Framework |
| **Laravel Sanctum** | 4 | Autenticação por token |
| **Laravel AI** | 0.6 | Agentes de IA |
| **PostgreSQL** | 15 | Banco de dados (Docker) |
| **SQLite** | — | Banco de dados (dev local) |
| **Redis** | alpine | Cache (opcional) |
| **Docker** | — | Ambiente containerizado |

### Frontend — `Frontend_Gestao_Treinos/`
| Tecnologia | Versão | Uso |
|---|---|---|
| **Next.js** | 16 | Framework React |
| **React** | 19 | UI |
| **TypeScript** | 5.7 | Tipagem |
| **Tailwind CSS** | 4 | Estilização |
| **Radix UI** | — | Componentes acessíveis |
| **shadcn/ui** | — | Design system |
| **React Hook Form + Zod** | — | Formulários e validação |
| **Lucide React** | — | Ícones |
| **Recharts** | — | Gráficos |

---

## 📁 Estrutura do Repositório

```
proj_gest_treino/
├── Backend_Gestao_Treinos/    → API Laravel
│   ├── app/                   → Lógica da aplicação
│   ├── database/              → Migrations, factories, seeders
│   ├── routes/api.php         → Rotas da API
│   ├── docker-compose.yaml    → Ambiente Docker
│   └── Dockerfile
│
├── Frontend_Gestao_Treinos/   → App Next.js
│   ├── app/                   → Páginas (cadastro, login, treinos, chat, perfil...)
│   ├── components/            → Componentes React reutilizáveis
│   ├── hooks/                 → Custom hooks
│   └── lib/                   → Utilitários e cliente HTTP
│
├── LICENSE
└── README.md
```

---

## ⚙️ Como Rodar Localmente

### 📋 Pré-requisitos
- PHP 8.4+
- Composer
- Node.js 20+
- Docker e Docker Compose (recomendado)
- Uma chave de API do [OpenRouter](https://openrouter.ai) para a IA

### 🐳 Backend com Docker (recomendado)

```bash
cd Backend_Gestao_Treinos

# 1. Configure o ambiente
cp .env.example .env

# 2. Adicione sua chave da OpenRouter no .env
#    OPENROUTER_API_KEY=sua_chave_aqui

# 3. Suba os containers
docker compose up -d

# 4. Instale dependências e gere a chave
docker compose exec gest_treinos_app composer install
docker compose exec gest_treinos_app php artisan key:generate

# 5. Rode as migrations
docker compose exec gest_treinos_app php artisan migrate
```

A API estará disponível em **http://localhost:8001**
Adminer (gerenciador do banco) em **http://localhost:8002**

### 🧰 Backend sem Docker

```bash
cd Backend_Gestao_Treinos

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate

# Rodar tudo (server + queue + logs + vite)
composer run dev
```

### 💻 Frontend

```bash
cd Frontend_Gestao_Treinos

cp .env.example .env.local
# Configure a URL da API:
#   NEXT_PUBLIC_API_URL=http://localhost:8001/api

npm install
npm run dev
```

Acesse **http://localhost:3000**

---

## 🔌 Principais Endpoints da API

### 🔓 Públicos
| Método | Rota | Descrição |
|---|---|---|
| `POST` | `/api/login` | Login do usuário |
| `POST` | `/api/cadastro` | Cadastro de novo usuário |

### 🔒 Autenticados (Sanctum)
| Método | Rota | Descrição |
|---|---|---|
| `GET`  | `/api/home` | Dados da home |
| `POST` | `/api/logout` | Logout |
| `GET`  | `/api/usuario/{id}` | Detalhes do usuário |
| `PUT`  | `/api/usuario/update/{id}` | Atualizar usuário |
| `DELETE` | `/api/usuario/delete/{id}` | Deletar a própria conta |
| `POST` | `/api/chat` | **Conversa com o personal IA (streaming SSE)** |
| `GET`  | `/api/exercicio` | Listar exercícios |
| `POST` | `/api/exercicio/modalidade` | Filtrar por modalidade |
| `GET`  | `/api/exercicio/pesquisa` | Pesquisar exercícios |
| `GET`  | `/api/exercicio/detalhe/{id}` | Detalhes de um exercício |

### 👑 Admin (`/api/admin/*`)
- CRUD de **exercícios**, **modalidades** e **níveis**.

---

## 🧠 Como a IA Funciona

1. O usuário envia uma pergunta para `POST /api/chat`.
2. O `ChatController` aciona o `ChatService`, que invoca o agente `GymTrainer`.
3. O agente usa o histórico de `agent_conversations` para manter contexto.
4. Caso o usuário peça um treino, a IA pode chamar a tool `CreateWorkout`, que consulta exercícios reais do banco e monta um treino personalizado.
5. A resposta é devolvida via **Server-Sent Events (SSE)**, aparecendo em tempo real no frontend.

<!-- ---

## 🗺️ Roadmap

- [ ] Acompanhamento de progresso (cargas, repetições, histórico)
- [ ] Sistema de favoritos para exercícios e treinos
- [ ] Notificações de treinos da semana
- [ ] Integração com vídeos demonstrativos dos exercícios
- [ ] App mobile (React Native)
- [ ] Modo offline para visualizar treinos salvos

--- -->

## 👨‍💻 Autor

**Rian Andrade**

🔗 [github.com/riancandrade](https://github.com/riancandrade)

---

## 📝 Licença

Distribuído sob a licença MIT. Veja [`LICENSE`](./LICENSE) para mais detalhes.

---

<div align="center">

⭐ Se este projeto te ajudou de alguma forma, considere deixar uma estrela!

*Feito com 💪 para democratizar o acesso ao treino de qualidade.*

</div>
