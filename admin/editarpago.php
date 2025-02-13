<?php 


include("bd.php");

if(isset($_GET['txtID'])){
    //Recuparacion de id
    $txtID=(isset($_GET['txtID']) )?$_GET['txtID']:"";
 
    $sentencia=$conexion->prepare(" SELECT * FROM tbl_pagos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $nombre=$registro['nombre'];
    $Fecha_actual=$registro['Fecha_actual'];
    

    }


    if($_POST){
        print_r($_POST);
      
        $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
        $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
        $Fecha_actual=(isset($_POST['Fecha_actual']))?$_POST['Fecha_actual']:"";

        
      
          $sentencia=$conexion->prepare("UPDATE tbl_pagos
          SET 
          nombre=:nombre,
          Fecha_actual=:Fecha_actual
          
          WHERE id=:id ");
          $sentencia->bindParam(":id",$txtID);
          $sentencia->bindParam(":nombre",$nombre);
          $sentencia->bindParam(":Fecha_actual",$Fecha_actual);

          $sentencia->execute();
      
          $mensaje="Registro modificado con exito.";
      
          header("location:indexpago.php?mensaje=".$mensaje);
      
      }

      include("templates/header.php");
?>
<div>
<main class="app-content">
    <div class="wrapp">
        <div>
            <h1><i class="fa fa-dashboard"></i> Editar Turno</h1>
        </div>
           
            <form action="" method="post">
                <label for="tstID" class="form-label">ID:</label>
                <input readonly type="text" 
                    class="form-control"  value ="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
            </div>
                

                    <div class="form-group">
                        <label for="control-label" class="form-label">Tipo de pago</label>
                        <input type="text" class="form-control" value ="<?php echo $nombre;?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="control-label" class="form-label">Fecha</label>
                        <input type="date" class="form-control" value ="<?php echo $Fecha_actual;?>" name="Fecha_actual" id="Fecha_actual" aria-describedby="helpId" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-success" >Actualizar</button>
                    <a name="" id=""  class="btn btn-secondary" href="indexpago.php" role="button">Cerrar</a>
                    
                
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>