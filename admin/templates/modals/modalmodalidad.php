<?php
include("bd.php");
if($_POST){
    $modalidad = (isset($_POST['modalidad'])) ? $_POST['modalidad'] : "";
    $sentencia = $conexion->prepare("INSERT INTO `tbl_modalidad` (`id`, `modalidad`) VALUES (NULL, :modalidad);");
    $sentencia->bindParam(":modalidad", $modalidad); 
    $sentencia->execute();
    $mensaje = "Registro agregado con éxito.";

    header("location:indexmodalidad.php?mensaje=" . $mensaje);
}


?>

<div class="modal fade" id="modalmodalidad" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloModal">Nueva Modalidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="post">
                <div class="modal-body">
                <form id="formusuario" name="formusuario">
                    <input type="hidden" name="idusuario" id="idusuario" value="">
                    
                
                <div class="form-group">
                        <label for="modalidad" class="form-label">Modalidad</label>
                        <input type="text" class="form-control" name="modalidad" id="modalidad" aria-describedby="helpId" placeholder="Ingresa la modalidad">
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
