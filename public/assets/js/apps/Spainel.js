
Vue.config.delimiters = ['[[', ']]'];
new Vue({
 el: '#app',
 data: {
   currentPassword: '',
   sigla: '',
   nomeLocal: '',
   numeroLocal: '',
   lastPasswords: [],
   lastDisplayedPassword: '', // Armazenar a última senha exibida
   videoUrl: '{{$titulo}}', // Link do vídeo do YouTube
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
     axios.get('/painel.painelAtualiza/3')
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
     // Começar a transição do vídeo
     this.isMinimized = true; // Minimiza o vídeo
     this.showVideo = true; // Esconde o vídeo
     this.isPasswordVisible = true; // Exibe a senha
     this.playAlertSound(); // Toca o som de alerta
     this.speakPassword(); // Vocaliza a senha com os dados

     this.lastDisplayedPassword = this.currentPassword; // Armazenar a senha atual como a última exibida

     setTimeout(() => {
       this.isPasswordVisible = false; // Esconde a senha
       this.showVideo = true; // Mostra o vídeo novamente
       this.isMinimized = false; // Restaura o vídeo ao tamanho original
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
 }
});
