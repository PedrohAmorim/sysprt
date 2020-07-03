
<template>
  <div class="container-fluid">
    <select class="form-control">
      <option v-for="item in veiculos">{{item.descricao}}</option>
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      veiculos: []
    };
  },
  mounted() {
    this.pegarVeiculos;
  },
  methods: {
    pegarVeiculos() {
      axios
        .get("/pegarveiculos")
        .then(resultado => {
          veiculos = resultado;
        })
        .catch(error => {});
    }
  }
};
</script>
