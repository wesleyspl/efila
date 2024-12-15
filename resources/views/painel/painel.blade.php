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
            padding: 10px;
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

        /* Faixa inferior de informações adicionais */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
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
        <marquee>e-fila</marquee>
    </div>
    <script>
    function naoCompareceu() {
    $.ajax({
        url: 'http://efila.test/painel.painelAtualiza/{{$id_painel}}', // Endpoint da sua API
        type: 'GET', // Método da requisição
        dataType: 'json', // Formato de resposta esperado
        success: function(response) {
            console.log(response.historico[0]); // Verifique a estrutura da resposta

            // Exibindo os dados da primeira senha, caso exista
            if (response.senha.length > 0) {
                $('#senha-atual').html(
                    response.senha[0].sigla + response.senha[0].numero + '<br>' +
                    response.senha[0].nome_local + ':' +response.senha[0].numero_local
                );
            }

            if (response.historico && Array.isArray(response.historico) && response.historico.length > 0) {
    // Limpa o conteúdo atual da lista
    $('#ultimas-senhas').empty();
          var listItem=null;
    // Itera sobre os dados retornados para a chave 'historico'
    response.historico.forEach(function(historicoArray) {
        // Verifica se o array 'historicoArray' tem pelo menos um item
        if (Array.isArray(historicoArray) && historicoArray.length > 0) {
            historicoArray.reverse();
            // Itera sobre os itens dentro de cada sub-array 'historicoArray'
            historicoArray.forEach(function(historico) {
                // Cria um novo item de lista para cada 'historico'
                   listItem = '<li>' +
                    historico.sigla + historico.numero + '<br>' +
                    historico.nome_local + ':' + historico.numero_local +
                    '</li>';

                // Adiciona o item na lista
                $('#ultimas-senhas').append(listItem);
               // $('#ultimas-senhas').html(listItem);
            });
        }
    });   } else {
                // Se não houver dados ou não for um array de senhas, exibe uma mensagem de erro
                $('#ultimas-senhas').html('<li>Nenhuma senha foi chamada</li>');
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro ao buscar fila: ", status, error);
            $('#fila-container').html('Erro ao carregar a fila.');
        }
    });
}



    setInterval(naoCompareceu, 5000);


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
