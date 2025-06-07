document.addEventListener("DOMContentLoaded", () => {
  const chat = document.getElementById("chat-body");

  document.querySelectorAll(".quick-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const texto = btn.textContent.toLowerCase();
      chat.innerHTML += `<div class="user-msg">${btn.textContent}</div>`;

      let resposta = "Desculpe, não entendi.";
      if (texto.includes("caloria")) {
        resposta = "Você pode calcular suas calorias na Calculadora de Calorias!";
      } else if (texto.includes("imc")) {
        resposta = "Use a Calculadora de IMC!";
      } else if (texto.includes("água") || texto.includes("agua")) {
        resposta = "Beba cerca de 35ml por kg!";
      } else if (texto.includes("dieta")) {
        resposta = "Está buscando emagrecer ou ganhar massa?";
      }

      chat.innerHTML += `<div class="bot-msg">${resposta}</div>`;
      chat.scrollTop = chat.scrollHeight;
    });
  });

  document.getElementById("fechar").onclick = () => {
    document.getElementById("chatbot-box").style.display = "none";
  };
});
