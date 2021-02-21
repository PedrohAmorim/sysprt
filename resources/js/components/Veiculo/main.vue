
<template>
  <div class="container p-2">
    <select v-model="selectVeiculo.id" @change="veicSelect()" class="form-control">
      <option selected value="null">Selecione o veículo </option>
      <option v-for="(veiculo,key) in veiculos" :value="key">{{veiculo.descricao}}</option>
    </select>

    <div class="container">
      <br />
      <form action="/veiculo/salvar" method="post" v-if="selectVeiculo.id != 'null'">
        <div class="form-row">
          <div class="form-group col-sm-6 col-lg-6">
            <label >Numero</label>
            <input
              type="number"
              class="form-control"
              v-model="selectVeiculo.data.numero"
              placeholder="1234"
            />
          </div>
          <div class="form-group col-sm-6 col-lg-6">
            <label >Descrição</label>
            <input
              type="text"
              class="form-control"
              v-model="selectVeiculo.data.descricao"
              placeholder="Descrição"
            />
          </div>
        </div>
        <div class="form-group">
          <label >Tipo</label>
          <select class="form-control" v-model="selectVeiculo.data.tipo">
            <option value="carro">carro</option>
            <option value="moto">moto</option>
          </select>
        </div>
        <div class="form-group">
          <label >Placa</label>
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
      selectVeiculo: {
        id: 'null',
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
            if(resultado.data.length == 1) {
                this.selectVeiculo.id =
                    {
                        id: resultado.data[0].id,
                        data: resultado.data[0]
                    }
            }
        })
        .catch(error => {});
    },
    veicSelect() {
         this.selectVeiculo.data = this.veiculos[this.selectVeiculo.id]
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
