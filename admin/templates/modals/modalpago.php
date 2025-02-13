<?php
include("bd.php");
if ($_POST) {
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $Fecha_actual = (isset($_POST['Fecha_actual'])) ? $_POST['Fecha_actual'] : "";

    $sentencia = $conexion->prepare("INSERT INTO `tbl_pagos` (`id`, `nombre`, `Fecha_actual`) VALUES (NULL, :nombre, :Fecha_actual);");
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":Fecha_actual", $Fecha_actual);
    $sentencia->execute();
    $mensaje = "Registro agregado con éxito.";

    header("location:indexpago.php?mensaje=" .$mensaje);
}
?>

<div class="modal fade" id="modalpago" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloModal">Nuevo Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idusuario" id="idusuario" value="">

                    <div class="form-group">
                        <label for="nombre" class="form-label">Tipo</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingresa el nombre">
                    </div>

                    <div class="form-group">
                        <label for="Fecha_actual" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="Fecha_actual" id="Fecha_actual" aria-describedby="helpId" placeholder="Ingresa la fecha">
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
