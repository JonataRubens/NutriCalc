document.addEventListener("DOMContentLoaded", () => {
  const chat = document.getElementById("chat-body");
  const chatbotBox = document.getElementById("chatbot-box");
  const toggleButton = document.getElementById("chat-toggle");
  const fecharBtn = document.getElementById("fechar");

  // Inicia minimizado
  chatbotBox.style.display = "none";

  // Alternar visibilidade do chatbot
  toggleButton.addEventListener("click", () => {
    chatbotBox.style.display = chatbotBox.style.display === "none" ? "flex" : "none";
  });

  // Botão de fechar minimiza o chatbot
  fecharBtn.onclick = () => {
    chatbotBox.style.display = "none";
  };

  // Lógica de botões rápidos
  document.querySelectorAll(".quick-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const texto = btn.textContent.toLowerCase();
      chat.innerHTML += `<div class="user-msg">${btn.textContent}</div>`;

      let resposta = "Desculpe, não entendi.";
      if (texto.includes("caloria")) {
        resposta = "Você pode calcular suas calorias na <a href='/calorias'>Calculadora de Calorias</a>!";
      } else if (texto.includes("imc")) {
        resposta = "Use a <a href='/imc'>Calculadora de IMC</a>!";
      } else if (texto.includes("água") || texto.includes("agua")) {
        resposta = "Beba cerca de 35ml por kg!";
      } else if (texto.includes("dieta")) {
        resposta = "Está buscando emagrecer ou ganhar massa?";
      }

      chat.innerHTML += `<div class="bot-msg">${resposta}</div>`;
      chat.scrollTop = chat.scrollHeight;
    });
  });
});
