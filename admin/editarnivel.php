<?php 


include("bd.php");

if(isset($_GET['txtID'])){
    //Recuparacion de id
    $txtID=(isset($_GET['txtID']) )?$_GET['txtID']:"";
    
    $sentencia=$conexion->prepare(" SELECT * FROM tbl_nivel WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $tipo=$registro['tipo'];

    }


    if($_POST){
        print_r($_POST);
      
        $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
        $tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";

        
      
          $sentencia=$conexion->prepare("UPDATE tbl_nivel
          SET 
          tipo=:tipo

          WHERE id=:id ");
          $sentencia->bindParam(":id",$txtID);
          $sentencia->bindParam(":tipo",$tipo);

          $sentencia->execute();
      
          $mensaje="Registro modificado con exito.";
      
          header("location:indexturno.php?mensaje=".$mensaje);
      
      }

      include("templates/header.php");
?>
<div>
<main class="app-content">
    <div class="wrapp">
        <div>
            <h1><i class="fa fa-dashboard"></i> Editar Nivel</h1>
        </div>
           
            <form action="" method="post">
                <label for="tstID" class="form-label">ID:</label>
                <input readonly type="text" 
                    class="form-control"  value ="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
            </div>
                

                    <div class="form-group">
                        <label for="control-label" class="form-label">Tipo de turno</label>
                        <input type="text" class="form-control" value ="<?php echo $tipo;?>" name="tipo" id="tipo" aria-describedby="helpId" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-success" >Actualizar</button>
                    <a name="" id=""  class="btn btn-secondary" href="indexturno.php" role="button">Cerrar</a>
                    
                
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>