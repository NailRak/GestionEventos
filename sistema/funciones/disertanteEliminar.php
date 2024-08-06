<?php
set_include_path('../../modelo/');
require_once('Disertante.php');


if(!empty($_POST['disertantes'])){

$array_eliminar=explode('-',$_POST['disertantes']);
$objeliminar = new Disertante();

foreach($array_eliminar as $valor){
   
$objeliminar->deleteDisertanteById($valor);



}



$arr_resultado=[];


if($array_eliminar){
   
    $arr_resultado['codigo']=12;
    $arr_resultado['mensaje']='la eliminacion fue satisfactoria';
    

      }else{
       $arr_resultado['codigo']=99;
      $arr_resultado['mensaje']='hubo un error, seleccione un disertante';
       
      }
    
     
     
    }else{
        $arr_resultado['codigo']=10;
        $arr_resultado['mensaje']='seleccione un disertante';
        cargarContenido();
    }
     
     echo json_encode($arr_resultado);
   
     


/*$id=$_POST["id"];



$objeliminar = new Disertante();

$res= $objeliminar->deleteDisertanteById($id);

$arr_resultado=[];

if($res){
    $arr_resultado['codigo']=12;
    $arr_resultado['mensaje']='la eliminacion fue satisfactoria';
}else{
    $arr_resultado['codigo']=99;
    $arr_resultado['mensaje']='hubo un error';
}

// var_dump($arr_resultado);
echo json_encode($arr_resultado);*/






?>