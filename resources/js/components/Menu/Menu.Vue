
<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/home">
      <img class="navbar-brand bg-light" src="img/logo.png" style="max-width: 60px;" />
      <button class="btn btn-outline-dark">{{Km.toFixed(2)}}Km's </button>
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
      @click="replay('normal')"
      id='btnMenu'
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item" v-if="opcao != 'replay'">
          <a class="dropdown-item btn btn-light h4 text-center" href="/home">
            <i class="fas fa-eye"></i>
            <span>Ao vivo</span>
          </a>
        </li>
        <li class="nav-item" v-if="opcao != 'replay'">
          <a class="dropdown-item btn btn-light h4 text-center" href="#" @click.prevent="replay()">
            <i class="fas fa-clipboard-list"></i>
            <span>Replay</span>
          </a>
        </li>
        <li class="nav-item" v-if="opcao != 'replay'">
          <a class="dropdown-item btn btn-light h4 text-center" href="/veiculo">
            <i class="fas fa-car-side"></i>
            <span>Meus Veículos</span>
          </a>
        </li>
        <li class="nav-item" v-if="opcao != 'replay'">
          <a class="dropdown-item btn btn-light h4 text-center" href="/viagens">
            <i class="far fa-paper-plane"></i>
            <span>Viagens</span>
          </a>
        </li>
        <li class="nav-item" v-if="opcao != 'replay'">
         <button v-if="!navegador_app()" class="dropdown-item btn btn-light h4 text-center" @click="telacheia()">
            <i class="fas fa-expand-arrows-alt"></i><span> Tela Cheia</span>
            </button>
        </li>
        <li class="nav-item" v-if="opcao != 'replay'">
          <a class="dropdown-item btn btn-light h4 text-center" href="/" @click="apagarUser()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair</span>
          </a>
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
        <li v-if="opcao == 'replay'" class="nav-item m-1">
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
        <li v-if="opcao == 'replay'" class="nav-item text-center m-1">
          <button
            class="btn btn-light text-dark text-center"
            @click.prevent="replay('')"
            type="submit"
          >
            <i class="fas fa-arrow-left"></i> Voltar
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
      Km: 0,
      opcao: null,
      veiculos: [],
      dados: {
        data: null,
        veiculo: "null",
        horainicio: null,
        horafim: null,
      },
    };
  },
  mounted() {
    this.carregarVeiculos()
    this.pegarKm()
  },
  methods: {
    pegarKm(){
    axios.get('/km').then(response =>{
      this.Km = parseFloat(response.data[0].Km)
      }).catch(error =>{
        console.log(error)
      })
    },
    navegador_app(){
        return window.navegador_app()
    },
    telacheia (){       
       $("#btnMenu").trigger("click")
       setTimeout(() => {
        window.requestFullScreen()
        },100)         
    },
    carregarVeiculos() {
      axios
        .get("/pegarveiculos")
        .then((response) => {
          this.veiculos = response.data;
        })
        .catch((error) => {
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
        $("#btnMenu").trigger("click");
      } else {
        alert("Preencha todos os dados!!!");
      }
    },
    replay(modo) {
      if (modo == "normal") {
         setTimeout(() => {
          (this.opcao = "normal")
         },200)
      } else {
        this.opcao = this.opcao == "replay" ? "normal" : "replay";
      }
    },
    apagarUser(){
           window.localStorage.removeItem('email')
            window.localStorage.removeItem('senha')
            window.localStorage.removeItem('login')
         
    }
  },
};
</script>
