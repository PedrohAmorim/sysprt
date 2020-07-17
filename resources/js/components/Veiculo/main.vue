
<template>
  <div class="container p-2">
    <select v-model="select" class="form-control">
      <option v-for="(veiculo,key) in veiculos" :value="key">{{veiculo.descricao}}</option>
    </select>
    <section id="replay-map"  class="fixed-bottom " style="z-index: 3;">
          <button v-if="!navegador_app()" class="bg-light col rounded text-primary h2 border-light " @click="telacheia()">
             <i class="fas fa-expand"></i>
            </button>
    </section>
    <div class="container">
      <br />
      <form action="/veiculo/salvar" method="post" v-if="selectVeiculo.id != null">
        <div class="form-row">
          <div class="form-group col-sm-6 col-lg-6">
            <label for="inputEmail4">Numero</label>
            <input
              type="number"
              class="form-control"
              v-model="selectVeiculo.data.numero"
              placeholder="1234"
            />
          </div>
          <div class="form-group col-sm-6 col-lg-6">
            <label for="inputPassword4">Descrição</label>
            <input
              type="text"
              class="form-control"
              v-model="selectVeiculo.data.descricao"
              placeholder="Descrição"
            />
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Tipo</label>
          <select class="form-control" v-model="selectVeiculo.data.tipo">
            <option value="carro">carro</option>
            <option value="moto">moto</option>
          </select>
        </div>
        <div class="form-group">
          <label for="inputAddress2">Placa</label>
          <input
            type="text"
            class="form-control"
            v-model="selectVeiculo.data.placa"
            placeholder="XXX-0000"
          />
        </div>
        <button type="submit" class="btn btn-outline-primary btn-block" @click.prevent="salvar()">Salvar</button>
         <button type="submit" class="btn btn-outline-danger btn-block" @click.prevent="bloquear()">Bloqueio</button>
          <button type="submit" class="btn btn-outline-success btn-block" @click.prevent="desbloquear()">Desbloqueio</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      veiculos: [],
      select: null,
      selectVeiculo: {
        id: null,
        data: {
          numero: null,
          descricao: null,
          tipo: null,
          placa: null
        }
      }
    };
  },
  mounted() {
    this.pegarVeiculos();
  },
  watch: {
      select(){
          this.veicSelect(this.select)
      }
  },
  methods: {
    bloquear(){
    axios.get('/veiculo/bloqueio/' + this.selectVeiculo.data.idModulo)
    .then(retorno =>{
    })
    }, desbloquear(){
    axios.get('/veiculo/desbloqueio/' + this.selectVeiculo.data.idModulo)
    .then(retorno =>{
    // window.location.href = '/home?bloqueio=false'
    })
    },
    pegarVeiculos() {
      axios
        .get("/pegarveiculos")
        .then(resultado => {
          this.veiculos = resultado.data;
        })
        .catch(error => {});
    },
    veicSelect(id) {
      setTimeout(() => {

         this.selectVeiculo.data = this.veiculos[id]
         this.selectVeiculo.id = id
      }, 200);
    },
     salvar(){

     if(this.select != null){
         axios.post('/veiculo/salvar',this.selectVeiculo.data)
         .then(resultado => {

             alert('Alterações salvas!')
            window.location.href = '/home'
         }).catch(error => {
             alert('Houve um erro ao tentar modificar o veículo' + error)
         })
     }

    },
    navegador_app(){
        return window.navegador_app()
    }, telacheia (){
        window.requestFullScreen()
    }
  }
};
</script>
