const alimentos = [
  "Açúcar refinado", "Alface crua", "Arroz branco cozido", "Arroz integral cozido",
  "Azeite de oliva", "Banana prata", "Carne bovina (contra-filé) grelhada",
  "Cenoura crua", "Chocolate ao leite", "Feijão preto cozido", "Grão-de-bico cozido",
  "Iogurte natural integral", "Laranja", "Leite integral UHT", "Lentilha cozida",
  "Maçã com casca", "Manteiga com sal", "Mel", "Óleo de soja", "Pão de forma integral",
  "Peito de frango grelhado", "Peixe (tilápia) grelhado", "Queijo muçarela", "Tomate cru"
];

function setupAutocomplete(inputId, boxId) {
  const input = document.getElementById(inputId);
  const box = document.getElementById(boxId);

  input.addEventListener("input", function () {
    const val = this.value.toLowerCase();
    box.innerHTML = "";

    if (val.length < 2) return;

    const sugestoes = alimentos.filter(alimento => 
      alimento.toLowerCase().includes(val)
    );

    sugestoes.forEach(alimento => {
      const div = document.createElement("div");
      div.textContent = alimento;
      div.onclick = () => {
        input.value = alimento;
        box.innerHTML = "";
      };
      box.appendChild(div);
    });
  });

  document.addEventListener("click", function (e) {
    if (!box.contains(e.target) && e.target !== input) {
      box.innerHTML = "";
    }
  });
}

setupAutocomplete("alimento1", "sugestoes1");
setupAutocomplete("alimento2", "sugestoes2");

