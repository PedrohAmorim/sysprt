
<template>
  <nav
    class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark"
    id="menuPrincipal"
  >
    <a class="navbar-brand" href="/home">
      <img class="navbar-brand bg-light" src="img/logo.png" style="max-width: 60px;" />
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#conteudoNavbarSuportado"
      aria-controls="conteudoNavbarSuportado"
      aria-expanded="false"
      aria-label="Alterna navegação"
      id="btnMenu"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav">
        <li class="nav-item dropdown" style="width: 50vw !important; margin: 0 auto;">
          <a
            class="nav-link dropdown-toggle btn btn-light text-dark"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            v-if="opcao != 'replay'"
          >
            <i class="fas fa-eye"></i>
            <span class="rotulo">Ao Vivo</span>
          </a>
          <a
            class="nav-link dropdown-toggle btn btn-light text-dark"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            v-if="opcao == 'replay'"
          >
            <i class="fas fa-clipboard-list"></i>
            <span>Replay</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="row">
              <div class="container">
                <a class="dropdown-item btn btn-light" href="/home">
                  <i class="fas fa-eye"></i>
                  <span>Ao Vivo</span>
                </a>
                <a class="dropdown-item btn btn-light" href="#" @click.prevent="replay()">
                  <i class="fas fa-clipboard-list"></i>
                  <span>Replay</span>
                </a>
                <a class="dropdown-item btn btn-light" href="/Motoristas">
                  <i class="fas fa-location-arrow"></i>
                  <span>Motoristas</span>
                </a>
                <a class="dropdown-item btn btn-light" href="#">
                  <i class="fas fa-sign-out-alt"></i>
                  <span>Sair</span>
                </a>
              </div>
            </div>
          </div>
        </li>
        <li v-if="opcao == 'replay'" class="nav-item m-1">
          <div class="form-group">
            <select
              placeholder="Veículo"
              class="form-control"
              id="exampleFormControlSelect1"
              v-model="dados.veiculo"
            >
              <option value="0">Veículo</option>
              <option v-for="item in veiculos" :value="item.id">{{item.descricao}}</option>
            </select>
          </div>
        </li>
        <li v-if="opcao == 'replay'" class="nav-item m-1" >
          <input
            class="form-control text-center"
            type="date"
            placeholder="insira a data!!!"
            v-model="dados.data"
          />
        </li>
        <li v-if="opcao == 'replay'" class="nav-item m-1">
          <input
            class="form-control text-center"
            type="time"
            placeholder="Hora Inicio"
            v-model="dados.horainicio"
          />
        </li>
        <li v-if="opcao == 'replay'" class="nav-item m-1">
          <input
            class="form-control text-center"
            type="time"
            placeholder="Hora final"
            v-model="dados.horafim"
          />
        </li>
        <li v-if="opcao == 'replay'" class="nav-item text-center m-1">
          <button
            class="btn btn-light text-dark text-center"
            @click.prevent="enviardados()"
            type="submit"
          >
            <i class="fas fa-search"></i> Pesquisar
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export const eventBus = new Vue();

export default {
  data() {
    return {
      opcao: null,
      veiculos: [],
      dados: {
        data: null,
        veiculo: "null",
        horainicio: null,
        horafim: null
      }
    };
  },
  mounted() {
    this.carregarVeiculos();
  },
  methods: {
    carregarVeiculos() {
      axios
        .get("/pegarveiculos")
        .then(response => {
          this.veiculos = response.data;
        })
        .catch(error => {
          console.error("error: ", error);
        });
    },
    enviardados() {
      if (
        this.dados.data != null &&
        this.dados.horainicio != null &&
        this.dados.horafim != null &&
        this.dados.veiculo > 0
      ) {
        this.$eventBus.$emit("replay", this.dados);
         $("#btnMenu").trigger('click')
      } else {
        alert("Preencha todos os dados!!!");
      }
    },
    replay() {
      this.opcao = "replay";
      window.requestFullScreen();
    }
  }
};
</script>
