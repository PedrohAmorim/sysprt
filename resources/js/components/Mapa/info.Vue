<template>
  <div style="font-size: 15px;">
    <label class="container border-bottom border-primary p-1">
      <i class="fas fa-bus"></i>
      <span class="font-weight-light">{{ data.nome}}</span>
    </label>
    <br />
    <label class="py-1">
      <p class="font-weight-light">
        <span class="text-primary font-weight-bold">
            <i class="far fa-clock"></i> <span> Hora:</span>
            </span>
            <br />
        {{data.dataehora}}
      </p>
    </label>
    <br />
   <label class="py-1">
       <i class="fas fa-search-location text-primary font-weight-bold" style="text-size: 15px;"></i> <span class="text-primary font-weight-bold"> Posicao:</span>
 <br />
      <p class="font-weight-light">
        <span class="text-secondary"> Latitude: </span> {{data.position.lat}}
        <br/>
        <span class="text-secondary"> Longitude: </span> {{data.position.lng}}
      </p>
    </label>
    <br />
      <label class="py-1">
      <p class="font-weight-light">
        <span class="text-primary font-weight-bold">
                    <i class="fas fa-search-location text-primary"></i> <span> Endereço:</span>
                     <br />
        </span>
        <span>...</span>
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
