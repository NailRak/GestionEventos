<?php 
require_once ('Disertante.php');

class DisertanteFilter extends Disertante{


public function arreglo_filter($inicio,$final,$filtros) {
    $this->getConection();

    //sql para sacar la cantidad 
    //$this->getDisertantes();

    $sql = " SELECT * FROM ".$this->table." WHERE 1=1";


    if(!empty($filtros)){
    
        if(isset($filtros['id'])){
            $sql.= " AND id=".$filtros['id'];
            
        }
        
   

      if (isset($filtros['nombre'])){
      $sql .= " AND nombre like '%".$filtros['nombre']."%'";
       }
    
      if (isset($filtros['apellidos'])){
        $sql .= " AND apellidos like '%".$filtros['apellidos']."%'";
       
      }
    
      if (isset($filtros['biografia'])){
        $sql .= " AND biografia like '%".$filtros['biografia']."%'";
      }


      if (isset($filtros['telefono'])){
        $sql .= " AND telefono like '%".$filtros['telefono']."%'";
      }

      if (isset($filtros['url'])){
         $sql .= " AND url like '%".$filtros['url']."%'";
      }


      if (isset($filtros['email'])){
        $sql .= " AND email like '%".$filtros['email']."%'";
      }

      if (isset($filtros['twitter'])){
        $sql .= " AND twitter like '%".$filtros['twitter']."%'";
      }

      if (isset($filtros['linkedin'])){
        $sql .= " AND linkedin like '%".$filtros['linkedin']."%'";
      }
    



}

   //die($sql);

    $stmt=$this->conection->prepare($sql);
    $stmt->execute();
    $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->cantidad=count($resul);
    return $resul;

    if(isset($inicio)&&isset($final)){
     $sql.=" LIMIT $inicio,$final ";

     $stmt=$this->conection->prepare($sql);
     $stmt->execute();
     $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $resul;
    }


    function getDisertanteDetalle($page,$per_page,$filtros) {
      $arr_resultado=[];
      $c=0;
      $inicio = ($page*$per_page)-$per_page;
      $final=$per_page;
      $arr_resultado=$this->arreglo_filter($inicio,$final,$filtros);

      return $arr_resultado;
  
    }
    // $stmtcount = $this->conection->prepare($sqlcount);
    // $stmtcount->execute();
    // $resul = $stmtcount->fetch(PDO::FETCH_ASSOC);  
    // if (!empty($resul)) {
    //     $this->cantidad = $resul['cantidad'];
    // } else {
    //     $this->cantidad = 0;
    // }


   /* $sql = "SELECT a.id, a.dni, a.apellido, a.nombre, per.domicilio, per.idLocalidad, 
                   per.telefono_caracteristica, per.telefono_numero, per.email 
            FROM alumno a, persona per 
            WHERE a.dni = per.dni ";   

    if (isset($filtros['nombre'])) {
        $sql .= " and ( a.nombre like '%".$filtros['nombre']."%' or a.apellido like '%".$filtros['nombre']."%' ) ";
        $sqlcount .= " and ( a.nombre like '%".$filtros['nombre']."%' or a.apellido like '%".$filtros['nombre']."%' ) ";
    };               
    if (isset($filtros['dni'])) {
         $sql .= " and ( a.dni like '%".$filtros['dni']."%' ) ";
         $sqlcount .= " and ( a.dni like '%".$filtros['dni']."%' ) ";
    };
    if (isset($filtros['telefono'])) {
        $sql .= " and ( per.telefono_numero like '%".$filtros['telefono']."%' ) ";
        $sqlcount .= " and ( per.telefono_numero like '%".$filtros['telefono']."%' ) ";
    };
    if (isset($filtros['email'])) {
        $sql .= " and ( per.email like '%".$filtros['email']."%' ) ";
        $sqlcount .= " and ( per.email like '%".$filtros['email']."%' ) ";
    };
    if (isset($inicio)&&isset($final)) {
        $sql .= "LIMIT ".$inicio. "," . $final; 
    }
    $stmtcount = $this->conection->prepare($sqlcount);
    $stmtcount->execute();
    $res = $stmtcount->fetch(PDO::FETCH_ASSOC);  
    if (!empty($res)) {
        $this->cantidad = $res['cantidad'];
    } else {
        $this->cantidad = 0;
    }

    $stmt = $this->conection->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;*/

}





}

   
//$objDiserFilter = new DisertanteFilter();
//$objDiserFilter->cargaPrueba();

//$resultado = $objDiserFilter->arreglo_filter(1,10,['apellidos'=>'diaz']); 
//var_dump($resultado);

//$objDiserFilter->arreglo_filter(1,5,['apellidos'=>'ro']);


//var_dump($resultado,$objDiserFilter->getCantidad());



?>