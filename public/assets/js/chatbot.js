function sendQuestion(question) {
  addMessage("Usuário", question);

  fetch('/router.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ question: question })
  })
  .then(response => response.json())
  .then(data => {
    addMessage("NutriBot", data.response);
  })
  .catch(error => {
    addMessage("NutriBot", "Erro ao responder. Tente novamente.");
  });
}

function addMessage(sender, text) {
  const chat = document.getElementById("chatbot-messages");
  const msg = document.createElement("div");
  msg.className = "chatbot-message";
  msg.innerText = sender + ": " + text;
  chat.appendChild(msg);
  chat.scrollTop = chat.scrollHeight;
}
