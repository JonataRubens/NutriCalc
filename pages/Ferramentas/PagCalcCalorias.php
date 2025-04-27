<?php include('../../includes/NavBar.php'); ?>
<link rel="stylesheet" href="../../assets/css/CalcCalorias.css">

<main class="container">
 <div class="calorico-wrapper">
    <h1>Tabela Nutricional</h1>
      <h2>Calculadora de calorias e nutrientes</h2>
       <p>Calcule as calorias e nutrientes dos alimentos consumidos no seu dia a dia.</p>
   <!-- Calculadora de calorias dos alimentos -->
       <div class="cal_D_Calorias">
            <h3>Calculadora de calorias dos alimentos</h3>
            <button class="botao-retratil">
                <span class="icone">📤</span>
                <span class="texto">Exportar</span>
            </button>
       </div>

      <section class="box_calendario">
            <!-- Dias da Semana-->
            <div class="calendario">
                
                <div class="bts_dias-da-semana">
                <button type="button" onclick="selectDate(this, 'Segunda')">Segunda</button>
                <button type="button" onclick="selectDate(this, 'Terça')">Terça</button>
                <button type="button" onclick="selectDate(this, 'Quarta')">Quarta</button>
                <button type="button" onclick="selectDate(this, 'Quinta')">Quinta</button>
                <button type="button" onclick="selectDate(this, 'Sexta')">Sexta</button>
                <button type="button" onclick="selectDate(this, 'Sábado')">Sábado</button>
                <button type="button" onclick="selectDate(this, 'Domingo')">Domingo</button>
                </div>

                <div class="data">
                    <span id="data-atual">data atual</span>
                    <span class="icone-calendario">📅</span>
                </div>
            </div>
      </section>

    <button class="collapsible-button active">
        <svg viewBox="0 0 24 24">
            <path fill="currentColor" d="M7.41 9.59L12 14.17l4.59-4.58L18 11l-6 6-6-6 1.41-1.41z"/>
        </svg>
        <span>Resultado do cálculo calórico</span>
    </button>
    <div class="content open">
        <div class="calorie-info-grid">
            <div class="calorie-box">
                Total de calorias nas refeições
                <br>
                <strong>0 calorias</strong>
            </div>
            <div class="macro-info">
                <div class="macro-item carbohydrate">
                    <div class="macro-label">Carboidratos</div>
                    <div class="macro-bar">
                        <div class="macro-bar-fill" style="width: 0%;"></div>
                    </div>
                    <span class="macro-amount">0 g</span>
                </div>
                <div class="macro-item protein">
                    <div class="macro-label">Proteínas</div>
                    <div class="macro-bar">
                        <div class="macro-bar-fill" style="width: 0%;"></div>
                    </div>
                    <span class="macro-amount">0 g</span>
                </div>
                <div class="macro-item fat">
                    <div class="macro-label">Lipídeos</div>
                    <div class="macro-bar">
                        <div class="macro-bar-fill" style="width: 0%;"></div>
                    </div>
                    <span class="macro-amount">0 g</span>
                </div>
            </div>
            <div class="action-buttons">
                <a href="#" class="action-button">Calcular meu gasto calórico diário</a>
                <a href="#" class="action-button secondary">Incluir gasto calórico manualmente</a>
            </div>
        </div>
        <a href="#" class="more-details">Mais detalhes sobre meu gasto calórico diário</a>
    </div>

    <button class="collapsible-button">
        <svg viewBox="0 0 24 24">
            <path fill="currentColor" d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6 1.41 1.41z"/>
        </svg>
        <span>Refeições</span>
    </button>
    <div class="content">
            <div class="refeicao-card">
    <div class="refeicao-header">
        <div class="refeicao-info">
        <div class="refeicao-icon">🍳</div>
        <div class="refeicao-titulo">Café da manhã</div>
        </div>
        <div class="refeicao-nutrientes">
            <div>Calorias<br><strong>0 kcal</strong></div>
            <div>Carboidratos<br><strong>0 g</strong></div>
            <div>Proteínas<br><strong>0 g</strong></div>
            <div>Lipídeos<br><strong>0 g</strong></div>
            <svg class="seta-abrir" viewBox="0 0 24 24">
                <path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
            </svg>
        </div>
    </div>
        <div class="refeicao-conteudo" style="max-height: 0;">
        </div>
    </div>
    <div class="refeicao-card add-refeicao">
    <div class="refeicao-header" style="justify-content: center;">
        <div style="display: flex; align-items: center; gap: 8px; color: #888;">
        <span style="font-size: 24px;">➕</span> Adicionar nova refeição
        </div>
    </div>
    </div>


    </div>

    <div class="save-button-container">
        <button class="save-button">Salvar</button>
    </div>

    <!-- Modal de Gasto Calórico -->
<div id="modalGastoCalorico" class="modal" style="display: none;">
  <div class="modal-content">
    <span id="closeModal" class="close-button">&times;</span>
    <h2>Calculadora de Gasto Calórico</h2>
        <p>Preencha as informações abaixo para obter seu gasto calórico diário</p>

        <div class="formulario-grid">
        <div class="form-group">
            <label>Sexo</label>
            <div class="sexo-buttons">
            <button type="button" onclick="selectSexo(this, 'male')">Homem</button>
            <button type="button" onclick="selectSexo(this, 'female')">Mulher</button>
            
            </div>
        </div>
        <div class="form-group">
            <label>Idade</label>
            <input type="number" id="idade" placeholder="Idade">
        </div>
        <div class="form-group">
            <label>Altura</label>
            <input type="number" id="altura" placeholder="Altura (cm)">
        </div>
        <div class="form-group">
            <label>Peso</label>
            <input type="number" id="peso" placeholder="Peso (kg)">
        </div>
        <div class="form-group">
            <label>Exercício físico</label>
             <select id="atividade" required>
            <option value="">Selecione</option>
            <option value="1.2">Sedentário</option>
            <option value="1.375">Levemente ativo</option>
            <option value="1.55">Moderadamente ativo</option>
            <option value="1.725">Muito ativo</option>
            <option value="1.9">Extremamente ativo</option>
          </select>
        </div>
        <div class="form-group">
            <label>Objetivo</label>
            <select id="objetivo" required>
            <option value="">Selecione</option>
            <option value="deficit">Perder peso</option>
            <option value="manter">Manter peso</option>
            <option value="excedente">Ganhar massa</option>
          </select>
        </div>
        </div>

        <div class="calcular-button">
        <button>Calcular Gasto Calórico</button>
        </div>
  </div>



</div>
   <hr class="linha-divisoria">
      <!-- Calculadoras -->
    <h3>Conheça nossas Ferramentas Nutricionais</h3>
    <section class="calculadoras">
      <div class="calc-card gratuito" style="border-left: 6px solid #06b6d4;">
        <h4>Calculadora de Calorias</h4>
        <p>Descubra quantas calorias e nutrientes você consome ao montar suas refeições diárias.</p>
        <a href="#">Calcular calorias</a>
      </div>

      <div class="calc-card gratuito" style="border-left: 6px solid #ef4444;">
        <h4>Calculadora de IMC</h4>
        <p>Verifique se seu peso está adequado para sua altura com base no Índice de Massa Corporal.</p>
        <a href="#">Calcular IMC</a>
      </div>
    </section>
  </main>

</main>

  <script>
    let date = null;

    function selectDate(button, value) {
      document.querySelectorAll(".bts_dias-da-semana button").forEach((btn) => btn.classList.remove("active"));
      button.classList.add("active");
      date = value;
    }

    const collapsibleButtons = document.querySelectorAll('.collapsible-button');

    collapsibleButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');
            const content = this.nextElementSibling;

            if (content.classList.contains('content')) {
                if (content.style.maxHeight) {
                    content.style.maxHeight = null; // Fecha
                } else {
                    content.style.maxHeight = content.scrollHeight + "px"; // Abre certinho com altura do conteúdo
                }
            }
        });
    });

    // Modal abrir e fechar
    const openModalBtn = document.querySelector('.action-buttons .action-button'); // botão "Calcular meu gasto calórico diário"
    const modal = document.getElementById('modalGastoCalorico');
    const closeModalBtn = document.getElementById('closeModal');

    openModalBtn.addEventListener('click', function(event) {
    event.preventDefault();
    modal.style.display = 'flex';
    });

    closeModalBtn.addEventListener('click', function() {
    modal.style.display = 'none';
    });

    // Fechar o modal se clicar fora da caixa
    window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
    });

    // Quando clicar no botão de calcular
    const calcularBtn = document.querySelector('.calcular-button button');
    calcularBtn.addEventListener('click', function() {
        const sexo = sexoSelecionado;
        const idade = document.getElementById('idade').value;
        const altura = document.getElementById('altura').value;
        const peso = document.getElementById('peso').value;
        const exercicio = document.getElementById('atividade').value;
        const objetivo = document.getElementById('objetivo').value;

        // Aqui você faria seu cálculo baseado nesses valores
        let gastoCalorico = calcularGastoCalorico(sexo, idade, altura, peso, exercicio, objetivo);

        mostrarResultado(gastoCalorico);
        modal.style.display = 'none'; // fecha o modal
    });

    // Função para calcular (simples exemplo)
    function calcularGastoCalorico(sexo, idade, altura, peso, exercicio, objetivo) {
        let bmr;
        if (sexo === 'male') {
            bmr = 10 * peso + 6.25 * altura - 5 * idade + 5;
        } else if (sexo === 'female') {
            bmr = 10 * peso + 6.25 * altura - 5 * idade - 161;
        }
        if (!sexoSelecionado) {
            alert('Por favor, selecione o sexo.');
            return;
        }

        if (!idade || !altura || !peso || !exercicio || !objetivo) {
            alert('Por favor, preencha todos os campos corretamente.');
            return;
        }

        let gastoTotal = bmr * exercicio; // agora multiplica pelo nível de atividade

        // Ajuste conforme o objetivo
        if (objetivo === 'deficit') {
            gastoTotal -= 500; // déficit para emagrecer
        } else if (objetivo === 'excedente') {
            gastoTotal += 500; // superávit para ganhar massa
        }
        
        return Math.round(gastoTotal); // arredonda pra não ficar quebrado
    }



    // Função para mostrar o resultado
    function mostrarResultado(gasto) {
        const boxCalorias = document.querySelector('.calorie-box strong');
        boxCalorias.textContent = `${gasto} calorias`;
    }

    let sexoSelecionado = null;

    function selectSexo(button, sexo) {
        sexoSelecionado = sexo;

        // Tirar "ativo" dos outros botões
        document.querySelectorAll('.sexo-buttons button').forEach(btn => btn.classList.remove('active'));
        
        // Colocar "ativo" no botão clicado
        button.classList.add('active');
    }

    this.classList.toggle('active');

    const refeicaoToggles = document.querySelectorAll('.refeicao-toggle');

    refeicaoToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            this.classList.toggle('active');
            const content = this.nextElementSibling;

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    });

    const refeicaoCards = document.querySelectorAll('.refeicao-card');

    refeicaoCards.forEach(card => {
    const header = card.querySelector('.refeicao-header');
    const content = card.querySelector('.refeicao-conteudo');

    header.addEventListener('click', () => {
        card.classList.toggle('active');

        if (content.style.maxHeight) {
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        }
    });
    });


  </script>

<?php include('../../includes/Footer.html'); ?>