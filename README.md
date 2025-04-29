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
| Desenvolvimento Back-End      | Caio, Afonso e Jonata           |
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
-  Cálculo baseado em: idade, peso, altura, gênero e nível de atividade
-  Exibição de macros (proteínas, carboidratos, gorduras)
-  Todos os alimentos devem estar no Banco de Dados
-  Testes unitários 

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

### 🧮Sprint 03 (06/05/2025 - 20/05/2025)

**Objetivo**: 
Finalizar a calculadora nutricional e melhorar a experiência visual em toda a aplicação.

**Detalhes das Melhorias**:
**Blog**:
   - Atualização dos artigos sobre nutrição
   - Cards com imagens e resumos
   - Sistema de tags
**Calculadoras**:
   - Novo visual com gráficos interativos
   - Implementação da adição de alimentos com alimentos dos Banco de Dados

## 📌 Tarefas Técnicas Pendentes
- ❌ Desenvolvimento de relatórios em PDF
- ❌ Lógica de adição de refeições diárias
- ❌ Implementação de testes
- ✔️  (50% Completo) Criar visualização de resultados em pdf
---



      
## Como Executar 

Para executar esta aplicação, siga estes passos:

1.  **Certifique-se de ter o Docker esteja instalado.**
2.  **Navegue até o diretório do projeto no seu terminal.**
3.  **Execute `docker-compose up --build -d` para construir e iniciar os containers.**
4.  **Abra seu navegador e acesse `http://localhost`.**
