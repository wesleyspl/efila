<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Efila-Senhas</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">

  <script src="https://www.youtube.com/iframe_api"></script>

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
      background-color: #4a4a4a;
      overflow: hidden;
    }

    .container {
      display: flex;
      height: 100%;
      width: 100%;
    }

    .content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      flex-direction: column;
    }

    .sidebar {
      width: 380px;
      background-color: #4a4a4a;
      color: white;
      padding: 20px;
      box-sizing: border-box;
      height: 100%;
      overflow-y: auto;
      border-left: 3px solid #6c6c6c;
    }

    .sidebar h2 {
      text-align: center;
      font-size: 2.5rem;
      margin-bottom: 30px;
      color: #ffcc00;
    }

    .password-display {
      font-size: 8rem;
      font-weight: bold;
      background-color: #4a4a4a;
      color: #ffcc00;
      z-index: 3;
      display: block;
      text-align: center;
    }

    .local-info {
      font-size: 2.5rem;
      color: #ffcc00;
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
      background-color: #1a1a1a;
      z-index: 1;
      transition: all 1s ease;
    }

    .video-minimized {
      width: 25%; /* Reduz o tamanho para 25% */
      height: 25%;
      top: 10px;
      left: 10px;
      position: fixed; /* Fixa no canto superior esquerdo */
      z-index: 2;
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
  </style>
</head>
<body>
  <div id="app" class="container">
    <div class="content">
      <!-- Verifica se há URL de mídia -->
      @if($painel->url_midia)
      <div id="video-container" class="video-container">
        <iframe 
          id="youtube-player"
          src="https://www.youtube.com/embed/{{ $painel->url_midia }}?enablejsapi=1&autoplay=1&loop=1&playlist={{ $painel->url_midia }}" 
          frameborder="0" 
          allow="autoplay; encrypted-media" 
          allowfullscreen>
        </iframe>
      </div>
      @endif

      <div id="password-display">
        <div class="password-display" id="password-text"></div>
        <div class="local-info" id="local-info"></div>
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
        <tbody id="last-passwords">
          <!-- As senhas serão preenchidas dinamicamente -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Som de Alerta -->
  <audio id="alert-sound" src="{{ asset('assets/content/audio/senha.wav') }}" preload="auto"></audio>

  <script>
    // Variáveis de configuração editáveis
    const UPDATE_INTERVAL = 3000; // Intervalo de atualização em milissegundos
    const PASSWORD_DISPLAY_TIME = 10000; // Tempo de exibição da senha em milissegundos
    const MAX_LAST_PASSWORDS = 5; // Número máximo de senhas na lista de últimas senhas

    const hasMedia = "{{ $painel->url_midia }}" !== ""; // Verifica se há URL de mídia

    let player; // Variável para armazenar o player do YouTube
    let isPlayerReady = false; // Indica se o player está pronto
    let lastDisplayedPassword = ''; // Armazena a última senha exibida
    let lastPasswords = []; // Array para armazenar as últimas senhas exibidas

    // Inicializa a API do YouTube
    function onYouTubeIframeAPIReady() {
      if (hasMedia) {
        player = new YT.Player('youtube-player', {
          events: {
            'onReady': onPlayerReady
          }
        });
      }
    }

    function onPlayerReady(event) {
      console.log('YouTube Player is ready');
      isPlayerReady = true;
    }

    // Função para exibir a senha
    function showPassword(password, sigla, nomeLocal, numeroLocal) {
      console.log('Exibindo senha:', { password, sigla, nomeLocal, numeroLocal });

      if (hasMedia) {
        // Minimiza o vídeo se houver mídia
        const videoContainer = document.getElementById('video-container');
        videoContainer.classList.add('video-minimized');
      }

      // Adiciona a senha ao histórico
      lastPasswords.unshift({ sigla, numero: password, nome_local: nomeLocal, numero_local: numeroLocal });

      // Limita o número de senhas no histórico
      if (lastPasswords.length > MAX_LAST_PASSWORDS) {
        lastPasswords.pop();
      }

      // Atualiza a lista de últimas senhas na interface
      updateLastPasswords(lastPasswords);

      // Atualiza a senha exibida
      const passwordText = document.getElementById('password-text');
      const localInfo = document.getElementById('local-info');

      passwordText.textContent = `${sigla}${password}`;
      localInfo.textContent = `${nomeLocal} : ${numeroLocal}`;

      // Toca o som de alerta
      const alertSound = document.getElementById('alert-sound');
      alertSound.play();

      // Vocaliza a senha
      const utterance = new SpeechSynthesisUtterance(
        `Senha ${sigla}${password}, ${nomeLocal}:${numeroLocal}`
      );
      utterance.lang = 'pt-BR';
      window.speechSynthesis.speak(utterance);

      // Restaura o vídeo após o tempo configurado
      setTimeout(() => {
        if (hasMedia) {
          const videoContainer = document.getElementById('video-container');
          videoContainer.classList.remove('video-minimized'); // Restaura o vídeo
        }
      }, PASSWORD_DISPLAY_TIME);
    }function showPassword(password, sigla, nomeLocal, numeroLocal) {
  console.log('Exibindo senha:', { password, sigla, nomeLocal, numeroLocal });

  if (hasMedia) {
    // Pausa o vídeo se houver mídia
    if (isPlayerReady && player) {
      player.pauseVideo();
    }

    // Minimiza o vídeo
    const videoContainer = document.getElementById('video-container');
    videoContainer.classList.add('video-minimized');
  }

  // Adiciona a senha ao histórico
  lastPasswords.unshift({ sigla, numero: password, nome_local: nomeLocal, numero_local: numeroLocal });

  // Limita o número de senhas no histórico
  if (lastPasswords.length > MAX_LAST_PASSWORDS) {
    lastPasswords.pop();
  }

  // Atualiza a lista de últimas senhas na interface
  updateLastPasswords(lastPasswords);

  // Atualiza a senha exibida
  const passwordText = document.getElementById('password-text');
  const localInfo = document.getElementById('local-info');

  passwordText.textContent = `${sigla}${password}`;
  localInfo.textContent = `${nomeLocal} : ${numeroLocal}`;

  // Toca o som de alerta
  const alertSound = document.getElementById('alert-sound');
  alertSound.play();

  // Vocaliza a senha
  const utterance = new SpeechSynthesisUtterance(
    `Senha ${sigla}${password}, ${nomeLocal}:${numeroLocal}`
  );
  utterance.lang = 'pt-BR';
  window.speechSynthesis.speak(utterance);

  // Restaura o vídeo após o tempo configurado
  setTimeout(() => {
    if (hasMedia) {
      const videoContainer = document.getElementById('video-container');
      videoContainer.classList.remove('video-minimized'); // Restaura o vídeo

      // Retoma o vídeo
      if (isPlayerReady && player) {
        player.playVideo();
      }
    }
  }, PASSWORD_DISPLAY_TIME);
}

    // Função para buscar os dados da senha
    function fetchPasswordData() {
      fetch('/painel.painelAtualiza/{{ $id_painel }}')
        .then(response => response.json())
        .then(data => {
          console.log('Dados recebidos da API:', data);

          const senhaAtual = data.senha;

          // Verifica se a senha atual já foi exibida
          if (`${senhaAtual.sigla} ${senhaAtual.numero}` !== lastDisplayedPassword) {
            lastDisplayedPassword = `${senhaAtual.sigla} ${senhaAtual.numero}`;
            showPassword(
              senhaAtual.numero,
              senhaAtual.sigla,
              senhaAtual.nome_local,
              senhaAtual.numero_local
            );
          }
        })
        .catch(error => {
          console.error('Erro ao buscar dados da senha:', error);
        });
    }

    // Função para atualizar a lista de últimas senhas
    function updateLastPasswords(passwords) {
      const lastPasswordsContainer = document.getElementById('last-passwords');
      lastPasswordsContainer.innerHTML = ''; // Limpa a tabela

      passwords.forEach(password => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${password.sigla} ${password.numero}</td>
          <td>${password.nome_local}:${password.numero_local}</td>
        `;
        lastPasswordsContainer.appendChild(row);
      });
    }

    // Atualiza os dados da senha no intervalo configurado
    setInterval(fetchPasswordData, UPDATE_INTERVAL);
  </script>
</body>
</html>