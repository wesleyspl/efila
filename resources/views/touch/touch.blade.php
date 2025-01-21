<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página com Cabeçalho, Rodapé Fixo e Botões Lado a Lado</title>
    @livewireStyles
    <!-- Link para o Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <header class="bg-primary text-white text-center py-4">
        <h1>Efila - RETIRE SUA SENHA</h1>
    </header>

    @livewireScripts
    <!-- Conteúdo Principal -->
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <!-- Botão 1 -->
                <button type="button" id="Normal" value="2" class="btn btn-block btn-primary btn-lg">
                    Normal
                </button>
            </div>
            <div class="col-md-6 mb-3">
                <!-- Botão 2 -->
                <button type="button" id="Prioritaria" value="3" class="btn btn-block btn-danger btn-lg">
                    Prioritária
                </button>
            </div>
        </div>

        <!-- Spinner de carregamento -->
        <div class="spinner" id="loading-spinner">
            Imprimindo senha ...
        </div>

        <!-- Container do PDF -->
        <div id="pdf-container">
            <iframe id="pdf-iframe" src="" type="application/pdf"></iframe>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Todos os direitos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
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

            // Clique no botão "Normal"
            $("#Normal").click(function (event) {
                var servico=$("#Normal").val();
                console.log( $("#Normal").val());
                gerarSenha("http://efila.test/senha.emitir/"+servico+"/0");
            });

            // Clique no botão "Prioritária"
            $("#Prioritaria").click(function (event) {
                var servico=$("#Prioritaria").val();
                console.log( $("#Prioritaria").val());
                gerarSenha("http://efila.test/senha.emitir/"+servico+"/1");
            });
        });
    </script>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
