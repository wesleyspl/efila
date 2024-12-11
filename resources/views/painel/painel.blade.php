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
        E-fila
    </div>

    <div class="container">
        <!-- Área central (senha atual) -->
        <div class="center">
            <div id="senha-atual">

                 {{$senha->sigla.$senha->numero}}
                           <br>

                 {{$senha->nome_local}}:{{$senha->numero_local}}

            </div>
        </div>

        <!-- Área lateral (últimas senhas chamadas) -->
        <div class="side">
            <h3>Últimas Senhas</h3>
            <ul id="ultimas-senhas">
                @if ($ultimas_senhas)
                   @foreach ($ultimas_senhas as $senhas)

                      <li>  {{$senhas->id_atendimento}}
                        <br>
                        {{$senhas->sigla.$senhas->numero}} <br> {{$senhas->nome_local}}:{{$senhas->numero_local}} </li>
                   @endforeach

                @else
                <li>Nenhuma senha foi chamada</li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Faixa inferior com informações adicionais -->
    <div class="footer">
        <marquee>e-fila</marquee>
    </div>

</body>
</html>
