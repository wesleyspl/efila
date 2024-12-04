<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minha Fila</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div id="app">
    <div class="widget">
      <div class="widget-header transparent">
        <h2><strong>Minha Fila</strong></h2>
      </div>
      <div class="widget-content padding">
        <p>
          <!-- Verifica se há itens na fila -->

          <!-- Mensagem caso a fila esteja vazia -->
          <template v-else>
            <span>NENHUMA SENHA NA FILA (**)</span>
          </template>
        </p>
      </div>
    </div>
  </div>

  <script>
    const app = Vue.createApp({
      data() {
        return {
          fila: [], // Inicializa o array vazio
        };
      },
      methods: {
        // Método para buscar os dados do endpoint
        fetchFila() {
          axios
            .get("http://efila.test/atendente.atualizaFila")
            .then((response) => {
              if (response.data && response.data.fila) {
                this.fila = response.data.fila; // Atualiza o estado com os dados da fila
               console.log($this.fila);

            }
            })
            .catch((error) => {
              console.error("Erro ao buscar a fila:", error);
              this.fila = []; // Zera a fila em caso de erro
            });
        },
      },
      mounted() {
        // Busca os dados ao montar o componente
        this.fetchFila();
        // Atualiza os dados a cada 5 segundos
        setInterval(this.fetchFila, 5000);
      },
    });

    app.mount("#app");
  </script>
</body>
</html>
