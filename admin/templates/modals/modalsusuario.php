<?php

include("bd.php");

if($_POST){
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    

    $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios`
    (`ID`, `usuario`, `password`, `correo`) VALUES (NULL,:usuario,:password,:correo);");
        $sentencia->bindParam(":usuario",$usuario);
        $sentencia->bindParam(":password",$password);
        $sentencia->bindParam(":correo",$correo);
        
        $sentencia->execute();
        
        $mensaje="Registro agregado con exito.";

    header("location:indexusuario.php?mensaje=".$mensaje);
}

?>

<div class="modal fade" id="modalusuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloModal">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>



            <form action="" method="post">
                <div class="modal-body">
                    <form id="formyusuario" name="formusuario">

                    <input type="hidden" name="idusuario" id="idusuario" value="">

                    <div class="form-group">
                        <label for="control-label" class="form-label">Nombre del usuario</label>
                        <input type="text" class="form-control" name="usuario" id="Usuario" aria-describedby="helpId" placeholder="Nombre de usuario">
                    </div>

                    <div class="mb-3">
                        <label for="control-label" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="Correo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

