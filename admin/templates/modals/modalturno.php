<?php
include("bd.php");
if($_POST){
    $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : "";

    $sentencia = $conexion->prepare("INSERT INTO `tbl_turno` (`id`, `tipo`) VALUES (NULL, :tipo);");
    $sentencia->bindParam(":tipo", $tipo);
    
    $sentencia->execute();
    $mensaje = "Registro agregado con éxito.";

    header("location:indexturno.php?mensaje=". $mensaje);
}


?>

<div class="modal fade" id="modalturno" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloModal">Nuevo Turno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="post">
                <div class="modal-body">
                                
                <div class="form-group">
                        <label for="tipo" class="form-label">Turno</label>
                        <input type="text" class="form-control" name="tipo" id="tipo" aria-describedby="helpId" placeholder="¿Cual es el turno que deseas agregar?">
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
