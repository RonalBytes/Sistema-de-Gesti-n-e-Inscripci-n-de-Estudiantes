<?php 


include("bd.php");

if(isset($_GET['txtID'])){
    //Recuparacion de id
    $txtID=(isset($_GET['txtID']) )?$_GET['txtID']:"";
    
    $sentencia=$conexion->prepare(" SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $usuario=$registro['usuario'];
    $correo=$registro['correo'];
    $password=$registro['password'];
    
    }


    if($_POST){
        print_r($_POST);
      
        $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
        $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
        $correo=(isset($_POST['correo']))?$_POST['correo']:"";
        $password=(isset($_POST['password']))?$_POST['password']:"";
        
      
          $sentencia=$conexion->prepare("UPDATE tbl_usuarios
          SET 
          usuario=:usuario,
          correo=:correo,
          password=:password
          WHERE id=:id ");
          
      
          $sentencia->bindParam(":usuario",$usuario);
          $sentencia->bindParam(":password",$password);
          $sentencia->bindParam(":correo",$correo);
          $sentencia->bindParam(":id",$txtID);
          $sentencia->execute();
      
          $mensaje="Registro modificado con exito.";
      
          header("location:indexusuario.php?mensaje=".$mensaje);
      
      }

      require_once 'templates/header.php';
?>
<div>
<main class="app-content">
    <div class="wrapp">
        <div>
            <h1><i class="fa fa-dashboard"></i> Editar Usuarios</h1>
        </div>
           
            <form action="" method="post">

            <div class="mb-3">
                <label for="tstID" class="form-label">ID:</label>
                <input readonly type="text" 
                    class="form-control"  value ="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
            </div>
                

                    <div class="form-group">
                        <label for="control-label" class="form-label">Nombre del usuario</label>
                        <input type="text" class="form-control" value ="<?php echo $usuario;?>" name="usuario" id="usuario" aria-describedby="helpId" placeholder="correo">
                    </div>

                    <div class="mb-3">
                        <label for="control-label" class="form-label">Password</label>
                        <input type="password" class="form-control" value ="<?php echo $password;?>"  name="password" id="password" aria-describedby="helpId" placeholder="Contraseña">
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control"value ="<?php echo $correo;?>" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
                    </div>
                

                    <button type="submit" class="btn btn-success" >Actualizar</button>
                    <a name="" id=""  class="btn btn-secondary" href="indexusuario.php" role="button">Cerrar</a>
                    
                
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>