document.addEventListener("DOMContentLoaded", () => {
  const chat = document.getElementById("chat-body");
  const chatbotBox = document.getElementById("chatbot-box");
  const toggleButton = document.getElementById("chat-toggle");
  const fecharBtn = document.getElementById("fechar");
  const quickQuestions = document.getElementById("quick-questions");
  const subQuestions = document.getElementById("sub-questions");

  chatbotBox.style.display = "none";

  toggleButton.addEventListener("click", () => {
    chatbotBox.style.display = chatbotBox.style.display === "none" ? "flex" : "none";
  });

  fecharBtn.onclick = () => {
    chatbotBox.style.display = "none";
  };

  const respostas = {
    
    calorias: `Você pode calcular suas calorias na <a href='/Urls.php?page=cal-gasto' target='_blank'>Calculadora de Calorias</a>.`,
    
    imc: `Use nossa <a href='/Urls.php?page=imc' target='_blank'>Calculadora de IMC</a>.`,
   
    agua: `Beba cerca de 35ml por kg. Veja a <a href='/Urls.php?page=agua' target='_blank'>Calculadora de Água</a>.`,
    
    dieta: `Explore ferramentas de dieta na aba <strong>Ferramentas</strong>.`,
    
    emagrecer: `Consulte a <a href='/Urls.php?page=cal-gasto' target='_blank'>Calculadora de Gasto Calórico</a>.`,
    
    massa: `Ganhe massa com superávit calórico. Comece pela <a href='/Urls.php?page=cal-gasto' target='_blank'>Calculadora de Calorias</a>.`,
    
    login: `O login se localizar no canto superior direito do site. Clique em <strong>Entrar</strong> e preencha seus dados.`,
    
    alimentos: `Você precisa estar logado para ver seus alimentos.`,
    
    ferramentas: `Acesse todas as ferramentas na aba <strong>Ferramentas</strong> do menu.`,
    
    ajuda: `Acesse nossa <a href='/Urls.php?page=contato' target='_blank'>página de suporte</a>.`
  };

  const categorias = {
    saude: [
      { texto: "Calorias", chave: "calorias" },
      { texto: "IMC", chave: "imc" },
      { texto: "Água", chave: "agua" },
      { texto: "Dieta", chave: "dieta" },
      { texto: "Emagrecer", chave: "emagrecer" },
      { texto: "Ganhar Massa", chave: "massa" }
    ],
    conta: [
      { texto: "Login", chave: "login" },
      { texto: "Meus Alimentos", chave: "alimentos" }
    ],
    ferramentas: [
      { texto: "Ver Ferramentas", chave: "ferramentas" }
    ],
    ajuda: [
      { texto: "Ajuda", chave: "ajuda" }
    ]
  };

  // Clique em categoria
  quickQuestions.querySelectorAll(".quick-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const cat = btn.dataset.categoria;
      const opcoes = categorias[cat];

      subQuestions.innerHTML = "";

// Cria os botões da subcategoria
opcoes.forEach(op => {
  const b = document.createElement("button");
  b.className = "quick-btn";
  b.textContent = op.texto;
  b.onclick = () => {
    chat.innerHTML += `<div class="user-msg">${op.texto}</div>`;
    chat.innerHTML += `<div class="bot-msg">${respostas[op.chave]}</div>`;
    chat.scrollTop = chat.scrollHeight;
  };
  subQuestions.appendChild(b);
});

// Botão Voltar
const voltarBtn = document.createElement("button");
voltarBtn.className = "quick-btn voltar-btn";
voltarBtn.textContent = "Voltar";
voltarBtn.style.marginTop = "10px";
voltarBtn.onclick = () => {
  subQuestions.style.display = "none";
  quickQuestions.style.display = "flex";
};
subQuestions.appendChild(voltarBtn);

// Esconde categorias principais e mostra subcategorias
quickQuestions.style.display = "none";
subQuestions.style.display = "flex";

    });
  });
});
