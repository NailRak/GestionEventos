<?php

require_once "Db.php";
//require_once "../LIB/GeneradorDatos.php";


class Disertante{

    protected $conection;
    protected $table="disertante";
    protected $cantidad;

    private $id;
    private $nombre;
    private $apellidos;
    private $biografia;
    private $telefono;
    private $url;
    private $email;
    private $twitter;
    private $linkedin;

    function __construct($apellidos="", $nombre=""){
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        return $this;

    }

   public function getConection(){
    $dbObj= new Db();
    $this->conection=$dbObj->conection;
   }

   public function getCantidad(){
    $this->getConection();
    $sql='SELECT count(*) as cantidad FROM '.$this->table;
    $stmt=$this->conection->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);

   }

   public function setCantidad($cantidad){
    $this->cantidad=$cantidad;
   }

    public function getNombre(){
        return($this->nombre);
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getApellidos(){
        return($this->apellidos);
    }
    public function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }

    public function getBibliografia(){
        return($this->bibliografia);
    }
    public function setBibliografia($bibliografia){
        $this->bibliografia=$bibliografia;
    }
    
    public function getTelefono(){
        return($this->telefono);
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    public function getUrl(){
        return($this->url);
    }
    public function setUrl($url){
        $this->url=$url;
    }

    public function getEmail(){
        return($this->email);
    }
    public function setEmail($email){
        $this->email=$email;
    }

    
    public function getTwitter(){
        return($this->twitter);
    }
    public function setTwitter($twitter){
        $this->twitter=$twitter;
    }


    public function getLinkedin(){
        return($this->linkedin);
    }
    public function setLinkedin($linkedin){
        $this->linkedin=$linkedin;
    }
    
  
 
    public function getDisertantes(){
        $this->getConection();
        $sql="SELECT * FROM ".$this->table;
        $stmt=$this->conection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();

    }
    public function getDisertanteById($id){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id= ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	} 

    public function getDisertanteByApe($apellidos){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table."WHERE apellidos like ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$apellidos]);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	
   }

    public function save($param){
        $this->getConection();
        /* SET DEFAUL VALUES */
        /*CHECK IF EXISTS */
        $exists = FALSE;
        if(isset($param["id"]) && ($param["id"]!="")){
        $actualInstancia=$this->getDisertanteById($param["id"]);
           if($actualInstancia["id"]){
              $exists = TRUE;
             /*CURRRENT VALVES*/
             $this->id = $actualInstancia["id"];
             $this->nombre = $actualInstancia["nombre"];
             $this->apellidos= $actualInstancia["apellidos"];
             $this->biografia = $actualInstancia["biografia"];
             $this->telefono = $actualInstancia["telefono"];
             $this->url = $actualInstancia["url"];
             $this->email = $actualInstancia["email"];
             $this->twitter = $actualInstancia["twitter"];
             $this->linkedin = $actualInstancia["linkedin"];
             
      };
    };
        /*RECEIVED VALVES */
        if(isset($param["id"])) $this->id = $param["id"];
        if(isset($param["nombre"])) $this->nombre = $param["nombre"];
        if(isset($param["apellidos"])) $this->apellidos = $param["apellidos"];
        if(isset($param["biografia"])) $this->biografia = $param["biografia"];
        if(isset($param["telefono"])) $this->telefono = $param["telefono"];
        if(isset($param["url"])) $this->url = $param["url"];
        if(isset($param["email"])) $this->email = $param["email"];
        if(isset($param["twitter"])) $this->twitter = $param["twitter"];
        if(isset($param["linkedin"])) $this->linkedin = $param["linkedin"];



        //var_dump($id,$nombre,$apellidos,$biografia,$telefono,$url,$email,$twitter,$linkedin);
        //die();
       
        if($exists){
            $sql="UPDATE ".$this->table." SET nombre=?, apellidos=?, biografia=?, telefono=?, url=?, email=?, twitter=?, linkedin=? WHERE id=?";
            $stmt=$this->conection->prepare($sql);
          
            $stmt->execute([$this->nombre,$this->apellidos,$this->biografia,$this->telefono,$this->url,$this->email,$this->twitter,$this->linkedin,$this->id]);
           
        }else{
            $sql = "INSERT INTO ".$this->table. " (nombre, apellidos, biografia, telefono, url, email, twitter, linkedin) values(?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->conection->prepare($sql);
			$stmt->execute([$this->nombre,$this->apellidos,$this->biografia,$this->telefono,$this->url,$this->email,$this->twitter,$this->linkedin]);
			$this->id = $this->conection->lastInsertId();
        }
        return $this->id;



   
    }
  public function deleteDisertanteById($id){
 		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
 		$stmt = $this->conection->prepare($sql);
 		return $stmt->execute([$id]);
	}

     public function getDisertantePagination($conn){
  
     
        $sql='SELECT COUNT(id) as cantidad_total FROM disertante';    


 $result=mysqli_query($conn,$sql);
 $fila=mysqli_fetch_assoc($result);
 return $fila['cantidad_total'];

     }  
//     }
    
 /*public function cargaPrueba(){
 for($i=1; $i<=10; $i++){
     $nombre=GeneradorDatos::nombreAleatorio();
    //echo $nombre;
    $apellidos=GeneradorDatos::apellidoAleatorio();
    //echo $apellidos;
    $biografia=GeneradorDatos::biografiaAleatorio();

   $email=GeneradorDatos::emailAleatorio($nombre,$apellidos);
//     //echo "<br>".$email;
    $caracteristica=GeneradorDatos::caracteristicaAleatorio();
     $telformateado=GeneradorDatos::numAleatorio($caracteristica);
//    //echo "<br>".$carac."-".$num;
$url=GeneradorDatos::urlAleatorio($nombre,$apellidos);
//     // echo $url;
  $twitter=GeneradorDatos::twitterAleatorio($nombre,$apellidos);
   $linkedin=GeneradorDatos::linkedinAleatorio($nombre,$apellidos);

    $this->save(['nombre'=>$nombre,
    'apellidos'=>$apellidos,
    'biografia'=>$biografia,
     'email'=>$email,
    'telefono'=>$telformateado,
    'url'=>$url,
    'twitter'=>$twitter,
     'linkedin'=>$linkedin]);
 }


 }*/


}


//$objdisert = new Disertante();
// echo $objdisert->getApellido().' '.$objdisert->getNombre();
// echo "<br> ";
// var_dump ($objdisert->getDisertantes());

//var_dump($objdisert->getDisertanteById(6));

//$objdisert->save(["apellidos"=>"garcia", "nombre"=>"milena","biografia" => "trabajadora","telefono" => "3408673233","url" => "www.milenag.com","email" => "milenao@gmail.com","twitter" => "@milenag" ,"linkedin" => "gmile"]);

//$objdisert->deleteDisertanteById(1);

//echo $objdisert->cargaPrueba();




?>