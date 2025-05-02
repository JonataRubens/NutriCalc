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
- Painel de administração para gerenciamento de alimentos (exclusivo para usuários admin)

🎨 [Protótipos no Figma](https://www.figma.com/proto/lQPOqAeOSFHSjUynHLdZet/Untitled?node-id=4-185&p=f&t=uzYsCdXIex9B338e-1&scaling=scale-down&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=1%3A2)

---

## 🛠 Stack Tecnológica
| Área          | Tecnologias               |
|---------------|---------------------------|
| Front-end     | HTML5, CSS3, JavaScript   |
| Back-end      | PHP                       |
| Versionamento | Git, GitHub               |
| Infra         | XAMPP                     |

---

## 👥 Responsáveis por Área
| Área                          | Responsáveis                     |
|-------------------------------|----------------------------------|
| Banco de Dados                | Caio e Afonso                   |
| Desenvolvimento Back-End      | Caio, Afonso, Marcus Vinicius, Carlinhos e Jonata |
| Desenvolvimento Front-End     | Marcus Vinicius, Carlinhos e Jonata |
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
"Como usuário, quero fazer login, mas que seja opcional. Quero que seja possível a verificação de estar logado"

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
- Exibição de macros (proteínas, carboidratos, gorduras)
- ✅ Todos os alimentos devem estar no Banco de Dados
- Testes unitários 

### RF-05: Geração de PDF com Informações Pessoais e Cálculos
**User Story:**
"Como usuário, quero gerar um PDF com meus dados pessoais e os cálculos nutricionais para registrar e acompanhar minha saúde."

**📝 Regras de Negócio**:
- A geração do PDF só estará disponível se o usuário estiver logado.
- O perfil pode ser completo pelo usuário, mas é opcional (idade, peso, altura, sexo, atividade física).
- Os cálculos devem ser baseados nas informações fornecidas pelo usuário.
- O layout do PDF deve ser legível, responsivo e com dados organizados.
- Deve incluir a data de geração e nome do usuário.

**Tarefas Técnicas**:
- Adicionar mais informações do usuário ao banco
- Desenvolver função de geração de PDF
- Integrar dados pessoais do banco no conteúdo do PDF
- Incluir resultados de cálculos nutricionais no documento
- Criar verificação de login e preenchimento do perfil antes da geração
- Testar layout e compatibilidade com diferentes navegadores

### 📦 RF-06: Geração de PDF com Lista de Alimentos
**User Story:**
"Como usuário, quero baixar um PDF com todos os alimentos cadastrados para consultar offline ou compartilhar."

**📝 Regras de Negócio**:
- Disponível apenas para usuários logados.
- Deve listar todos os alimentos com seus respectivos nutrientes (calorias, proteínas, lipídios, carboidratos).
- Deve ter cabeçalho, logo da aplicação e data de emissão.
- Layout organizado em formato de tabela.

**Tarefas Técnicas**:
- ✔️ (50% Completo) Implementar script para extrair dados da tabela de alimentos
- Gerar PDF em formato tabular com mPDF ou DomPDF
- Bloquear acesso à geração caso o usuário não esteja autenticado
- Incluir nome do usuário e data na exportação

### 📦 RF-07: Criação da Página de Admin, Adição de Informações ao User
**User Story:**
"Eu como super usuário quero ter uma tela de login para poder administrar usuários e alimentos onde poderá ser realizado CRUD"

**📝 Regras de Negócio**:
- Só vai ter 1 superUser onde será registrado diretamente ao BD
- Será possível fazer operações CRUD dentro da página admin
- Terá uma URL à parte do projeto
- A adição de dados é opcional

**Tarefas Técnicas**:
- ✅ Criar página de admin em 'NutriCalc/pages/admin/admin.php'
- ✅ Implementar CRUD para gerenciamento de alimentos dentro da página admin
- ✅ Adicionar campo 'role' ao banco de dados para diferenciar usuários admin de usuários comuns
- ✅ Implementar lógica de sessão para restringir acesso à página admin apenas a usuários com role 'admin'
- ✅ Modularizar código da página admin em arquivos separados como 'CriarAlimentoModal.php'
- ✅ Adicionar link ao painel de admin no dropdown do navbar para usuários admin

---

## 🚀 Roadmap de Sprints

### 🧮 Sprint 01 (08/04/2025 - 29/04/2025)
**Objetivo**:  
Oferecer experiência inicial de navegação e acesso ao sistema com cadastro e login. Permitir montagem de refeições personalizadas e cálculos nutricionais.

**Entregas**:
- ✅ Tela inicial acessível sem login
- ✅ Componentes de navegação (Criar Conta/Fazer Login)
- ✅ Implementação do RF-01 (Cadastro)
- ✅ Sistema de busca de alimentos (RF-03)
- ✅ Cálculo e exibição de nutrientes totais
- ✅ Implementação dos cálculos Nutricionais

### 🧮 Sprint 02 (30/04/2025 - 13/05/2025)
**Objetivo**: 
Geração de PDFs, Calculadora Avançada de Calorias, Perfil com dados do user, Página de admin para controle de usuários e alimentos no BD

**Entregas**:
- ❌ Adição de mais informações ao perfil de usuário (afonso)
- ❌ Calculadora Avançada (RF-04) (carlos)
- ❌ Geração de PDF com informações pessoais + resultados de cálculos, lista de alimentos cadastrados (RF-05) (marcos)
- ❌ Bloqueio da geração se não estiver logado ou perfil incompleto (marcos)
- ✅ Implementação da página de admin (RF-07) (caio)
- ❌ Estilização da barra de pesquisa (jonata)

---

## Como Executar 

Para executar esta aplicação, siga estes passos:

1. **Certifique-se de que o XAMPP esteja instalado e configurado no seu sistema.**
2. **Coloque o diretório do projeto 'NutriCalc' dentro da pasta 'htdocs' do XAMPP.**
3. **Inicie o servidor Apache e o MySQL através do painel de controle do XAMPP.**
4. **Abra seu navegador e acesse `http://localhost/NutriCalc`.**

---

## 📊 Como Popular o Banco de Dados

Para popular o banco de dados da aplicação NutriCalc com tabelas e dados iniciais, siga estas instruções:

1. **Configuração Inicial do Banco de Dados**:
   - Acesse `http://localhost/NutriCalc/setup_database.php` no seu navegador para executar os scripts de setup.
   - Este script criará as tabelas necessárias ('usuarios' e 'alimentos') e configurará um usuário admin padrão com email 'admin@nutricalc.com' e senha 'AdminPass123'.
   - Após a execução, delete o arquivo 'setup_database.php' do servidor por motivos de segurança.

2. **Gerenciamento de Alimentos via Painel Admin**:
   - Faça login com as credenciais de admin.
   - Acesse o painel de administração em `http://localhost/NutriCalc/pages/admin/admin.php`.
   - Use o botão "Criar Novo Alimento" para adicionar novos itens à tabela 'alimentos' com informações como descrição, categoria, energia (kcal), proteína (g), lipídios (g) e carboidratos (g).
   - Você também pode editar ou deletar alimentos existentes diretamente na lista exibida no painel.

3. **Adição de Dados de Amostra (Opcional)**:
   - Execute o script `http://localhost/NutriCalc/scripts/inserir_alimentos_amostra.php` (se disponível) para popular a tabela 'alimentos' com dados de exemplo. Certifique-se de deletar ou proteger este script após o uso.
