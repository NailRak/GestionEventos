<?php

set_include_path('../../modelo/'.PATH_SEPARATOR."../../LIB");
require_once('Disertante.php');
require_once('Sanitize.class.php');


$objguardar = new Disertante();

 $id=(isset($_POST['id']))?SanitizeVars::INT($_POST['id']):FALSE;
 $nombre=(isset($_POST['nombre']))?SanitizeVars::STRING($_POST['nombre'],3,255):FALSE;
 $apellidos=(isset($_POST['apellidos']))?SanitizeVars::STRING($_POST['apellidos'],2,255):FALSE;
 $biografia=(isset($_POST['biografia']))?SanitizeVars::STRING($_POST['biografia'],5,255):FALSE;
 $telefono=(isset($_POST['telefono']))?SanitizeVars::STRING($_POST['telefono'],5,12):FALSE;
 $url=(isset($_POST['url']))?SanitizeVars::STRING($_POST['url'],5,255):FALSE;
 $email=(isset($_POST['email']))?SanitizeVars::EMAIL($_POST['email']):FALSE;
 $twitter=(isset($_POST['twitter']))?SanitizeVars::STRING($_POST['twitter'],5,255):FALSE;
 $linkedin=(isset($_POST['linkedin']))?SanitizeVars::STRING($_POST['linkedin'],5,255):FALSE;



 $arr_resultado=[];
 $arr_param=[];
 if($biografia){
  $arr_param["biografia"]=$biografia;
 }
if($telefono){
  $arr_param["telefono"]=$telefono;
}
if($url){
  $arr_param["url"]=$url;
}
if($email){
  $arr_param["email"]=$email;
}
if($twitter){
  $arr_param["twitter"]=$twitter;
}
if($linkedin){
$arr_param["linkedin"]=$linkedin;
}


if($nombre && $apellidos){

     $arr_param["nombre"]=$nombre;
     $arr_param["apellidos"]=$apellidos;

    if($id){
          $arr_param["id"]=$id;
   
      }
  
  
  
      if($objguardar){



      $arr_resultado['codigo']=12;
      $arr_resultado['mensaje']='la edicion fue satisfactoria';
  
     }else{


            $arr_resultado['codigo']=99;
           $arr_resultado['mensaje']='hubo un error';

     }

      }else{

      $arr_resultado['codigo']=45;
      $arr_resultado['mensaje']='falta completar campos obligatorios';


  }



$objguardar->save($arr_param);

echo json_encode($arr_resultado);




































?>