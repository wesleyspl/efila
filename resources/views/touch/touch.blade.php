<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EFILA- TOUCH::CERRADO CLOUD</title>
    @livewireStyles
    <!-- Link para o Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
    <link href="{{ asset('assets/libs/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <style>
        /* Garantir que o rodapé fique fixo na parte inferior da página */
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .content {
            flex-grow: 1;
            margin-top: 30px; /* Adicionando margem superior para afastar os botões do cabeçalho */
        }
        
        #cabeca {
           
          
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
        }

        /* Estilo para o container do iframe */
        #pdf-container {
            display: none;
            width: 100%;
            height: 80vh; /* Definindo altura para visualizar o PDF */
            border: 1px solid #ccc;
            margin-top: 20px;
        }

        iframe {
            width: 100%;
            height: 100%;
        }
  /* Estilo para o botão voltar */
  .btn-voltar {
            position: fixed;
            bottom: 70px; /* Acima do rodapé fixo */
            
            left: 20px; /* Alinhado à esquerda */
            z-index: 1000; /* Garantir que o botão fique acima de outros elementos */
        }
        /* Estilo para o spinner de carregamento */
        .spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5rem;
            color: #007bff;
        }
    </style>
</head>
<body>

    <!-- Cabeçalho -->
    <header id='cabeca'>
        <h4>Escolha um serviço </h4>
    </header>

    @livewireScripts
    
    @if (!empty($meus_servicos))
    <div id="senhas"  class="container-fluid content">
        <div class="row ">
        @foreach ($meus_servicos as $meus)
     
           
                <div class="col-md-6 mb-3">
                    <!-- Botão 1 -->
                    <button type="button"  value="{{$meus['servico']->id_servico}}" class="btn btn-block btn-primary btn-lg">
                        {{$meus['servico']->nome}}
                    </button>
                </div>
        
           
        @endforeach
    </div>
    </div>
    @else
    Nenhum servico cadastrad
    @endif
  
    <!-- Spinner de carregamento -->
    <div class="spinner" id="loading-spinner">
        Imprimindo senha ...
    </div




    <!-- Conteúdo Principal -->
    <div id="senhas_imprimir" style="display: none;" class="container-fluid content">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <!-- Botão 1 -->
                <button type="button" id="Normal" value="" class="btn btn-block btn-primary btn-lg">
                    Normal
                </button>
            </div>
            <div class="col-md-6 mb-3">
                <!-- Botão 2 -->
                <button type="button" id="Prioritaria" value="" class="btn btn-block btn-danger btn-lg">
                    Prioritária
                </button>
            </div>
        </div>

       
       <button class="btn btn-lg btn-info btn-voltar glyphicon glyphicon-chevron-left" onclick="voltar()"> Voltar</button>
        <!-- Container do PDF -->
        <div id="pdf-container">
            <iframe id="pdf-iframe" src="" type="application/pdf"></iframe>
        </div>
    </div>
  <!-- Botão Voltar -->
   
    <footer>
        <p>&copy; 2025 Todos os direitos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
         function voltar() {
            $("#senhas_imprimir").hide(); // Esconde a div senhas_imprimir
            $("#senhas").show(); // Mostra a div senhas

            // Mostra o spinner de carregamento
           // $("#loading-spinner").show();

            // Desabilita os botões por 5 segundos
          //  $(".btn-primary, #Normal, #Prioritaria").prop('disabled', true);
          
        }
        $(document).ready(function () {
            function gerarSenha(url) {
                const pdfContainer = document.getElementById('pdf-container');
                const iframe = document.getElementById('pdf-iframe');
                const spinner = document.getElementById('loading-spinner');
                const button = event.target;

                // Desabilita o botão enquanto carrega
                button.disabled = true;
                spinner.style.display = 'block';

                $.ajax({
                    url: url,
                    method: 'GET',
                    xhrFields: {
                        responseType: 'blob' // Define o tipo de resposta como um blob (arquivo binário)
                    },
                    success: function (response) {
                        // Cria um objeto URL para o blob recebido
                        const fileURL = URL.createObjectURL(response);

                        // Exibe o PDF na mesma página
                        pdfContainer.style.display = 'block';
                        iframe.src = fileURL;

                        // Aguarda o PDF carregar e chama a função de impressão
                        iframe.onload = function () {
                            iframe.contentWindow.print(); // Imprime diretamente o conteúdo do iframe
                            //sleep(3000);
                            spinner.style.display = 'none'; // Oculta o spinner


                        };
                        pdfContainer.style.display = 'none'; // Oculta o container após a impressão
                        button.disabled = false; // Reabilita o botão
                    },
                    error: function (xhr, status, error) {
                        spinner.style.display = 'none'; // Oculta o spinner
                        alert("Erro ao tentar abrir o PDF: " + error);
                        button.disabled = false; // Reabilita o botão
                    }
                });
            }

            $(".btn-primary").click(function () {
                var servico = $(this).val(); // Obtém o valor do botão clicado
                $("#senhas").hide(); // Esconde a div atual
                $("#senhas_imprimir").show(); // Mostra a div senhas_imprimir
                $("#Normal").val(servico); // Passa o valor do botão para o botão Normal
                $("#Prioritaria").val(servico); // Passa o valor do botão para o botão Prioritaria
            });

           

            // Clique no botão "Normal"
            $("#Normal").click(function (event) {
                var servico = $("#Normal").val();
                console.log($("#Normal").val());
                gerarSenha("/senha.emitir/" + servico + "/0");
                resetDivs();
            });

           // Clique no botão "Prioritária"
           $("#Prioritaria").click(function (event) {
                var servico = $("#Prioritaria").val();
                console.log($("#Prioritaria").val());
                gerarSenha("/senha.emitir/" + servico + "/1");
                resetDivs();
            });
             // Função para resetar as divs à configuração inicial
             function resetDivs() {
                
                $("#senhas_imprimir").hide(); // Esconde a div senhas_imprimir
                $("#senhas").show(); // Mostra a div senhas
               
               // Mostra o spinner de carregamento
               $("#loading-spinner").show();
               
                // Desabilita os botões por 5 segundos
                $(".btn-primary, #Normal, #Prioritaria").prop('disabled', true);
                setTimeout(function() {
                    $(".btn-primary, #Normal, #Prioritaria").prop('disabled', false);
                     // Oculta o spinner de carregamento após 5 segundos
                     $("#loading-spinner").hide();
                }, 5000);
            
            }
        });
    </script>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
