<?php
require_once "GenerarLorem.php";

 abstract class GeneradorDatos{


    static public function nombreAleatorio($num=1){

    $cadnombre="";
    $arraynombre=["luciana","jesica","jimena","candela","rebeca","dana","ludmila","macarena","juliana","antonela","rocio","noelia"];        
    $clave=array_rand($arraynombre, $num);

    if(is_array($clave)){
        for($i=0; $i<$num; $i++){
        $cadnombre.=$arraynombre[$clave[$i]]." ";
     }
    }else{
        $cadnombre=$arraynombre[$clave];
    }

        return $cadnombre;
    }
    // static public function GenerarNombre($cant){
        
      

        
    // }
    

    static public function apellidoAleatorio($num=1){

        $cadapellido="";
        $arrayapellido=["garcia","martinez","rodriguez","lopez","sanchez","ramirez","torres","flores","perez","bianchi","diaz","nieva","fernandez"];        
        $clave=array_rand($arrayapellido, $num);
    
        if(is_array($clave)){
            for($i=0; $i<$num; $i++){
            $cadapellido.=$arrayapellido[$clave[$i]]." ";
         }
        }else{
            $cadapellido=$arrayapellido[$clave];
        }
    
            return $cadapellido;
        }


    static public function biografiaAleatorio($num=1){

        return generarLorem::ipsum($num);

    }
    
        
    static public function emailAleatorio($nombre,$apellido){

        $inicial=substr($nombre,0,1);
        $cademail="";
        $arrayemail=["@gmail.com","@hotmail.com","@yahoo.com"];        
        $clave=array_rand($arrayemail);
    
        
          
    
            return $inicial.$apellido.$arrayemail[$clave];
        }

        // static public function loremAleatorio($num=1){

        //     return  GenerarLorem::ipsum($num);
        
                
        //     }
     
        static public function caracteristicaAleatorio(){

        $arrcaracteristica=[11];
        for($i=200; $i<=3999; $i++){
            $arrcaracteristica[]=$i;

        }
        $clave=array_rand($arrcaracteristica);
        return $arrcaracteristica[$clave];

        }
     



        static public function numAleatorio($caracteristica){
     
           
            $largo=strlen($caracteristica);

          
            if($largo==2){
                
                $valor=rand(10000000,99999999);
        
            
             }else if($largo==3){
                $valor=rand(1000000,9999999);
        
                
            }else if($largo==4){
            
                $valor=rand(100000,999999);
           }
           
         
          return $valor;

        }
        
        static public function urlAleatorio($nombre,$apellido){

         $arr_dominios=['com','ar','com.ar','gov','net'];
         $clave=array_rand($arr_dominios);
         $url='www.'.$nombre.$apellido.'.'.$arr_dominios[$clave];
    

          return $url;

        }

static public function twitterAleatorio($nombre,$apellido){
    $twittergenerado="https://x/@".$nombre.$apellido."status/";

    return $twittergenerado; 
}
   
static public function linkedinAleatorio($nombre,$apellido){
    $linkedingenerado="https://www.linkedin.com/in/".$nombre.$apellido."lik/";

    return $linkedingenerado;
}


}



//echo GeneradorDatos::nombreAleatorio()." ".GeneradorDatos::apellidoAleatorio()."<br>";
//echo GeneradorDatos::nombreAleatorio()."".GeneradorDatos::apellidoAleatorio()."".GeneradorDatos::emailAleatorio();
// $caract = GeneradorDatos::caracteristicaAleatorio();
// $num = GeneradorDatos::numAleatorio($caract);

//echo GeneradorDatos::loremAleatorio();


// echo $caract."-".$num;

//echo GeneradorDatos::urlAleatorio("hola");

//echo GeneradorDatos::twitterAleatorio($nombre,$apellido);
//echo GeneradorDatos::linkedinAleatorio($nombre,$apellido);



?>