<template>
  <div>
    <div class="row container"></div>
    <gmap-map :center="center" :zoom="zoom" style="width:100%;  height: 90vh;">
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        :icon="m.tipo == 'moto' ? m.velocidade == 0 ? 'img/moto.png' : 'img/motoandando.png' : m.velocidade == 0 ? 'img/carro.png' : 'img/carroandando.png'"

        :clickable="true"
        @click="abrirJanela(m)"
        :title="m.nome"
      />

      <gmap-info-window
        :options="infoWindow.options"
        :opened="infoWindow.open"
        :position="infoWindow.position"
        @closeclick="infoWindow.open = false"
        :data="infoWindow.data"
      >
      <info v-if="infoWindow.open"  :data="infoWindow.data" />
      </gmap-info-window>
    </gmap-map>
  </div>
</template>

<script>
import Vue from "vue";
import * as VueGoogleMaps from "vue2-google-maps";
export const eventBus = new Vue();

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyBLdmyd2H-t2cBb0M_udCjGcn-Upgudx5I",
    libraries: "places" // necessary for places input
  }
});

export default {
  name: "GoogleMap",
  data() {
    return {
      selectPosicao: "",
      infoWindow: {
        data: null,
        open: false,
        options: {
          pixelOffset: {
            width: 0,
            height: 0
          }
        }
      },
      center: { lat: -3.76825, lng: -38.566362 },
      zoom: 13,
      hora: new Date(),
      markers: [],
      places: [],
      currentPlace: null,
      icone: null
    };
  },

  mounted() {
    this.geolocate();
  },

  methods: {
    abrirJanela(item) {
      this.infoWindow.options.pixelOffset.width = 0;
      this.infoWindow.options.pixelOffset.height = -25;
      this.infoWindow.position = item.position;
      this.infoWindow.data = item;
      this.infoWindow.open = true;
    },
    setPlace(place) {
      this.currentPlace = place;
    },
    tempo() {
      setTimeout(() => {
        this.geolocate();
      }, 10000);
    },
    geolocate() {
      axios
        .get("/ultimaposicao")
        .then(response => {
          this.markers = [];
          [...response.data].forEach(item => {


            $dados = {
              position: {
                lat: parseFloat(item.latitude),
                lng: parseFloat(item.longitude)
              },
              nome: item.descricao,
              dataehora: item.dataehora,
              velocidade: item.velocidade,
              ignicao: item.ignicao,
              tipo: item.tipo
            };
               //Atualizar o Info Window se ele estiver aberto
              if(item.descricao == this.infoWindow.data.nome && this.infoWindow.open)
              {
              this.abrirJanela($dados)
              }

            this.markers.push($dados);
          });
        })
        .catch(error => {
          console.error("error: ", error);
        });

      this.tempo();
    }
  }
};
</script>
