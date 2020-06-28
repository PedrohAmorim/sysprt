<template>
  <div>
    <div class="container-fluid p-0">
      <gmap-map :center="center" :zoom="zoom" :style="{width: '100%',  height: '90vh'}">
        <gmap-polyline
        v-if="ver.linha"
        :path="markersLine"
        :options="{ strokeColor: 'blue' }"
        />
        <gmap-marker
          :key="index"
          v-if="ver.marker"
          v-for="(m, index) in markers"
          :position="{lat : m.latitude, lng:m.longitude}"
          :icon="icone(m.tipo)"
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
          <info v-if="infoWindow.open" :data="infoWindow.data" />
        </gmap-info-window>
      </gmap-map>

      <div v-if="modo != 'normal'" class="fixed-bottom fundo">
        <img
          v-if="carregando"
          src="img/carregando.gif"
          style="height: 150px margin: 0 auto !important;"
        />

        <div v-if="!carregando">

          <div class="row m-1">
            <div class="col text-center" @click="reproduzir(-1)">
              <i class="fas fa-chevron-left text-light display-4"></i>
            </div>

            <div class="col text-center">
              <i class="far fa-play-circle text-light display-4"></i>
            </div>

            <div class="col text-center" @click="reproduzir(1)">
              <i class="fas fa-chevron-right text-light display-4"></i>
            </div>
          </div>
          <div class="row text-light text-center h3 m-3">
            <div class="col text-center" style="font-size: 15px;">
              <input type="checkbox" class="form-check-input" v-model="ver.marker" />
              <span>Ver pontos</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import * as VueGoogleMaps from "vue2-google-maps";

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
      ver: {
        linha: false,
        marker: true
      },
      center: { lat: -3.76825, lng: -38.566362 },
      zoom: 11,
      markers: [],
      markersReserva: [],
      ponto: 0,
      markersLine: [],
      modo: "normal",
      atualizar: true,
      carregando: false
    };
  },
  watch: {
  },
  mounted() {
    this.geolocate();

    this.$eventBus.$on(["replay"], data => {
      this.carregando = true;
      this.atualizar = false;
      this.posicaoperiodo(data);
      this.modo = "replay";
    });
  },
  methods: {
    reproduzir($valor) {
      this.modo = "passando";

      this.markers = [];
      this.markersReserva[this.ponto].tipo == "replay";
      this.markers.push(this.markersReserva[this.ponto]);
      this.center = {
        lat: this.markersReserva[this.ponto].latitude,
        lng: this.markersReserva[this.ponto].longitude
      };
      this.horaatual = this.markersReserva[this.ponto].dataehora;
      this.zoom = 15;

      this.abrirJanela(this.markersReserva[this.ponto]);

      if (this.ponto == 0 && $valor < 0) {
        alert("Você está na primeira posição");
      } else if (
        this.ponto == this.markersReserva.lenght - 1 &&
        this.valor > 0
      ) {
        alert("Você está na ultima posição");
      } else {
        this.ponto = this.ponto + $valor;
      }
    },
    icone(tipo) {
      switch (tipo) {
        case "moto":
          return "img/moto.png";
          break;
        case "carro":
          return "img/carro.png";
          break;
        case "replay":
          return "img/local.png";
          break;
      }
    },
    posicaoperiodo(dados) {
      this.atualizar = false;
      this.carregando = true;
      this.markers.pop();
      axios
        .post("/posicaoperiodo", dados)
        .then(response => {
          [...response.data].forEach(item => {
            this.markersLine.push({
              lat: parseFloat(item.latitude),
              lng: parseFloat(item.longitude)
            });
            item.latitude = parseFloat(item.latitude)
            item.longitude = parseFloat(item.longitude)
            item.tipo = "replay"
            this.markers.push(item)
          });
          this.markersReserva = this.markers
          this.ver.linha = true
          this.center = {
            lat: this.markers[this.markers.length - 1].latitude,
            lng: this.markers[this.markers.length - 1].longitude
          }
          this.zoom = 15
          this.carregando = false
        })
        .catch(error => {
          console.error("error: ", error);
        });
    },
    mostrar(dados) {
      axios
        .post("/ultimaposicao")
        .then(response => {
          [...response.data].forEach(item => {
            if (this.infoWindow.data != null) {
              //Atualizar o Info Window se ele estiver aberto
              if (
                item.descricao == this.infoWindow.data.nome &&
                this.infoWindow.open
              ) {
                this.abrirJanela(item);
              }
            }
            item.latitude = parseFloat(item.latitude);
            item.longitude = parseFloat(item.longitude);
            this.markers.push(item);
          });
        })
        .catch(error => {
          console.error("error: ", error);
        });
    },
    abrirJanela(item) {
      let $dados = {
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
      this.infoWindow.open = false;
      setTimeout(() => {
        this.infoWindow.options.pixelOffset.width = 0;
        this.infoWindow.options.pixelOffset.height = -40;
        this.infoWindow.position = $dados.position;
        this.infoWindow.data = $dados;
        this.infoWindow.open = true;
      }, 100);
    },
    tempo() {
      setTimeout(() => {
        if (this.atualizar) this.geolocate();
      }, 20000);
    },
    geolocate() {
      axios
        .get("/ultimaposicao")
        .then(response => {
          this.markers = [];
          [...response.data].forEach(item => {
            if (this.infoWindow.data != null) {
              //Atualizar o Info Window se ele estiver aberto
              if (
                item.descricao == this.infoWindow.data.nome &&
                this.infoWindow.open
              ) {
                this.abrirJanela(item);
              }
            }
            item.latitude = parseFloat(item.latitude);
            item.longitude = parseFloat(item.longitude);

            this.markers.push(item);
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
