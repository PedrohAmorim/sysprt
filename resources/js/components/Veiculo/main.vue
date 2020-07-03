
<template>

<div class="container-fluid">
    <select class="form-control" >
  <option v-for="item in veiculos">

  </option>

    </select>
</div>

</template>

<script>
export default {

data (){
    return  {
     veiculos: []
    }
},mounted(){
this.pegarVeiculos
},
methods: {
    pegarVeiculos('/pegarveiculos'){
        axios.get()
        .then( resultado =>{

         veiculos = resultado
        }).catch(error =>{

        })
    }
}
}
</script>
