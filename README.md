# NutriCalc

## Informações do Projeto

- **Universidade**: UNIVESIDADE FEDERAL DO TOCANTINS
- **Curso**: CIENCIAS DA COMPUTACAO
- **Disciplina**: ENGENHARIA DE SOFTWARE
- **Semestre**: 2025/01
- **Professor**: Edeilson Milhomem da Silva
- **Equipe**: Jonata Rubens, Afonso Dglan, Carlos Eduardo, Marcus Vinicius, Caio

## 🧾 Descrição

**NutriCalc** é uma aplicação web desenvolvida com PHP, HTML e CSS, com o objetivo de facilitar o controle e acompanhamento de informações nutricionais. O sistema é pensado para ser simples, intuitivo e útil tanto para usuários comuns quanto profissionais da área de nutrição.

## ✨ Funcionalidades Principais
- Consultar banco de dados de alimentos
- Realizar cálculos nutricionais baseados em refeições
- Calcular gasto energético basal
- Acesso sem login para funcionalidades básicas
- Login opcional para relatórios em PDF

📄 [Documentação Detalhada](https://docs.google.com/document/d/16bmeSKUb60Sma7MMCSvWFXq1465XLaLWFufkiDN6FjE/edit?usp=sharing)  
🎨 [Protótipos no Figma](https://www.figma.com/proto/lQPOqAeOSFHSjUynHLdZet/Untitled?node-id=4-185&p=f&t=uzYsCdXIex9B338e-1&scaling=scale-down&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=1%3A2)

---

## 🛠 Stack Tecnológica
| Área          | Tecnologias               |
|---------------|---------------------------|
| Front-end     | HTML5, CSS3, JavaScript   |
| Back-end      | PHP                       |
| Versionamento | Git, GitHub               |
| Infra         | Docker                    |

---

## 👥 Responsáveis por Área
| Área                          | Responsáveis                     |
|-------------------------------|----------------------------------|
| Banco de Dados                | Caio e Afonso                   |
| Desenvolvimento Back-End      | Caio, Afonso, Marcus Vinicius, Carlinhos e Jonata |
| Desenvolvimento Front-End     |Marcus Vinicius, Carlinhos e Jonata|
| Testes Unitários              | Todas as duplas em suas áreas    |

---

## 📋 Requisitos Funcionais

### RF-01: Cadastro de Usuário
**User Story**:  
"Como usuário, quero criar uma conta e acessar funcionalidades do sistema."

**📝 Regras de Negócio**:
- Campos obrigatórios: nome completo, e-mail e senha
- Senha deve conter no mínimo 8 caracteres

**Tarefas Técnicas**:
- ✅ Criar formulário de cadastro
- ✅ Implementar validação de campos
- ✅ Desenvolver lógica de armazenamento no BD

### RF-02: Autenticação de Usuário
**User Story**:  
"Como usuário, quero fazer login, mas que seja opcional. Quero que seja possivel a verificação de estar logado"

**Tarefas Técnicas**:
- ✅ Desenvolver formulário de login
- ✅ Implementar sistema de autenticação
- ✅ Lógica de login/Registro/Logout e visualização

### RF-03: Cálculos Nutricionais
**User Story**:  
"Como usuário, quero calcular informações nutricionais das minhas refeições para ter um acompanhamento mais saudável."

**Tarefas Técnicas**:
- ✅ Desenvolver interface de registro de refeições
- ✅ Implementar algoritmos de cálculo nutricional
- ✔️ (50% Completo) Criar visualização de resultados

### RF-04: Calculadora Avançada de Calorias
**User Story**:  
"Como usuário, quero uma calculadora precisa de calorias com visual moderno para acompanhar meu consumo diário de forma mais eficiente."

**📝 Regras de Negócio**:
- ✅ Cálculo baseado em: idade, peso, altura, gênero e nível de atividade
-  Exibição de macros (proteínas, carboidratos, gorduras)
- ✅ Todos os alimentos devem estar no Banco de Dados
-  Testes unitários 

### RF-05: Geração de PDF com Informações Pessoais e Cálculos
**User Story:**
"Como usuário, quero gerar um PDF com meus dados pessoais e os cálculos nutricionais para registrar e acompanhar minha saúde."

**📝 Regras de Negócio:**

-  A geração do PDF só estará disponível se o usuário estiver logado.
-  O perfil pode ser completo pelo usuario, mas é opcional (idade, peso, altura, sexo, atividade física).
-  Os cálculos devem ser baseados nas informações fornecidas pelo usuário.
-  O layout do PDF deve ser legível, responsivo e com dados organizados.
-  Deve incluir a data de geração e nome do usuário.

**Tarefas Técnicas:**
-  Adcionar mais infomacoes do usuario ao banco
-  Desenvolver função de geração de PDF
-  Integrar dados pessoais do banco no conteúdo do PDF
-  Incluir resultados de cálculos nutricionais no documento
-  Criar verificação de login e preenchimento do perfil antes da geração
-  Testar layout e compatibilidade com diferentes navegadores

### 📦RF-06: Geração de PDF com Lista de Alimentos
**User Story:**
"Como usuário, quero baixar um PDF com todos os alimentos cadastrados para consultar offline ou compartilhar."

**📝 Regras de Negócio:**

- Disponível apenas para usuários logados.
- Deve listar todos os alimentos com seus respectivos nutrientes (calorias, proteínas, lipídios, carboidratos).
- Deve ter cabeçalho, logo da aplicação e data de emissão.
- Layout organizado em formato de tabela.

**Tarefas Técnicas:**

-  ✔️ (50% Completo) Implementar script para extrair dados da tabela de alimentos
-  Gerar PDF em formato tabular com mPDF ou DomPDF
-  Bloquear acesso à geração caso o usuário não esteja autenticado
-  Incluir nome do usuário e data na exportação

---

## 🚀 Roadmap de Sprints

### 🧮Sprint 01 (08/04/2025 - 22/04/2025)
**Objetivo**:  
Oferecer experiência inicial de navegação e acesso ao sistema com cadastro e login.

**Entregas**:
- ✅ Tela inicial acessível sem login
- ✅ Componentes de navegação (Criar Conta/Fazer Login)
- ✅ Implementação do RF-01 (Cadastro)

### 🧮Sprint 02 (22/04/2025 - 30/04/2025)
**Objetivo**:  
Permitir montagem de refeições personalizadas e cálculos nutricionais.

**Entregas**:
- ✅ Sistema de busca de alimentos (RF-03)
- ✅ Cálculo e exibição de nutrientes totais
- ✅ Implementação do cálculos Nutricionais

### 🧮Sprint 03 (30/04/2025 - 20/05/2025)

**Objetivo**: 
Geração de PDFs, Calculadora Avançada de Calorias, Perfil com dados do user

**Entregas**:
- ❌ Adição de mais informações ao perfil de usuario
- ❌ Calculadora Avançada (RF-04)
- ❌ Implementação da adicao de dados do perfil do usuario para geracao de PDFs
- ❌ Geração de PDF com informações pessoais + resultados de cálculos (RF-05)
- ❌ Geração de PDF com lista de alimentos cadastrados (RF-06)
- ❌ Bloqueio da geração se não estiver logado ou perfil incompleto
- ❌ Implementação de testes
- ❌ Estilização dos posts blog

---

## Como Executar 

Para executar esta aplicação, siga estes passos:

1.  **Certifique-se de ter o Docker esteja instalado.**
2.  **Navegue até o diretório do projeto no seu terminal.**
3.  **Execute `docker-compose up --build -d` para construir e iniciar os containers.**
4.  **Abra seu navegador e acesse `http://localhost`.**
