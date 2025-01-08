<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel de Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        /* Estilo da parte superior */
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 30px;
            font-size: 24px;
        }

        /* Layout do painel */
        .container {
            display: flex;
            flex: 1;
        }

        /* Área central (senha atual) */
        .center {
            flex: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            font-size: 48px;
            font-weight: bold;
            color: #333;
            border-right: 2px solid #ddd;
        }

        /* Área lateral (últimas senhas chamadas) */
        .side {
            flex: 1;
            background-color: #e9e9e9;
            padding: 10px;
            overflow-y: auto;
            height: 100%;
        }

        .side h3 {
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        .side ul {
            list-style-type: none;
            padding: 0;
        }

        .side ul li {
            background-color: #fff;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            font-size: 18px;
            text-align: center;
        }
        .blink {
    animation: blink-effect 0.5s step-start 3; /* Pisca 3 vezes */
  }

  @keyframes blink-effect {
    50% {
      opacity: 0;
    }
  }
        /* Faixa inferior de informações adicionais */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 30px;
            font-size: 16px;

        }
    </style>
</head>
<body>

    <div class="header">
        E-fila idPainel
    </div>

    <div class="container">
        <!-- Área central (senha atual) -->

        <div class="center">
            <div id="senha-atual">


            </div>
        </div>

        <!-- Área lateral (últimas senhas chamadas) -->
        <div class="side">
            <h3>Últimas Senhas</h3>
            <ul id="ultimas-senhas">

            </ul>
        </div>
    </div>

    <!-- Faixa inferior com informações adicionais -->
    <div class="footer">
        <marquee>ESPERE SUA SENHA SER CHAMADA</marquee>
    </div>
    <script>
function speak(senhaAtual) {
  // Verifica se a API SpeechSynthesis está disponível
  if ('speechSynthesis' in window) {
    // Criar uma instância de SpeechSynthesisUtterance
    const utterance = new SpeechSynthesisUtterance(senhaAtual);
    utterance.lang = 'pt-BR';

    // Falar o texto
    speechSynthesis.speak(utterance);

    // Aplica o efeito de piscar
    const senhaAtualElement = $('#senha-atual'); // Seleciona o elemento
    // Aplica o efeito de piscar (mostrar e esconder)
    let blinkCount = 0;
    const interval = setInterval(() => {
      if (blinkCount < 3) {  // Número de piscadas (3 vezes)
        // Alterna a visibilidade (esconde ou mostra)
        senhaAtualElement.toggle();
        blinkCount++;
      } else {
        clearInterval(interval);  // Para o intervalo após 3 piscadas
        senhaAtualElement.show();  // Garante que o texto fique visível no final
      }
    }, 500);  // Intervalo entre esconder e mostrar (0.5s)
  } else {
    alert('Desculpe, seu navegador não suporta a API Web Speech.');
  }
}



 function naoCompareceu() {
    $.ajax({
        url: `http://efila.test/painel.painelAtualiza/{{$id_painel}}`, // Endpoint da API
        type: 'GET', // Método da requisição
        dataType: 'json', // Formato da resposta esperada
        success: function (response) {
            console.log(response.senha.sigla); // Exibe toda a resposta para depuração

            // Exibindo os dados da senha atual, se houver

                $('#senha-atual').html(
                    `${response.senha.sigla}${response.senha.numero}<br>
                    ${response.senha.nome_local}: ${response.senha.numero_local}`
                );
                if(response.senha.status=='chamar'){
                    senhaAtual ='Senha '+$('#senha-atual').text()
                    speak(senhaAtual);
                    // Adiciona a classe para o efeito de piscar

                }

            // Manipulando o histórico
            if (response.historico && Array.isArray(response.historico) && response.historico.length > 0) {
               // $('#ultimas-senhas').empty(); // Limpa a lista anterior

                // Limita o histórico a no máximo 5 arrays

                            $('#ultimas-senhas').html(`<li>
                                ${response.historico[0][0].sigla}${response.historico[0][0].numero}<br>
                                ${response.historico[0][0].nome_local}: ${response.historico[0][0].numero_local}
                            </li>
                            <li>
                                ${response.historico[0][1].sigla}${response.historico[0][1].numero}<br>
                                ${response.historico[0][1].nome_local}: ${response.historico[0][1].numero_local}
                            </li>
                            <li>
                                ${response.historico[0][2].sigla}${response.historico[0][2].numero}<br>
                                ${response.historico[0][2].nome_local}: ${response.historico[0][2].numero_local}
                            </li>
                            <li>
                                ${response.historico[0][3].sigla}${response.historico[0][3].numero}<br>
                                ${response.historico[0][3].nome_local}: ${response.historico[0][3].numero_local}
                            </li>

                            `);




            } else {
                $('#ultimas-senhas').html('<li>Nenhuma senha foi chamada</li>');
            }
        },

        error: function (xhr, status, error) {
            console.error("Erro ao buscar fila: ", status, error);
            $('#fila-container').html('Erro ao carregar a fila.');
        }
    });
}

// Atualiza automaticamente a cada 5 segundos
setInterval(naoCompareceu, 10000);



</script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="http://efila.test/assets/libs/jquery/jquery-1.11.1.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap/js/bootstrap.min.js"></script>
	<script src="http://efila.test/assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://efila.test/assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
	<script src="http://efila.test/assets/libs/jquery-detectmobile/detect.js"></script>
	<script src="http://efila.test/assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
	<script src="http://efila.test/assets/libs/ios7-switch/ios7.switch.js"></script>
	<script src="http://efila.test/assets/libs/fastclick/fastclick.js"></script>
	<script src="http://efila.test/assets/libs/jquery-blockui/jquery.blockUI.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
	<script src="http://efila.test/assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="http://efila.test/assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
	<script src="http://efila.test/assets/libs/nifty-modal/js/classie.js"></script>
	<script src="http://efila.test/assets/libs/nifty-modal/js/modalEffects.js"></script>
	<script src="http://efila.test/assets/libs/sortable/sortable.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-select2/select2.min.js"></script>
	<script src="http://efila.test/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="http://efila.test/assets/libs/pace/pace.min.js"></script>
	<script src="http://efila.test/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="http://efila.test/assets/libs/jquery-icheck/icheck.min.js"></script>

	<!-- Demo Specific JS Libraries -->
	<script src="http://efila.test/assets/libs/prettify/prettify.js"></script>


</body>
</html>
