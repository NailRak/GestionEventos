<?php

set_include_path('../modelo/');
require_once('DisertanteFilter.php');






?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>


<section>
<nav class="navbar justify-content-center" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ens40</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        <a class="nav-link" href="">Listado</a>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>

      </div>
    </div>
  </div>
</nav>




<div class="text-center mt-5 mb-3 p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end " ><h2>Disertantes</h2></div>
<!-- <form class="d-flex" role="buscar" action="../funciones/menuDisertantes.php" method="post"></form> -->


<div class="text-center mt-5 mb-3 p-3 border border-danger-subtle mx-auto p-2" style="width: 500px;"><h2>Area de trabajo</h2></div>
<br/>





<br>

<section id='area-trabajo'>



</section>




<!-- <section>

<div  class="alert alert-success" role="alert">  Se elimino correctamente!</div>
        

</section> -->



<script src="../public/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
<script>


let per_page=10;

$(document).ready(function(){



$("body").on('click','#todoslosdisertantes',function() { 

 
  // Desmarcar todas las checkboxes
  if($(this).is(":checked")){
    $(".check").prop("checked",true);
  }else{
    $(".check").prop("checked",false);
  }
});

cargarContenido(1);

});


function cargarContenido(page){

let param={'page':page,'per_page':per_page}

$.post("./funciones/disertanteListado.php",param,function(resultado){
      $("#area-trabajo").html(resultado);
   });

  // $.get('./funciones/disertanteListado.php',function(listado){
  //   $('#area-trabajo').html(listado);


  // });
  
}



function aplicarFiltros(){
  let nombre,apellidos,telefono;
  let param;

  nombre=$('#inputFiltroNombre').val();
  apellidos=$('#inputFiltroApellido').val();
  telefono=$('#inputFiltroTelefono').val();

  //alert(nombre+'-'+apellidos+'-'+telefono);

  if(!nombre && !apellidos && !telefono){
    alert("Debe completar los campos del filtro");
  }else{
    param={"nombre":nombre,"apellidos":apellidos,"telefono":telefono};
    $.post("./funciones/disertanteListado.php",param,function(resultado){
      $("#area-trabajo").html(resultado);
    });

  }

}
function quitarFiltros(){
  $('#inputFiltroNombre').val("");
  $('#inputFiltroApellido').val("");
  $('#inputFiltroTelefono').val("");
  cargarContenido();

}


function disertantesEliminar(){

let cadena = "";

$(".check:checked").each(function(){ 
 //alert($(this).val());

cadena+= $(this).val()+'-';

 });

 console.info(cadena.slice("-",-1));

  if(cadena != ""){
    if(confirm('estas seguro de eliminar disertantes?')){

  

    let parametro={"disertantes":cadena};
 
    $.post('./funciones/disertanteEliminar.php',parametro,function(resultado){
 
     if(resultado['codigo']==99){
      $('#mensaje').removeClass('alert-success');
      $('#mensaje').addClass('alert-danger');
      $('mensaje').html('<strong>Error:</strong>'+resultado['mensaje'])
       
     }else{
      $('#mensaje').removeClass('alert-danger');
      $('#mensaje').addClass('alert-success');
      $('mensaje').html('<strong>Atencion:</strong>'+resultado['mensaje'])
      cargarContenido();
      
     }
 
     
    },"json");
  }
  }else{
    $('#mensaje').removeClass('alert-success');
    $('#mensaje').addClass('alert-danger');
    $('mensaje').html('<strong>Por favor, selecciona un registro</strong>')

  }

};

function disertanteNuevo(){
  let url="./html/Disertante.html";
  $.get(url,function(data){
    $("#area-trabajo").html(data);
    $("#disertante_ver").addClass("invisible");
  });
  
}

function disertanteEditar(id){
  let datosDisertante = disertanteSeleccionar(id);
//console.info(datosDisertante);

   $.get("./html/Disertante.html",function(data){
   $("#area-trabajo").html(data);


    $("#inputId").val(datosDisertante['id']);
    $("#inputNombre").val(datosDisertante['nombre']);
    $("#inputApellido").val(datosDisertante['apellidos']);
    $("#inputBiografia").val(datosDisertante['biografia']);
    $("#inputTelefono").val(datosDisertante['telefono']);
    $("#inputUrl").val(datosDisertante['url']);
    $("#inputEmail").val(datosDisertante['email']);
    $("#inputTwitter").val(datosDisertante['twitter']);
    $("#inputLinkedin").val(datosDisertante['linkedin']);
    $("#disertante_ver").addClass("d-none");
  });

}

function disertanteGuardar(){


  let id, nombre, apellidos, biografia, telefono, url, email, twitter, linkedin;
  let param;

   id = $("#inputId").val();
   nombre = $("#inputNombre").val();
   apellidos = $("#inputApellido").val();
   biografia = $("#inputBiografia").val();
   telefono = $("#inputTelefono").val();
   url = $("#inputUrl").val();
   email = $("#inputEmail").val();
   twitter = $("#inputTwitter").val();
   linkedin = $("#inputLinkedin").val();

  param={"id":id,"nombre":nombre,"apellidos":apellidos,"biografia":biografia,"telefono":telefono,"url":url,"email":email,"twitter":twitter,"linkedin":linkedin}; 

  $.post('./funciones/disertanteGuardar.php',param,function(resultado){

 if(resultado['codigo']==99){
  $('#mensaje').removeClass('alert-success');
  $('#mensaje').addClass('alert-danger');
  $('mensaje').html('<strong>Error:</strong>'+resultado['mensaje'])
   
 }else{
  $('#mensaje').removeClass('alert-danger');
  $('#mensaje').addClass('alert-success');
  $('mensaje').html('<strong>Atencion:</strong>'+resultado['mensaje'])

     
 }
 cargarContenido(1);
 },"json")
  
  }


function disertanteSeleccionar(id){

  let datos_disertante;
  $.ajaxSetup({async:false});
  $.post('./funciones/disertanteSeleccionar.php',{'id':id},function(resul){

    datos_disertante=resul['datos'];

  },"json");

return datos_disertante;
}

function disertanteVer(id){
  let datosDisertante = disertanteSeleccionar(id);

console.info(datosDisertante);

   $.get("./html/Disertante.html",function(data){
    $("#area-trabajo").html(data);

    $("#spantId").html(datosDisertante['id']);
    $("#spanNombre").html(datosDisertante['nombre']);
    $("#spanApellido").html(datosDisertante['apellidos']);
    $("#spanBiografia").html(datosDisertante['biografia']);
    $("#spanTelefono").html(datosDisertante['telefono']);
    $("#spanUrl").html(datosDisertante['url']);
    $("#spanEmail").html(datosDisertante['email']);
    $("#spanTwitter").html(datosDisertante['twitter']);
    $("#spanLinkedin").html(datosDisertante['linkedin']);
    $("#disertante_alta_edicion").addClass("d-none");
    $("#disertante_ver").removeClass("d-none");
  });

}



</script>


</body>
</html>