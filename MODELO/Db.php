<?php

class Db {

	private $host;
	private $db;
	private $user;
	private $pass;
	public $conection;

	public function __construct($host='localhost',$db_name='eventos_db',$db_user='root',$db_pass='') {		

		$this->host = $host;
		$this->db = $db_name;
		$this->user = $db_user;
		$this->pass = $db_pass;

		try {
           $this->conection = new PDO('mysql:host='.$this->host.'; dbname='.$this->db, $this->user, $this->pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }

  
$conn= new mysqli($host,$db_user,$db_pass,$db_name);
if($conn->connect_error){
 die("conexion fallida: ".$conn->connect_error);
}


	}



}
?>