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

### 🧮Sprint 01 (08/04/2025 - 29/04/2025)
**Objetivo**:  
Oferecer experiência inicial de navegação e acesso ao sistema com cadastro e login. Permitir montagem de refeições personalizadas e cálculos nutricionais.

**Entregas**:
- ✅ Tela inicial acessível sem login
- ✅ Componentes de navegação (Criar Conta/Fazer Login)
- ✅ Implementação do RF-01 (Cadastro)
- ✅ Sistema de busca de alimentos (RF-03)
- ✅ Cálculo e exibição de nutrientes totais
- ✅ Implementação do cálculos Nutricionais

---

### 🧮Sprint 02 (30/04/2025 - 13/05/2025)

**Objetivo**: 
Geração de PDFs, Calculadora Avançada de Calorias, Perfil com dados do user, Pagina de admin para controle de usuarios e alimentos no bd, Criar um sistemas de Lembretes/notas

**Entregas**:
- ❌ Adição de mais informações ao perfil de usuario (afonso)
  - Se trona necessario por conta da geracao de PDF que vai gerar um pdf com um balanço dos seus dados
- ❌ Calculadora Avançada (RF-04) (carlos)
  - Calculadora que monta refeicoes diarias (café/almoco/jantar), os alimentos sao puxados no Banco de Dados
- ❌ Geração de PDF com informações pessoais + resultados de cálculos, lista de alimentos cadastrados  (RF-05) (marcos)
  - Afim de oferecer mais utilidades para aqueles que desejam realizar o cadastro no site
- ❌ Implementação da pagina de admin (RF-07) (caio) 
  - Para melhor controle dos alimentos que estao no Banco de dados
- ✅ Criacao de Notas/Lembretes (Jonata)
  - Afim de deixar o usuario anotar qualquer coisa que ele desejar e deixar salvo com base no seu login 

---

## 🧾 Histórico de Atribuições e Participações da Equipe 

##  🧾 Atribuições Sprint 01 (08/04/2025 - 29/04/2025)

Durante o desenvolvimento do projeto NutriCalc, as tarefas foram inicialmente divididas conforme disponibilidade dos integrantes. A seguir, um resumo das atribuições e andamento do trabalho em equipe:

- ✅ **Caio**: Inicialmente designado para cuidar da estruturação e manipulação do **banco de dados** (criação da tabela `alimentos`, inserção e conexão com o sistema).
  
- ⚠️ **Afonso**: Ficou responsável pela **lógica de autenticação** (login, verificação de sessão). Contudo, a implementação não foi concluída dentro do prazo e foi assumida por **Jonata** para finalização e integração completa.

- ⚒️ **Jonata**: Atuou como coordenador técnico e principal integrador do sistema, assumindo partes críticas como:
  - Finalização da lógica de autenticação;
  - Integração com o banco de dados;
  - Gerenciamento da estrutura geral do código.

- 🎨 **Carlos** e **Marcus**: Trabalharam inicialmente no **frontend**, cuidando da interface do usuário e do layout das telas. Nesta etapa, a atuação foi mais isolada do FrontEnd.

---

### 🔄 Mudanças na Sprint 02

Com o avanço do projeto e o início da Sprint 02, todos os membros da equipe passam a contribuir de forma mais **integrada** e **ativa** tanto no **frontend quanto no backend**.

---

## 🧾 Atribuições – Sprint 02 (30/04/2025 - 13/05/2025)

Com a evolução do projeto NutriCalc e o aumento da complexidade das funcionalidades, as atribuições foram redistribuídas para melhor aproveitamento das habilidades da equipe e cumprimento das entregas propostas:

- **Caio**: Responsável pela **implementação da página de administração** do sistema (RF-07), com foco no controle dos alimentos e usuários cadastrados no banco de dados.  
  - Atribuições específicas:
    - Criar interface de gerenciamento (CRUD) para alimentos e usuários;
    - Restringir acesso apenas a usuários com perfil de administrador;
    - Garantir integração segura com o banco.

- **Afonso**: Responsável por **adicionar novos campos ao perfil do usuário**, que serão utilizados na geração de relatórios em PDF.  
  - Atribuições específicas:
    - Estender a tabela de usuários no banco;
    - Modificar a página de perfil para incluir novos dados;
    - Garantir que as informações estejam acessíveis para exportação no relatório.
    - Estilizacao do retorno da pesquisa na pagina home

- **Carlos**: Responsável pelo desenvolvimento da **calculadora avançada de calorias** (RF-04), permitindo que o usuário monte refeições diárias com base nos alimentos do banco.  
  - Atribuições específicas:
    - Criar interface para seleção de alimentos por refeição (café, almoço, jantar);
    - Implementar lógica de cálculo nutricional total;
    - Integrar dados com os alimentos cadastrados via BD.

- **Marcus**: Responsável pela **geração automática de relatórios em PDF** com dados pessoais do usuário, resumo de cálculos e alimentos utilizados (RF-05).  
  - Atribuições específicas:
    - Criar layout e estrutura do documento;
    - Utilizar biblioteca de geração de PDF 
    - Integrar os dados do perfil e da calculadora no documento final.

-  **Jonata**: Responsável pela **implementação do sistema de lembretes/notas** (RF-08) e apoio técnico geral à equipe.  
  - Atribuições específicas:
    - Criar CRUD de notas vinculadas ao usuário logado;
    - Garantir autenticação e privacidade dos dados;

**Entregas**:
- ✅ implementação da página de administração ⚠️ Implementado por Jonata
- ✅ adicionar novos campos ao perfil do usuário 
- ❌ calculadora avançada de calorias
- ✅ geração automática de relatórios em PDF
- ✅ implementação do sistema de lembretes/notas ⚠️ Implementado por Jonata


 # 🧾 Atribuições – Sprint 03 (13/05/2025 - 27/05/2025)
 (em construção)