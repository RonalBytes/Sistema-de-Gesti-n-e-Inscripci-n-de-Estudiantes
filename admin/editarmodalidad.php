<?php 


include("bd.php");

if(isset($_GET['txtID'])){
    //Recuparacion de id
    $txtID=(isset($_GET['txtID']) )?$_GET['txtID']:"";
    
    $sentencia=$conexion->prepare(" SELECT * FROM tbl_modalidad WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $modalidad=$registro['modalidad'];

    }


    if($_POST){
        print_r($_POST);
      
        $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
        $modalidad=(isset($_POST['modalidad']))?$_POST['modalidad']:"";

        
      
          $sentencia=$conexion->prepare("UPDATE tbl_modalidad
          SET 
          modalidad=:modalidad

          WHERE id=:id ");
          $sentencia->bindParam(":id",$txtID);
          $sentencia->bindParam(":modalidad",$modalidad);

          $sentencia->execute();
      
          $mensaje="Registro modificado con exito.";
      
          header("location:indexmodalidad.php?mensaje=".$mensaje);
      
      }

      include("templates/header.php");
?>
<div>
<main class="app-content">
    <div class="wrapp">
        <div>
            <h1><i class="fa fa-dashboard"></i> Editar Modalidad</h1>
        </div>
           
            <form action="" method="post">
                <label for="tstID" class="form-label">ID:</label>
                <input readonly type="text" 
                    class="form-control"  value ="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
            </div>
                

                    <div class="form-group">
                        <label for="control-label" class="form-label">modalidad</label>
                        <input type="text" class="form-control" value ="<?php echo $modalidad;?>" name="modalidad" id="modalidad" aria-describedby="helpId" placeholder="cambia la modalidad">
                    </div>

                    <button type="submit" class="btn btn-success" >Actualizar</button>
                    <a name="" id=""  class="btn btn-secondary" href="indexmodalidad.php" role="button">Cerrar</a>
                    
                
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>