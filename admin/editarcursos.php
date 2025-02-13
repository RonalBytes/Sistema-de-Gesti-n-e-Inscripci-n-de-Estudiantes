<?php include("bd.php");



if(isset($_GET['txtID'])){
//Recuparacion de id
$txtID=(isset($_GET['txtID']) )?$_GET['txtID']:"";

$sentencia=$conexion->prepare(" SELECT * FROM tbl_servicios WHERE id=:id");
$sentencia->bindParam(":id",$txtID);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_LAZY);

$Codigo=$registro['Codigo'];
$descripcion=$registro['descripcion'];
$Curso=$registro['Curso'];

}

if($_POST){
  print_r($_POST);

  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $Codigo=(isset($_POST['Codigo']))?$_POST['Codigo']:"";
  $Curso=(isset($_POST['Curso']))?$_POST['Curso']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_servicios 
    SET 
    Codigo=:Codigo,
    Curso=:Curso,
    descripcion=:descripcion
    WHERE id=:id ");
    

    $sentencia->bindParam(":Codigo",$Codigo);
    $sentencia->bindParam(":Curso",$Curso);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $mensaje="Registro modificado con exito.";

    header("location:indexcursos.php?mensaje=".$mensaje);

}

include("templates/header.php"); ?>


<div>
<main class="app-content">
    <div class="wrapp">
        <div>
            <h1><i class="fa fa-dashboard"></i> Editar Cursos</h1>
        </div>

    <form action="" enctype="multipart/form-data" method= "post">

    <div class="mb-3">
      <label for="txtID" class="form-label">ID</label>
      <input readonly value="<?php echo $txtID; ?>" type="text"
        class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
      
    </div>




    <div class="mb-3">
      <label for="Codigo" class="form-label">Codigo</label>
      <input value="<?php echo $Codigo; ?>" type="text"
        class="form-control" name="Codigo" id="Codigo" aria-describedby="helpId" placeholder="Codigo">
      
    </div>

    <div class="mb-3">
      <label for="Curso" class="form-label">Curso</label>
      <input value="<?php echo $Curso; ?>" type="text"
        class="form-control" name="Curso" id="Curso" aria-describedby="helpId" placeholder="Curso">
      
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion:</label>
      <input value="<?php echo $descripcion; ?>" type="text"
        class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">
    </div>  
    
    

    <button type="submit" class="btn btn-success">Actualizar</button>
    <a name="" id="" class="btn btn-primary" href="indexcursos.php" role="button">Cancelar</a>

    </form>

        
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>


<?php include("../../templates/footer.php");?>