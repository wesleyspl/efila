<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Efila-Senhas</title>
   <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">

  <!-- CDN do Vue.js -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <!-- CDN do Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script type="text/javascript" src="{{ asset('assets/java/FWDUVPlayer.js')}}"></script>
  <link rel="stylesheet" type="text/css"  href="{{ asset('assets/content/global.css')}}"/>
 

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      width: 100%;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f4f4f4; /* Cor de fundo mais clara */
      overflow: hidden;
    }

    .container {
      display: flex;
      height: 100%;
      width: 100%;
    }

    .content {
      flex: 1; /* O conteúdo do painel vai ocupar o restante da tela */
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      flex-direction: column; /* Alinhamento em coluna para garantir que a senha e o guichê fiquem embaixo */
    }

    .sidebar {
      width: 380px;
      background-color: #4a4a4a; /* Fundo cinza escuro */
      color: white;
      padding: 20px;
      box-sizing: border-box;
      height: 100%;
      overflow-y: auto;
      border-left: 3px solid #6c6c6c; /* Bordas mais visíveis */
    }

    .sidebar h2 {
      text-align: center;
      font-size: 2.5rem;
      margin-bottom: 30px;
      color: #ffcc00; /* Cor amarela para destaque */
    }

    .password-display {
      font-size: 8rem; /* Aumento do tamanho da senha */
      font-weight: bold;
      color: #ff0000; /* Cor de destaque para a senha */
      z-index: 3;
      display: block;
      text-align: center;
    }

    .sigla {
      font-size: 4rem; /* Aumento da sigla */
      color: #ffcc00; /* Cor da sigla */
      text-align: center;
      margin-top: 20px;
    }

    .local-info {
      font-size: 2.5rem; /* Aumento do texto de informações do local */
      color: #333; /* Cor escura para contraste */
      text-align: center;
      margin-top: 10px;
    }

    table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
    }

    th, td {
      padding: 15px;
      text-align: center;
      font-size: 1.8rem;
      border: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: #fff;
    }

    td {
      background-color: #f4f4f4;
      color: #333;
    }

    .video-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #1a1a1a; /* Fundo escuro para o vídeo */
      z-index: 1;
      transition: all 1s ease;
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .video-minimized {
      position: absolute;
      top: 10px;
      left: 10px;
      width: 35%;
      height: 35%;
      z-index: 1;
    }

    .local-info {
      font-size: 2.5rem;
      color: #333;
      text-align: center;
      margin-top: 10px;
    }

    /* Animação de piscada */
    @keyframes blink {
      0% { opacity: 1; }
      50% { opacity: 0; }
      100% { opacity: 1; }
    }
  </style>
</head>
<body>
  <div id="app" class="container">
    <div class="content">
      <div v-if="showVideo" class="video-container" :class="{ 'video-minimized': isMinimized }">
       <!-- <iframe :src="videoUrl" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>-->
       <x-video-playlist 
       type="youtube" 
       videoId="{{$painel->url_midia }}"
      
   />
      </div>

      <div v-if="isPasswordVisible" class="content">
        <div class="password-display">
            @{{ sigla }} @{{ currentPassword }}
        </div>
        <br>
        <div class="local-info">
         @{{ nomeLocal }} - @{{ numeroLocal }}
        </div>
      </div>
    </div>

    <div class="sidebar">
      <h2>Últimas Senhas</h2>

      <!-- Tabela com Senha, Sigla e Local -->
      <table>
        <thead>
          <tr>
            <th>Senha</th>
            <th>Local</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(password, index) in lastPasswords" :key="index">
            <td>@{{ password.sigla }} @{{ password.numero }}</td> <!-- Adiciona a sigla antes da senha -->
            <td>@{{ password.nome_local }}:@{{ password.numero_local }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Som de Alerta -->
  <audio id="alert-sound" src="https://www.soundjay.com/button/beep-07.wav" preload="auto"></audio>

  <script>
    let player; // Variável para armazenar o player do YouTube

    new Vue({
        el: '#app',
        data: {
            currentPassword: '',
            sigla: '',
            nomeLocal: '',
            numeroLocal: '',
            lastPasswords: [],
            lastDisplayedPassword: '', // Armazenar a última senha exibida
            videoUrl: '{{$painel->url_midia }}', // Link do vídeo do YouTube
            showVideo: true, // Variável para controlar a exibição do vídeo ou senha
            isMinimized: false, // Controla o estado de minimização do vídeo
            isPasswordVisible: false, // Controla a exibição da senha na tela
            isPlayerReady: false, // Indica se o player está pronto
        },
        created() {
            this.fetchPasswordData();
            this.updateInterval = setInterval(this.fetchPasswordData, 3000); // Atualiza a cada 3 segundos

            // Inicializa o YouTube Player API
            this.loadYouTubeAPI();
        },
        destroyed() {
            clearInterval(this.updateInterval); // Limpa o intervalo
        },
        methods: {
            fetchPasswordData() {
                axios.get('/painel.painelAtualiza/{{ $id_painel }}')
                    .then(response => {
                        // Atualizar a senha atual
                        const senhaAtual = response.data.senha;
                        this.currentPassword = senhaAtual.numero;
                        this.sigla = senhaAtual.sigla;
                        this.nomeLocal = senhaAtual.nome_local;
                        this.numeroLocal = senhaAtual.numero_local;

                        // Atualizar as últimas 5 senhas
                        this.lastPasswords = response.data.historico[0].slice(0, 5).map(item => ({
                            sigla: item.sigla, // Adicionando sigla para cada senha
                            numero: item.numero,
                            nome_local: item.nome_local,
                            numero_local: item.numero_local,
                        }));

                        // Verificar se a senha atual é igual à última senha exibida
                        if (this.currentPassword !== this.lastDisplayedPassword) {
                            this.showPassword();
                        } else {
                            this.showVideo = true; // Exibe o vídeo se a senha for igual à última exibida
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar dados da senha:', error);
                    });
            },

            showPassword() {
                // Minimiza o vídeo e muto
                this.isMinimized = true; // Minimiza o vídeo
                this.muteVideo(); // Muta o vídeo

                // Exibe a senha
                this.isPasswordVisible = true; // Exibe a senha
                this.playAlertSound(); // Toca o som de alerta
                this.speakPassword(); // Vocaliza a senha com os dados

                this.lastDisplayedPassword = this.currentPassword; // Armazenar a senha atual como a última exibida

                setTimeout(() => {
                    this.isPasswordVisible = false; // Esconde a senha
                    this.isMinimized = false; // Restaura o vídeo ao tamanho original
                    this.unmuteVideo(); // Desmuta o vídeo
                }, 10000); // 10 segundos
            },

            playAlertSound() {
                const alertSound = document.getElementById('alert-sound');
                alertSound.play();
            },

            speakPassword() {
                // Usando a API nativa speechSynthesis para vocalizar a senha + sigla + número + nome_local + número_local
                const utterance = new SpeechSynthesisUtterance(
                    `Senha número ${this.currentPassword}, sigla ${this.sigla},${this.nomeLocal},${this.numeroLocal}`
                );
                utterance.lang = 'pt-BR'; // Define a linguagem para português
                window.speechSynthesis.speak(utterance); // Vocaliza
            },

            loadYouTubeAPI() {
                // Carrega a API do YouTube IFrame Player
                const tag = document.createElement('script');
                tag.src = "https://www.youtube.com/iframe_api";
                const firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                // Define a função global para inicializar o player
                window.onYouTubeIframeAPIReady = () => {
                    player = new YT.Player('youtube-player', {
                        events: {
                            'onReady': this.onPlayerReady
                        }
                    });
                };
            },

            onPlayerReady(event) {
                console.log('YouTube Player is ready');
                this.isPlayerReady = true; // Marca o player como pronto
            },

            muteVideo() {
                if (this.isPlayerReady && player) {
                    player.mute(); // Muta o vídeo
                } else {
                    console.warn('Player ainda não está pronto para mutar o vídeo.');
                }
            },

            unmuteVideo() {
                if (this.isPlayerReady && player) {
                    player.unMute(); // Desmuta o vídeo
                } else {
                    console.warn('Player ainda não está pronto para desmutar o vídeo.');
                }
            }
        }
    });
</script>
</body>
</html>
