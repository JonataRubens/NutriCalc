# NUTRICALC - DOCUMENTAÇÃO DOS SPRINTS

## 📘 Informações do Projeto

- **Universidade**: UNIVERSIDADE FEDERAL DO TOCANTINS  
- **Curso**: CIÊNCIAS DA COMPUTAÇÃO  
- **Disciplina**: ENGENHARIA DE SOFTWARE  
- **Semestre**: 2025/01  
- **Professor**: Edeilson Milhomem da Silva  
- **Equipe**: Jonata Rubens, Afonso Dglan, Carlos Eduardo, Marcus Vinicius, Caio  
- **Link do projeto**: [NutriCalc no GitHub](https://github.com/JonataRubens/NutriCalc.git)

---

## 🧮 Sprint 01 (08/04/2025 – 22/04/2025)

### 🎯 Objetivo
Oferecer experiência inicial de navegação e acesso ao sistema com cadastro e login.

### 🔧 Funcionalidades

- Tela inicial acessível sem necessidade de login.
  - Exibição das principais funcionalidades do sistema.
- Navegação com opções "Criar Conta" e "Fazer Login".
  - Navbar com links principais.
- Cadastro de usuários com validação de senha.
  - Campos obrigatórios: nome, e-mail, senha (mín. 8 caracteres).

### ✅ Entregas

- ✅ Tela inicial acessível sem login  
- ✅ Componentes de navegação (Criar Conta/Fazer Login)  
- ✅ Implementação do RF-01 (Cadastro)  

---

## 🧮 Sprint 02 (22/04/2025 – 30/04/2025)

### 🎯 Objetivo
Permitir montagem de refeições personalizadas e cálculos nutricionais.

### 🔧 Funcionalidades

- Busca e seleção de alimentos cadastrados.
- Montagem de refeições ao longo do dia.
- Cálculo de nutrientes e gasto energético basal.
- Exportação de dados em PDF (base inicial).
- Testes unitários das funcionalidades.

### ✅ Entregas

- ✅ Sistema de busca de alimentos (RF-03)  
- ✅ Cálculo e exibição de nutrientes totais  
- ✅ Implementação dos cálculos nutricionais  

---

## 🧮 Sprint 03 (30/04/2025 – 20/05/2025)

### 🎯 Objetivo
Geração de PDFs, Calculadora Avançada de Calorias, Perfil com dados do usuário.

### 🔧 Funcionalidades

- Implementação da Calculadora Avançada de Calorias.
- Cadastro de informações adicionais do perfil do usuário.
- Geração de PDF com base no perfil e resultados calculados.
- Geração de PDF com lista de alimentos.
- Bloqueio da geração de PDF caso o usuário não esteja logado ou com perfil incompleto.
- Estilização do blog.
- Testes de funcionalidades críticas.

### 🚧 Entregas

- ❌ Adição de mais informações ao perfil de usuário  
- ❌ Calculadora Avançada (RF-04)  
- ❌ Geração de PDF com informações pessoais + resultados de cálculos (RF-05)  
- ❌ Geração de PDF com lista de alimentos cadastrados (RF-06)  
- ❌ Bloqueio da geração se não estiver logado ou perfil incompleto  
- ❌ Implementação de testes  
- ❌ Estilização dos posts blog  

---

---

## 🧾 Histórico de Atribuições e Participações da Equipe

Durante o desenvolvimento do projeto NutriCalc, as tarefas foram inicialmente divididas conforme especialidades e disponibilidade dos integrantes. A seguir, um resumo das atribuições e andamento do trabalho em equipe:

- ✅ **Caio**: Inicialmente designado para cuidar da estruturação e manipulação do **banco de dados** (criação da tabela `alimentos`, inserção e conexão com o sistema).
  
- ⚠️ **Afonso**: Ficou responsável pela **lógica de autenticação** (login, verificação de sessão). Contudo, a implementação não foi concluída dentro do prazo e foi assumida por **Jonata** para finalização e integração completa.

- ⚒️ **Jonata**: Atuou como coordenador técnico e principal integrador do sistema, assumindo partes críticas como:
  - Finalização da lógica de autenticação;
  - Integração com o banco de dados;
  - Gerenciamento da estrutura geral do código.

- 🎨 **Carlos** e **Marcus**: Trabalharam inicialmente no **frontend**, cuidando da interface do usuário e do layout das telas. Nesta etapa, a atuação foi mais isolada do backend.

---

### 🔄 Mudanças na Sprint 03

Com o avanço do projeto e o início da Sprint 03, todos os membros da equipe passam a contribuir de forma mais **integrada** e **ativa** tanto no **frontend quanto no backend**, além da realização de **testes**.

Apesar do escopo do projeto não ser complexo por natureza, essa simplicidade foi uma **decisão de projeto**, mantendo um foco bem definido nas funcionalidades essenciais e na qualidade da entrega. Isso refletiu em sprints com menor densidade funcional, mas com alto valor para a aplicação proposta.


