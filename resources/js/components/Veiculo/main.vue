
<template>
  <div class="container p-2">
    <select v-model="selectVeiculo.id" @changed="veicSelect()" class="form-control">
      <option v-for="veiculo in veiculos" :value="veiculo.id">{{veiculo.descricao}}</option>
    </select>

    <div class="row"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      veiculos: [],
      selectVeiculo: {
        id: null,
        data: null,
      }
    };
  },
  mounted() {
    this.pegarVeiculos();
  },
  watch: {},
  methods: {
    pegarVeiculos() {
      axios
        .get("/pegarveiculos")
        .then(resultado => {
          this.veiculos = resultado.data;
        })
        .catch(error => {});
    },
    veicSelect() {
    setTimeout(() => {
      this.veiculos.map(veic => {
        if (veic.id == this.selectVeiculo.id) {
            this.selectVeiculo.data = veic
        }
      })
    },200)
    }
  }
};
</script>
