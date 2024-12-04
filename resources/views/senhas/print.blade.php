<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Senha</title>
    <style>
       #senha {
           width: 300px;
           min-height: 150px;
           margin: auto;

       }

       #senha * {
           font-family: monospace;
           font-size: 12pt;
           text-align: center;
           line-height: 1;
       }

       #senha header {
           font-size: 10pt;
           padding: 10px 0;
       }

       #senha header p {
           margin: 0;
       }

       #senha header .unidade {
           font-size: 14pt;
           font-weight: bold;
           text-align: center;
       }

       #senha section {
           font-size: 10pt;
           padding: 10px 0;
       }

       #senha section p {
           margin: 5px 0;

       }


       #pri{
        font-weight: bold;
           font-size: 12pt;
           text-align: center;
       }

       #senha section .senha {
           font-size: 20pt;
           line-height: 50pt;
           font-weight: bold;
           background-color: white;
           color: black;
           text-align: center;
           border-top-left-radius: 15px;
           border-bottom-right-radius: 15px;

       }

       #senha section .data-hora {
           padding: 10pt 0;
           text-align: center;
       }

       #senha footer {
           font-size: 9pt;
           padding: 10px 0;
           text-align: center;
           font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
       }
       #servico{
         font-weight: bold;
           font-size: 12pt;
        text-align: center;
       }

       #senha footer p {
           margin: 0;

       }
    </style>
    <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
    <center>
    <div id="senha">
        <header>

                <p class="unidade" id="teste">
                  cerradoclound.com.br
                </p>


        </header>
        <section>

                <p  id="pri">

                </p>

            <p class="senha">
               {{$sigla.'-'.$numero}}
            </p>


                <p id="servico">
                    Farmácia
                </p>





                <div class="data-hora">
                    <p class="data">
                       Data e hora da chegada: <?= date('H:i:s d/m/Y');?>
                    </p>

                </div>

        </section>

    </div>
    </center>
</body>
</html>
