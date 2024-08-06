<?php
set_include_path('../../modelo/'.PATH_SEPARATOR."../../LIB");
require_once('DisertanteFilter.php');
require_once ('Disertante.php');
require_once('Sanitize.class.php');
require_once('pagination.php');


$objDisertante = new DisertanteFilter();

$arrDisertantes= $objDisertante->getDisertantes();

// $nombre=(isset($_POST['nombre']))?SanitizeVars::STRING($_POST['nombre'],3,255):FALSE;
// $apellidos=(isset($_POST['apellidos']))?SanitizeVars::STRING($_POST['apellidos'],2,255):FALSE;
// $telefono=(isset($_POST['telefono']))?SanitizeVars::STRING($_POST['telefono'],6,12):FALSE;

$nombre=(isset($_POST['nombre']))?$_POST['nombre']:FALSE;
$apellidos=(isset($_POST['apellidos']))?$_POST['apellidos']:FALSE;
$telefono=(isset($_POST['telefono']))?$_POST['telefono']:FALSE;

$page=(isset($_POST['page']))?SanitizeVars::INT($_POST['page'],0,10):FALSE;
$per_page=(isset($_POST['per_page']))?SanitizeVars::INT($_POST['per_page'],0,10):FALSE;
//var_dump($_POST);exit;

$arr_filtro=[];

if($nombre){
    $arr_filtro["nombre"]=$nombre;

}

if($apellidos){
    $arr_filtro["apellidos"]=$apellidos;
}
if($telefono){
    $arr_filtro["telefono"]=$telefono;
}

$arrDisertantes= $objDisertante->arreglo_filter($page,$per_page,$arr_filtro);


$per_page = 10; 
$adjacents = 4;


$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalItems = getDisertantePagination($conn);
$totalPaginas = ceil($totalItems / $per_page);

$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $per_page;

$sql = "SELECT * FROM disertante WHERE (items LIKE '%$clave%' OR color LIKE '%$clave%') LIMIT $offset, $per_page";
$result = mysqli_query($conn, $sql);


paginate($page, $tpages, $adjacents);




?>


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

<p class="text-center fs-5 fw-medium text-decoration-underline">Buscar por:</p>
<div class="container">
  <div class="row">
    <div class="col">
     Nombre:
     <form class="d-flex" role="search">
        <input class="finputFiltroNombre form-control me-2" value="<?=$nombre; ?>" id="inputFiltroNombre" type="search" placeholder="Ingrese un nombre..." aria-label="Search">
      </form>
    </div>
    <div class="col">
      Apellido:
      <form class="d-flex" role="search">
        <input class="inputFiltroApellido form-control me-2"  value="<?=$apellidos;?>" id="inputFiltroApellido" type="search" placeholder="Ingrese un apellido..." aria-label="Search">
        
    </div>
    <div class="col">
     Telefono:
      <form class="d-flex" role="search">
        <input class="inputFiltroTelefono form-control me-2"  value="<?=$telefono;?>" id="inputFiltroTelefono" type="search" placeholder="Ingrese un numero..." aria-label="Search">
       
    </div> 
  </div>
 </div> 
<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-center">
  <button class="me-md-2 btn btn-outline-info" onclick='aplicarFiltros()' type="button">Buscar</button>
  <button class="btn btn-outline-secondary" onclick='quitarFiltros()' type="button">Borrar</button>
</div>
<hr>
<table class="table">
<thead class="table-info ">
       
<!-- 
        <div class="alert alert-success" role="alert"></div>
          Se elimino correctamente!
           -->

              <div class="p-2">
               <button onclick='disertanteNuevo()' type='button' class="btn btn-outline-primary me-md-2 ">Agregar nuevo disertante</button>
              
                  <button onclick='disertantesEliminar()' type='button' class="btn btn-outline-danger me-md-2">Eliminar lo seleccionado </button>
                </div>
               <br>         
                 
            </div>

   
            <tr>
           
               
              
                <th scope="col"> <input name='todoslosdisertantes' class="check" type="checkbox" id="todoslosdisertantes">
                 <label class="form-check-label" for="flexCheckDefault"></label></div>
</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre/Apellido</th>
                <th scope="col">Telefono</th>
                <th scope="col">Url</th>
                <th scope="col">Email</th>
                <th scope="col">Twitter</th>
                <th scope="col">Linkedin</th>
                <th scope="col">Acciones</th>

        
            </tr>
            </thead>

         

            <tbody>
       
            <?php
            if(!empty($arrDisertantes)){
          
            foreach($arrDisertantes as $value){



             ?>






       

           <tr>
            <td>
            <input class="check" type="checkbox" name='disertantes[]' value="<?php echo $value['id'];?>" id="disertantes">
                 <label class="form-check-label" for="flexCheckDefault"></label></div>
            </td>
       
                     <td><?php echo $value["id"]; ?></td>
                    <th scope="row"><?php echo $value['nombre']." ".$value["apellidos"]; ?></th>
                    <td><?php echo $value["telefono"]; ?></td>
                    <td><?php echo $value["url"]; ?></td>
                    <td><?php echo $value["email"]; ?></td>
                    <td><?php echo $value["twitter"]; ?></td>
                    <td><?php echo $value["linkedin"]; ?></td>
                  
                  
            <td>
                    <!-- <div class="d-sm-inline-block"><form action="" method="post">
		          <input type="hidden" name="id" value=>
		          <button class="btn btn-outline-danger btn-sm" type="submit" name="btneliminar" id="btnborrar">Eliminar</button></form></div> -->

                  
		          <button onclick="disertanteEditar(<?php echo $value['id']; ?>)" class="btn btn-outline-primary btn-sm" type="button" name="btnguardar" id="btnguardar">Editar</button>
             
              <button onclick="disertanteVer(<?php echo $value['id']; ?>)" class="btn btn-outline-info btn-sm" type="button" name="btnver" id="btnver">Ver</button>

                
                
            </td>
          </tr>
                               
              
                     
                <?php
            }
        }

                ?>
                          
        
                 </tbody>
           
            </table>
      

            <table border="1">
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Color</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['items']; ?></td>
                <td><?php echo $row['color']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div>
        <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
            <a href="?pagina=<?php echo $i; ?>&clave=<?php echo urlencode($clave); ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>


</body>
</html>