<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chamada de Senhas</title>
  <!-- CDN do Vue.js -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <!-- CDN do Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script type="text/javascript" src="{{ asset('assets/java/FWDUVPlayer.js')}}"></script>
  <link rel="stylesheet" type="text/css"  href="{{ asset('assets/content/global.css')}}"/>
 

  <style>
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

  .video-minimized {
    width: 30%; /* Reduz o tamanho para 30% */
    height: 30%;
    top: auto;
    left: auto;
    bottom: 10px;
    right: 10px;
    position: fixed; /* Fixa o vídeo no canto inferior direito */
    opacity: 0; /* Esconde o vídeo */
    pointer-events: none; /* Impede interação com o vídeo */
  }
</style>

<div id="app" class="container">
  <div class="content">
    <div v-if="showVideo" class="video-container" :class="{ 'video-minimized': isMinimized }">
      <iframe 
        id="youtube-player"
        :src="videoUrl"
        frameborder="0"
        allow="autoplay; encrypted-media"
        allowfullscreen>
      </iframe>
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
    <table>
      <thead>
        <tr>
          <th>Senha</th>
          <th>Local</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(password, index) in lastPasswords" :key="index">
          <td>@{{ password.sigla }} @{{ password.numero }}</td>
          <td>@{{ password.nome_local }}:@{{ password.numero_local }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<audio id="alert-sound" src="https://www.soundjay.com/button/beep-07.wav" preload="auto"></audio>

<script>
  new Vue({
    el: '#app',
    data: {
      currentPassword: '',
      sigla: '',
      nomeLocal: '',
      numeroLocal: '',
      lastPasswords: [],
      lastDisplayedPassword: '', // Armazenar a última senha exibida
      videoUrl: 'https://www.youtube.com/embed/2v5_0E6hJFA?enablejsapi=1&autoplay=1', // Link do vídeo do YouTube
      showVideo: true, // Variável para controlar a exibição do vídeo ou senha
      isMinimized: false, // Controla o estado de minimização do vídeo
      isPasswordVisible: false, // Controla a exibição da senha na tela
    },
    created() {
      this.fetchPasswordData();
      this.updateInterval = setInterval(this.fetchPasswordData, 3000); // Atualiza a cada 3 segundos
    },
    destroyed() {
      clearInterval(this.updateInterval); // Limpa o intervalo
    },
    methods: {
      fetchPasswordData() {
        axios.get('/painel.painelAtualiza/{{ $id_painel }}')
          .then(response => {
            const senhaAtual = response.data.senha;
            this.currentPassword = senhaAtual.numero;
            this.sigla = senhaAtual.sigla;
            this.nomeLocal = senhaAtual.nome_local;
            this.numeroLocal = senhaAtual.numero_local;

            this.lastPasswords = response.data.historico[0].slice(0, 5).map(item => ({
              sigla: item.sigla,
              numero: item.numero,
              nome_local: item.nome_local,
              numero_local: item.numero_local,
            }));

            if (this.currentPassword !== this.lastDisplayedPassword) {
              this.showPassword();
            } else {
              this.showVideo = true;
            }
          })
          .catch(error => {
            console.error('Erro ao buscar dados da senha:', error);
          });
      },

      showPassword() {
        this.isMinimized = true; // Minimiza o vídeo
        this.showVideo = true; // Mantém o vídeo tocando
        this.isPasswordVisible = true; // Exibe a senha
        this.playAlertSound(); // Toca o som de alerta
        this.speakPassword(); // Vocaliza a senha com os dados

        this.lastDisplayedPassword = this.currentPassword;

        setTimeout(() => {
          this.isPasswordVisible = false; // Esconde a senha
          this.isMinimized = false; // Restaura o vídeo ao tamanho original
        }, 10000); // 10 segundos
      },

      playAlertSound() {
        const alertSound = document.getElementById('alert-sound');
        alertSound.play();
      },

      speakPassword() {
        const utterance = new SpeechSynthesisUtterance(
          `Senha número ${this.currentPassword}, sigla ${this.sigla},${this.nomeLocal},${this.numeroLocal}`
        );
        utterance.lang = 'pt-BR';
        window.speechSynthesis.speak(utterance);
      },
    }
  });
</script>
</body>
</html>
