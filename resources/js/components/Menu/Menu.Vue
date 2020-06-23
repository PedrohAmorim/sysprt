
<template>
 <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark" id='menuPrincipal'>
            <a class="navbar-brand" href="/home">
            <img class="navbar-brand bg-light" src="img/logo.png" style="max-width: 60px;" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" style="width: 65vw !important; margin: 0 auto;">
                        <a class="nav-link dropdown-toggle btn btn-light text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-eye"></i> <span class="rotulo">Ao Vivo</span>
                        </a>
                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <div class="row">
                                <div class="col-sm-5">
                                    <a class="dropdown-item btn btn-light" href="/home" ><i class="fas fa-eye"></i><span> Ao Vivo</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#" @click.prevent="opcao('replay')"><i class="fas fa-map-signs"></i><span> Replay</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-clipboard-list"></i><span> Viagens</span> </a>
                                    <a class="dropdown-item btn btn-light" href="/Motoristas"><i class="fas fa-location-arrow"></i><span> Motoristas</span></a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-sign-out-alt"></i><span> Sair</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Pesquisar">
                    <button class="btn btn-light text-dark text-center my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Pesquisar</button>
                </form>
            </div>
        </nav>
</template>

<script>
export default {

  data() {
      return {

      }
  },mounted(){


},methods: {
  opcao(valor) {
    if(valor == 'replay'){


      this.$emit('menu', true);
    }
  }
}
}
</script>
