<template>
  <form>
    <div class="container">
      <div class="form-group">
        <input
          type="date"
          class="form-control text-center"
          v-model="dia"
          aria-describedby="emailHelp"
          placeholder="00/00/0000"
        />
        <small id="emailHelp" class="form-text text-muted text-center">Escolha a data desejada!</small>
      </div>
      <div
        v-if="bool.viagens"
        class="container-fluid text-center display-1 corprt position-absolute"
        style="z-index: 2;"
      >
        <i class="fas fa-cog fa-pulse icon"></i>
      </div>
    </div>
    <div class="container">
      <div v-if="bool.viagens == false" class="card m-1" v-for="viagem in viagens">
        <h5 class="card-header w100">
          <i v-if="viagem.tipo == 'onibus'" class="fas fa-bus"></i>
          <i v-if="viagem.tipo == 'carro'" class="fas fa-car-side"></i>
          <i v-if="viagem.tipo == 'moto'" class="fas fa-motorcycle"></i>
          {{viagem.descricao + ' - ' + viagem.placa}}
          <br />
          <span class="ml-1">
            <i class="fas fa-route"></i>
            {{(viagem.km/1000).toFixed(1)}}Km
          </span>      
        </h5>            

        <div class="card-body">
          <h6 class="card-title">
           <a href="#" @click.prevent="escolhermotorista"> <i class="fas fa-user-alt h4"></i> Motorista: {{viagem.nomeescala}} </a>
              <br />
              <br />
            <i class="far fa-clock"></i>
            Inicio:  {{viagem.horaInicio}} 
            <br />
            <br />
            <i class="far fa-clock"></i>
            Fim:  {{   viagem.horaFim}}
          </h6>
          <p class="card-text">
            <p class="text-primary text-bold d-inline"><i class="fas fa-road"></i> De:  </p>{{viagem.ruaInicio}}
              <br />
           <p class="text-primary text-bold d-inline"><i class="fas fa-road"></i> Até:  </p>{{viagem.ruaFim}}           
          </p>
          <a href="#" class="btn btn-sm btn-primary btn-block">Ver no mapa</a>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  data() {
    return {
      dia: null,
      escolhermotorista: false,
      viagens: [],
      bool: {
        viagens: false,
      },
    };
  },
  watch: {
    dia() {
      this.carregarViagens();
    },
  },
  methods: {
    carregarViagens() {
      this.bool.viagens = true;
      axios.get("viagens/" + this.dia).then((resposta) => {
       // console.log(resposta.data)
       this.carregarendereco(resposta.data)
      });
    },
    carregarendereco(obj) {
      obj.map((item) => {
        $.ajax({
          type: "GET",
         // async: false,
          url:
            "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
            item.latInicio +
            "," +
            item.lngInicio +
            "&key=AIzaSyBjRsY1NNPFms-CxPIyO6wZSrg-Hj_GpEw",
          success: (resultado) => {

            item.ruaInicio = 
            //rua
            resultado.results[0].address_components[1].long_name +
              "," +
              resultado.results[0].address_components[0].long_name +
              //bairro
              " - " +
              resultado.results[0].address_components[2].long_name;
          },
        });

            $.ajax({
          type: "GET",
         // async: false,
          url:
            "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
            item.latFim +
            "," +
            item.lngFim+
            "&key=AIzaSyBjRsY1NNPFms-CxPIyO6wZSrg-Hj_GpEw",
          success: (resultado) => {

            item.ruaFim = 
            //rua
            resultado.results[0].address_components[1].long_name +
              "," +
              //numero
              resultado.results[0].address_components[0].long_name +
              //bairro
              " - " +
              resultado.results[0].address_components[2].long_name;
          },
        });
      });
        
        this.viagens = obj
     
        this.bool.viagens = false     
     
    },
  },
};
</script>