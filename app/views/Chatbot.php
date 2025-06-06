<div id="chatbot-container">
  <div id="chatbot-header">NutriBot 🍎</div>
  <div id="chatbot-body">
    <div id="chatbot-messages"></div>
    <div id="chatbot-options">
      <button onclick="sendQuestion('Qual a quantidade ideal de proteína?')">Quantidade de proteína</button>
      <button onclick="sendQuestion('O que é déficit calórico?')">Déficit calórico</button>
      <button onclick="sendQuestion('Me diga um lanche saudável.')">Lanche saudável</button>
    </div>
  </div>
</div>

<script>
function sendQuestion(question) {
    const chatbox = document.getElementById("chatbox");
    chatbox.innerHTML += `<div class='user-msg'>${question}</div>`;

    fetch("index.php", {
        method: "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: "question=" + encodeURIComponent(question)
    })
    .then(res => res.text())
    .then(data => {
        chatbox.innerHTML += `<div class='bot-msg'>${data}</div>`;
        chatbox.scrollTop = chatbox.scrollHeight;
    });
}
</script>
