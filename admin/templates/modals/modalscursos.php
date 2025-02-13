<?php 
include("bd.php");
if($_POST){

    $Codigo=(isset($_POST['Codigo']))?$_POST['Codigo']:"";
    $Curso=(isset($_POST['Curso']))?$_POST['Curso']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $fecha_curso = (isset($_POST['fecha_curso'])) ? $_POST['fecha_curso'] : "";

    $sentencia = $conexion->prepare("INSERT INTO `tbl_servicios` (`ID`, `Codigo`, `Curso`, `descripcion`, `fecha_curso`)
     VALUES (NULL, :Codigo, :Curso, :descripcion, :fecha_curso);");

    $sentencia->bindParam(":Codigo",$Codigo);
    $sentencia->bindParam(":Curso",$Curso);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":fecha_curso", $fecha_curso);

    $sentencia->execute();

    $mensaje="Registro agregado con exito.";

    header("location:indexcursos.php?mensaje=".$mensaje);

}

?>
<div class="modal fade" id="modalscursos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloModal">Ingrese el Nuevo Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

    
    <form action="" method="post">
                <div class="modal-body">
                

    <div class="mb-3">
      <label for="Codigo" class="form-label">Codigo</label>
      <input type="text"
        class="form-control" name="Codigo" id="Codigo" aria-describedby="helpId" placeholder="Codigo">
      
    </div>

    <div class="mb-3">
      <label for="Curso" class="form-label">Curso:</label>
      <input type="text"
        class="form-control" name="Curso" id="Curso" aria-describedby="helpId" placeholder="Curso">
    </div>  
    <div class="mb-3">
                        <label for="fecha_curso" class="form-label">Fecha del Curso:</label>
                        <input type="date" class="form-control" name="fecha_curso" id="fecha_curso" required>
                    </div>
    
    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion:</label>
      <input type="text"
        class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
     
                </div>

                <button type="submit" class="btn btn-success">Agregar</button>
                <a name="" id="" class="btn btn-primary" href="indexcursos.php" role="button">Cancelar</a>

                </div>
            </form>
        </div>
    </div>
</div>