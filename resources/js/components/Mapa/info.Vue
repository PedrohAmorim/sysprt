<template>
  <div style="font-size: 15px;">
    <label class="container border-bottom border-primary p-1">

      <i v-if="data.tipo == 'onibus'" class="fas fa-bus"></i>
      <i v-if="data.tipo == 'carro'" class="fas fa-car-side"></i>
      <i v-if="data.tipo == 'moto'" class="fas fa-motorcycle"></i>
    <i class="fas fa-key" :style="{ color: data.ignicao == '1' ? 'green' : 'red' }"></i>
      <span class="font-weight-light">{{data.nome}}   </span>
    </label>
    <br />
     <label class="py-1">
      <p class="font-weight-light">
        <span class="text-primary font-weight-bold">
          <i class="far fa-clock"></i>
          <span>Velocidade:</span>
        </span>
        <br />
        {{data.velocidade}}Km/H
      </p>
    </label>
    <br />
    <label class="py-1">
      <p class="font-weight-light">
        <span class="text-primary font-weight-bold">
          <i class="far fa-clock"></i>
          <span>Hora:</span>
        </span>
        <br />
        {{data.dataehora}}
      </p>
    </label>
    <br />
    <label class="py-1">
      <i class="fas fa-search-location text-primary font-weight-bold" style="text-size: 15px;"></i>
      <span class="text-primary font-weight-bold">Posicao:</span>
      <br />
      <p class="font-weight-light">
        <span class="text-secondary">Latitude:</span>
        {{data.position.lat}}
        <br />
        <span class="text-secondary">Longitude:</span>
        {{data.position.lng}}
      </p>
    </label>
    <br />
    <label class="py-1">
      <p class="font-weight-light">
        <span class="text-primary font-weight-bold">
          <i class="fas fa-search-location text-primary"></i>
          <span>Endereço:</span>
          <br />
        </span>

      </p>
    </label>
  </div>
</template>

<script>
export default {
  props: ["data"],

  data() {
    return {};
  }
};
</script>
