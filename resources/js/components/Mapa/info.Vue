<template>

  <div class="info" style="font-size: 15px; max-width: 200px !important;">
    <label class="container border-bottom border-primary p-1">

      <i v-if="data.tipo == 'onibus'" class="fas fa-bus"></i>
      <i v-if="data.tipo == 'carro'" class="fas fa-car-side"></i>
      <i v-if="data.tipo == 'moto'" class="fas fa-motorcycle"></i>
    <i class="fas fa-key" :style="{ color: data.ignicao == '1' ? 'green' : 'red' }"></i>
      <span class="font-weight-light">{{data.nome}}   </span>
    </label>
    <br />
     <label >
      <p class="font-weight-light">
        <span class="text-primary font-weight-bold">
       <i class="fas fa-tachometer-alt"></i>
          <span>Velocidade:</span>
        </span>
        <br />
        {{data.velocidade }}km/h
      </p>
    </label>
    <br />
    <label >
      <p class="font-weight-light">
        <span class="text-primary font-weight-bold">
          <i class="far fa-clock"></i>
          <span>Data e Hora:</span>
        </span>
        <br />
        {{data.dataehora}}
      </p>
    </label>
    <br />
    <label >
     <i class="fas fa-search-location text-primary"></i>
     <span class="text-primary font-weight-bold">Endereço:</span>
       <br />
      <p class="font-weight-light">
        {{endereco}}
      </p>
    </label>
  </div>
</template>

<script>
export default {
  props: ["data"],

  data() {
    return {
        endereco:null
    }
  },mounted(){
  this.carregarendereco()
  },
  methods:{
      carregarendereco(){
          $.ajax({
              type: 'GET',
              url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+this.data.position.lat+','+this.data.position.lng+'&key=AIzaSyBjRsY1NNPFms-CxPIyO6wZSrg-Hj_GpEw',
              success: resultado =>{
                  window.localStorage.removeItem('email')
                  window.localStorage.removeItem('senha')
                  window.localStorage.removeItem('login')
              }
          })
      }
  }
};
</script>
