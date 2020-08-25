@extends('layouts.app')

@section('content')
   

 <?php  
 if(isset($_GET['bloqueio'])){
     if($_GET['bloqueio'] == 'true'){
     echo "<h1 class=' text-danger'>O bloqueio ficará ativo em até 1minuto </h1>";
     }else{
        echo "<h1 class=' text-success'>O desbloqueio será realizado em até 1minuto</h1>";
     }
   }

   ?>
<mapa></mapa>

<script>

window.localStorage.setItem('login', 'ok')
</script>

@endsection
