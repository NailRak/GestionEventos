<?php

set_include_path('../../modelo/'.PATH_SEPARATOR."../../LIB");
require_once('Disertante.php');
require_once('Sanitize.class.php');




 $id=(isset($_POST['id']))?SanitizeVars::INT($_POST['id']):FALSE;




 $arr_resultado=[];


 if($id){

     $objseleccionar = new Disertante();

     $arr_disertante=$objseleccionar->getDisertanteById($id);
    
     $arr_resultado['codigo']=12;
     $arr_resultado['mensaje']='Se selecciono correctamente';
     $arr_resultado['datos']=$arr_disertante;
 
    }else{
      $arr_resultado['codigo']=99;
       $arr_resultado['mensaje']='hubo un error, seleccione un disertante';
       $arr_resultado['datos']= $arr_disertante;
      }
  
   
      echo json_encode($arr_resultado);

   
?>