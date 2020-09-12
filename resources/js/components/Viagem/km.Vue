<template>
    <div class="container">
      <div class="row rounded border" v-for="dia in dias">
          <div class="col col-sm-4 col-md-4 btn btn-light">
              {{dia.Dia}}
          </div>
          <div class="col col-sm-4 col-md-4 btn btn-light">
             {{ dia.descricao}}
          </div>
          <div class="col col-sm-4 col-md-4 btn btn-light">
             {{ parseFloat(dia.Km).toFixed(2)}}
          </div>
      </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            dias: []
        }
}, mounted()
    {
    this.carregarQuilometros()
    },methods: {
        carregarQuilometros(){
            axios.get('/kmDiario').then(response =>{
                this.dias = response.data
            })
        }

    }

}
</script>
