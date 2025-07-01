# NutriCalc

## Informações do Projeto

- **Universidade**: UNIVESIDADE FEDERAL DO TOCANTINS
- **Curso**: CIENCIAS DA COMPUTACAO
- **Disciplina**: ENGENHARIA DE SOFTWARE
- **Semestre**: 2025/01
- **Professor**: Edeilson Milhomem da Silva
- **Equipe**: Jonata Rubens, Afonso Dglan, Marcus Vinicius, Caio

## 🧾 Descrição

**NutriCalc** é uma aplicação web desenvolvida com PHP, HTML e CSS, com o objetivo de facilitar o controle e acompanhamento de informações nutricionais. O sistema é pensado para ser simples, intuitivo e útil tanto para usuários comuns quanto profissionais da área de nutrição.

## ✨ Funcionalidades Principais
- Consultar banco de dados de alimentos
- Realizar cálculos nutricionais baseados em refeições
- Calcular gasto energético basal
- Acesso sem login para funcionalidades básicas
- Login opcional para relatórios em PDF
- Sistema de Notas/Lembretes

---

**🎨[Protótipo inicial no Figma](https://www.figma.com/design/lQPOqAeOSFHSjUynHLdZet/Untitled?node-id=74-29&t=8rfjLK28VTN2sojv-1)**

**📄[Documentação das sprints e designações da equipe](https://github.com/JonataRubens/NutriCalc/blob/develop/DocDasSprints.md).**

## 🗣️ Meios de comunicação da equipe
- [Link do Trelo (Fluxo de designações de maneira mais visual e formal)](https://trello.com/invite/b/681a0e4615979a30d0ec83b0/ATTIc2e4c7c4927d05db55ad57c97f0570443321E019/nutricalc).
- Whatsapp
- GitHub
- Trello

---

## LINKS 

**📄[Link Do Projeto Final](http://34.56.153.53/).**

**📄[Link da landing page](https://jonatarubens.github.io/NutriCalc/).**

---

## 🛠 Stack Tecnológica
| Área          | Tecnologias               |
|---------------|---------------------------|
| Front-end     | HTML5, CSS3, JavaScript   |
| Back-end      | PHP                       |
| Versionamento | Git, GitHub               |
| Infra         | Docker                    |

---

## 👥 Especialidades por Área
⚠️**Isso não é uma regra e todos podem trabalhar fora das suas Especialidades**
| Área                          | Especialidades                     |
|-------------------------------|----------------------------------|
| Banco de Dados                | Caio, Afonso e Jonata                   |
| Desenvolvimento Back-End      | Caio, Afonso, Marcus Vinicius, Carlinhos e Jonata |
| Desenvolvimento Front-End     |Marcus Vinicius, Carlinhos e Jonata|
| Testes Unitários              | Todos em suas áreas    |

---

## 📋 Requisitos Funcionais

### 📦RF-01: Cadastro de Usuário
**User Story**:  
"Como usuário, quero criar uma conta e acessar funcionalidades do sistema."

**📝 Regras de Negócio**:
- Campos obrigatórios: nome completo, e-mail e senha
- Senha deve conter no mínimo 8 caracteres

**Tarefas Técnicas**:
- Criar formulário de cadastro
- Implementar validação de campos
- Desenvolver lógica de armazenamento no BD

---

### 📦RF-02: Autenticação de Usuário
**User Story**:  
"Como usuário, quero fazer login, mas que seja opcional. Quero que seja possivel a verificação de estar logado"

**Tarefas Técnicas**:
- Desenvolver formulário de login
- Implementar sistema de autenticação
- Lógica de login/Registro/Logout e visualização

---

### 📦RF-03: Cálculos Nutricionais
**User Story**:  
"Como usuário, quero calcular informações nutricionais das minhas refeições para ter um acompanhamento mais saudável."

**Tarefas Técnicas**:
- Desenvolver interface de registro de refeições
- Implementar algoritmos de cálculo nutricional
- Criar visualização de resultados

---

### 📦RF-04: Calculadora Avançada de Calorias
**User Story**:  
"Como usuário, quero uma calculadora precisa de calorias com visual moderno para acompanhar meu consumo diário de forma mais eficiente."

**📝 Regras de Negócio**:
- Cálculo baseado em: idade, peso, altura, gênero e nível de atividade
-  Exibição de macros (proteínas, carboidratos, gorduras)
- Todos os alimentos devem estar no Banco de Dados

---

### 📦RF-05: Geração de PDF com Informações Pessoais e Cálculos
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

---

### 📦RF-06: Geração de PDF com Lista de Alimentos
**User Story:**
"Como usuário, quero baixar um PDF com todos os alimentos cadastrados para consultar offline ou compartilhar."

**📝 Regras de Negócio:**

- Disponível apenas para usuários logados.
- Deve listar todos os alimentos com seus respectivos nutrientes (calorias, proteínas, lipídios, carboidratos).
- Deve ter cabeçalho, logo da aplicação e data de emissão.
- Layout organizado em formato de tabela.

**Tarefas Técnicas:**

-  Implementar script para extrair dados da tabela de alimentos
-  Gerar PDF em formato tabular com mPDF ou DomPDF
-  Bloquear acesso à geração caso o usuário não esteja autenticado
-  Incluir nome do usuário e data na exportação

---

### 📦RF-07: Criação da página de admin, Adição de informações ao user
**User Story:**
"Eu como super usuario quero ter uma tela de login para poder administrar usuarios e alimentos onde poderá ser realizado CRUD"

**📝 Regras de Negócio:**
- Só vai ter 1 superUser onde será registrado diretamente ao BD
- Será possivel fazer operacoes crud dentro da pagina admin
- Terá uma url a parte do do projeto
- A adição de dados é opcional

**Tarefas Técnicas:**
- Criar página de admin
- CRUD dentro da pagina admin
- Adição de mais dados de usuario

---

### 📦RF-08: Criação da opcao de lembretes/notas
**User Story:**
"Eu como Usuario estando logado quero que seja possivel a adicao de lembretes para mim poder ter onde guardar estatistica corporais ou mensagens"

**📝 Regras de Negócio:**
- Sera possivel apenas se estiver logado 
- Será possivel mesmo com o perfil incompleto
- CRUD das notas responsivel e de facil entendimento
- Visualizar todas as notas em um so lugar
- Abrir as notas e que seja possivel a edicao e exclusao da notas sem afetar as outras notas

**Tarefas Técnicas:**
- Criar uma pagina para visualizacao de todas as notas
- CRUD Dentro de Notas
- Implementar logica de sessao nas notas afim de impedir links diretos

---


### 📦RF-09: Ranking de alimentos, Adição de "meus alimentos" 
**User Story:**
"Eu como usuario logado quero um ranking de alimentos mais saudaveis e que seja possivel a adicao de meus alimentos"

**📝 Regras de Negócio:**
- Todos os alimentos de "Meus alimentos" não serão adicionados junto aos alimentos do BD
- Cada usuario terá a aba seus alimentos
- O ranking poderá levar em consideração 3 topicos no maximo
- A adição de alimentos é opcional

**Tarefas Técnicas:**
- Criar o ranking de alimentos saudaveis
- Criação da aba meus alimentos

---

### 📦RF-10: Calculadora avançada 2
**User Story:**
"Eu como usuario quero uma calculadora de ciclos de hormonios"

**📝 Regras de Negócio:**
- Essa calculadora só sera acessada com o usuario logado, e salva no id de usuario
- será possivel o salvamentos desses dados por meio da geracao de pdf
- Precisará ser levado em consideração os dados dos usuario já preenchidos sendo obrigatorio esses dados

**Tarefas Técnicas:**
- Criar a calculadora hormonal
- Só sera possivel o uso se estiver logado
- ser possivel o download desses dados em pdf

---

### 📦 RF-11 Api, testes e MVC
**User Story:**
"Eu como Usuario Administrador afim de deixar tudo pronto para uso externo o uso de api se torna necessario, e os testes andam lado a lado para assim garantir um codigo polido e funcional"

**📝 Regras de Negócio:**
- A API estará acessivel no painel administrativo
- terá arquivos separados para cada teste em determinado aplicação
- Organização no padrão MVC

**Tarefas Técnicas:**
- Criação de API
- Implementação de testes unitarios
- Reorganizar código fonte no padrão MVC

---

### 📦 RF-12 Contato com nutricionistas e chat bot
**User Story:**
"Eu como usuario estando logado, quero que seja possivel abrir um chamado onde poderei mandar um email para uma nutricionista e quero um chat bot para me ajudar com perguntas simples e intuitivas"

**📝 Regras de Negócio:**
- Chat bot, deverá estar disponivel na pagina home apenas
- O ato de mandar um email para o nutricionista, só será possivel após o cadastro do usuario
- O email será uma mensagem que poderá ser mandada e terá retorno pelo Gmail e não pelo site

**Tarefas Técnicas:**
- Criação do chat bot
- Opção de mandar email em perfil
- Sistemas de testes
  
---


### 📦 RF-13 Lista de comparação
**User Story:**
"Eu como usuario não final, quero uma ferramenta que me possibilite a comparação de alimentos destacando pontos entre os alimentos"

**📝 Regras de Negócio:**
- Poderá ser feita sem estar logado
- Destacar pontos entres os alimentos
- Permitir apenas 1 comparação por vez
- Apresentar de manaeira visual e única

**Tarefas Técnicas:**
- Lista de comparação dentro da despensa digital
  
---

### 📦 RF-14 Sistema de testes mais complexos
**User Story:**
"como administrador quero um sistema de testes completos no site afim de ter mais controle sobre o que acontec no back end"

**📝 Regras de Negócio:**
- Deverá ter uma pasta para por todos os testes

**Tarefas Técnicas:**
- Criação de sistemas de testes no back end

---


### 📦 RF-15 Sistema de anuncios
**User Story:**
"Afim de fazer a propaganda para o usuario fazer o cadastro no site, quero uma sistema de anuncio amigavel"

**📝 Regras de Negócio:**
- Será mostrado um modal de anuncio para cadastro quando disparado determinado eventos

**Tarefas Técnicas:**
- Implementar logica para isso acontece apenas quando nao estiver logado

---


## 🚀 Roadmap de Sprints

### 🧮Sprint 01 (08/04/2025 - 29/04/2025)
**Objetivo**:  
Oferecer experiência inicial de navegação e acesso ao sistema com cadastro e login. Permitir montagem de refeições personalizadas e cálculos nutricionais.

**Entregas**:
- Tela inicial acessível sem login
- Componentes de navegação (Criar Conta/Fazer Login)
- Implementação do RF-01 (Cadastro)
- Sistema de busca de alimentos (RF-03)
- Cálculo e exibição de nutrientes totais
- Implementação do cálculos Nutricionais

---

### 🧮Sprint 02 (30/04/2025 - 13/05/2025)

**Objetivo**: 
Geração de PDFs, Calculadora Avançada de Calorias, Perfil com dados do user, Pagina de admin para controle de usuarios e alimentos no bd, Criar um sistema de Lembretes/notas

**Entregas**:
- Adição de mais informações ao perfil de usuario (afonso)
- Calculadora Avançada (RF-04) (carlos)
- Geração de PDF com informações pessoais + resultados de cálculos, lista de alimentos cadastrados  (RF-05) (marcos)
- Bloqueio da geração se não estiver logado ou perfil incompleto (marcos)
- Implementação da pagina de admin (RF-07) (caio) 
- Criacao de Notas/Lembretes (RF-08 )(Jonata)

---


### 🧮Sprint 03 (13/05/2025 - 27/05/2025)

**Objetivo**: 
Criação de calculadora hormonal, ranking de alimentos mais saudaveis a fim de deixar claro para o usuario alimentos saudaveis com base em 3 filtros, implementação de API, testes e reorganização no padrão MVC

**Entregas**:

- Calculadora Avançada2 (RF-10) (Marcos)
- Meus alimentos (RF-09) (Jonata)
- Ranking de alimentos mais saudaveis (RF-09) (Caio)
- API (RF-11) (Caio)
- Reorganização no padrão MVC (RF-11) (Jonata/Caio)

---

### 🧮Sprint 04 (27/05/2025 - 10/06/2025)

**Objetivo**: 
Criar um sistema de chat bot para responder perguntas simples, criação do sistema de testes para prever erros que possam vier a tona, ferramenta de substituição de alimentos onde no futuro será integrado aos meus alimentos e sistema para ser possivel o envio de email para um nutricionista.

**Entregas**:
- Lista de Substituições (RF-09) (Afonso)
- Chat Bot (RF-12) (Marcos)
- Sistema de Testes (RF-11) (Caio)
- Contato com Nutricionista (RF-12) (Jonata)

---

### 🧮Sprint 05 (10/06/2025 - 24/06/2025)

**Objetivo**: 
Criação de features mais simples para os usuarios não finais com teor visual mais forte, finalização de features que ficaram para trás além refinamentos.

**Entregas**:
- Lista de comparação (RF-13) (Jonata)
- Sistema de testes mais complexos (RF- 14) (Caio)
- Refatoração da lista de substituição e implementação a lista de alimentos (RF- 09) (Afonso)
- Sistema de anuncios (RF- 15) (Marcos)

---

### Ultima semana (24/06/2025 - 01/06/2025)
- Semana de polimentos se for necessario nas features, mas devido a organização tomada pelo lider, não será preciso, o projeto se encontra finalizado, podendo ter apenas commits sobre documentação do projeto!!! 


## Como Executar 

Para executar esta aplicação, siga estes passos:

1.  **Certifique-se de ter o Docker esteja instalado.**
2.  **Navegue até o diretório do projeto no seu terminal.**
3.  **Execute `docker-compose up --build -d` para construir e iniciar os containers.**
4.  **Abra seu navegador e acesse `http://localhost`.**
