<?php 
include("bd.php");

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";


    $sentencia=$conexion->prepare(" SELECT * FROM tbl_registro WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $idestudiante=$registro["idestudiante"];
    $idpago=$registro["idpago"];
    $idcurso=$registro["idcurso"];
    $idturno=$registro["idturno"];
    $idnivel=$registro["idnivel"];
    

    



}
if($_POST){

    //Recepcionando los valores del formulario.
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $idestudiante=(isset($_POST['idestudiante']))?$_POST['idestudiante']:"";
    $idpago=(isset($_POST['idpago']))?$_POST['idpago']:"";
    $idcursos=(isset($_POST['idcurso']))?$_POST['idcursos']:""; 
    $idturno=(isset($_POST['idturno']))?$_POST['idturno']:""; 
    $idnivel=(isset($_POST['idnivel']))?$_POST['idnivel']:"";
 


    $sentencia=$conexion->prepare("UPDATE tbl_registro 
    SET 
    idestudiante=:idestudiante,
    idpago=:idpago,
    idcurso=:idcurso,
    idturno=:idturno,
    idnivel=:idnivel,

    WHERE id=:id ");

$sentencia->bindParam(":idestudiante",$idestudiante);
$sentencia->bindParam(":idpago",$idpago);
$sentencia->bindParam(":idcurso",$idcurso);
$sentencia->bindParam(":idturno",$idturno);
$sentencia->bindParam(":idnivel",$idnivel);

$sentencia->execute();

$mensaje="Registro modificado con exito.";

    header("location:indexestudiante.php?mensaje=".$mensaje);


}

include("templates/header.php"); ?>

<div>
<main class="app-content">
    <div class="wrapp">
        <div>
            <h1><i class="fa fa-dashboard"></i> Editar Estudiante</h1>
        </div>
           
        <form action="" method="post">
            <label for="Codigo" class="form-label">ID</label>
            <input type="text" 
                class="form-control"
                readonly
                 value="<?php echo $txtID;?>" 
                name="txtID" id="txtID" aria-describedby="helpId"placeholder="Nombres">   
            </div>


            <div class="mb-3">
            <label for="idestudiante" class="form-label">Estudiante</label>
            <input type="text" 
                class="form-control" value="<?php echo $idestudiante;?>" name="idestudiante" id="idestudiante" aria-describedby="helpId"placeholder="Nombres">   
            </div>

            <div class="mb-3">
            <label for="idpago" class="form-label">Metodo de Pago</label>
            <input type="text"
             class="form-control" value="<?php echo $idpago;?>" name="idpago"id="idpago" placeholder="Escribe tu DNI" required>
            </div>

            <div class="mb-3">
            <label for="idcurso" class="form-label">Curso</label>
            <input type="text" 
                class="form-control" value="<?php echo $idcurso;?>" name="idcurso" id="idcurso" aria-describedby="helpId"placeholder="Nombres">   
            </div>


            <div class="mb-3">
            <label for="idturno" class="form-label">Turno</label>
            <input type="text" 
                class="form-control" value="<?php echo $idturno;?>" name="idturno" id="idturno" aria-describedby="helpId"placeholder="Lugar">   
            </div>

            <div class="mb-3">
            <label for="idnivel" class="form-label">Nivel</label>
            <input type="text" 
                class="form-control" value="<?php echo $idnivel;?>" name="idnivel" id="idnivel" aria-describedby="helpId"placeholder="Edad">   
            </div>


        
            
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a name="" id="" class="btn btn-primary" href="indexregistro.php" role="button">Cancelar</a>

            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>