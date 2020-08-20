<template>
<div class="container position-absolute align-middle">
<input type="text" v-model="motorista" placeholder="pesquisar..." />
</div>
</template>

<script>
export default {
    data (){
        return {
            motorista: null
        }
    }
}
</script>