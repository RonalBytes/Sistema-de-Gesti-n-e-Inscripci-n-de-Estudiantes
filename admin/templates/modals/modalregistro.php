<?php
include("bd.php");

if ($_POST) {
    $idestudiante = (isset($_POST['idestudiante'])) ? $_POST['idestudiante'] : "";
    $idpago = (isset($_POST['idpago'])) ? $_POST['idpago'] : "";
    $idcursos = (isset($_POST['idcurso'])) ? $_POST['idcurso'] : array();
    $idturno = (isset($_POST['idturno'])) ? $_POST['idturno'] : "";
    $idnivel = (isset($_POST['idnivel'])) ? $_POST['idnivel'] : "";
    $idmodalidad = (isset($_POST['idmodalidad'])) ? $_POST['idmodalidad'] : "";
    $monto = (isset($_POST['monto'])) ? $_POST['monto'] : "";
    $Fecha_actual = (isset($_POST['Fecha_actual'])) ? $_POST['Fecha_actual'] : "";

    foreach ($idcursos as $idcurso) {
        $sentencia = $conexion->prepare("INSERT INTO `tbl_registro` (`ID`, `idestudiante`, `idpago`, `idcurso`, `idturno`, `idnivel`,`monto`,`idmodalidad`,`Fecha_actual`)
         VALUES (NULL,:idestudiante,:idpago,:idcurso,:idturno,:idnivel,:monto,:idmodalidad,:Fecha_actual);");

        $sentencia->bindParam(":idestudiante", $idestudiante);
        $sentencia->bindParam(":idpago", $idpago);
        $sentencia->bindParam(":idcurso", $idcurso);
        $sentencia->bindParam(":idturno", $idturno);
        $sentencia->bindParam(":idnivel", $idnivel);
        $sentencia->bindParam(":idmodalidad", $idmodalidad);
        $sentencia->bindParam(":monto", $monto);
        $sentencia->bindParam(":Fecha_actual", $Fecha_actual);

        $sentencia->execute();
    }

    $mensaje = "Registro agregado con éxito.";

    header("location:indexregistro.php?mensaje=" . $mensaje);
    // Recepcionando los valores del formulario.
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_pagos`");
$sentencia->execute();
$lista_pagos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios` WHERE habilitado = 1"); // Solo selecciona cursos habilitados
$sentencia->execute();
$lista_cursos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM `tbl_turno`");
$sentencia->execute();
$lista_turno = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM `tbl_nivel`");
$sentencia->execute();
$lista_nivel = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT*FROM `tbl_estudiantes`");
$sentencia->execute();
$lista_estudiante = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM `tbl_modalidad`");
$sentencia->execute();
$lista_modalidad = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="modal fade" id="modalsregistro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;">
        <div class="modal-content" style="padding: 10px;">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloModal">Nueva Inscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="idestudiante" class="form-label">Estudiante:</label>
                        <input type="text" class="form-control" id="searchStudent" placeholder="Buscar estudiante...">
                        <div id="autocompleteResults"></div>
                        <select class="form-select form-select-sm" name="idestudiante" id="idestudiante" style="display: none;">
                            <?php foreach ($lista_estudiante as $registros) { ?>
                                <option value="<?php echo $registros['ID']; ?>">
                                    <?php echo $registros['Codigo'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cursos disponibles:</label>
                        <?php foreach ($lista_cursos as $registro) { ?>
                            <div>
                                <input type="checkbox" id="curso_<?php echo $registro['ID'] ?>" name="idcurso[]" value="<?php echo $registro['ID'] ?>">
                                <label for="curso_<?php echo $registro['ID'] ?>"><?php echo $registro['Codigo'] ?></label>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <label for="idturno" class="form-label">Turno:</label>
                        <select class="form-select form-select-sm" name="idturno" id="idturno">
                            <?php foreach ($lista_turno as $registros) { ?>
                                <option value="<?php echo $registros['id'] ?>">
                                    <?php echo $registros['tipo'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="idmodalidad" class="form-label">Modalidad:</label>
                        <select class="form-select form-select-sm" name="idmodalidad" id="idmodalidad">
                            <?php foreach ($lista_modalidad as $registros) { ?>
                                <option value="<?php echo $registros['id'] ?>">
                                    <?php echo $registros['modalidad'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="idnivel" class="form-label">Nivel:</label>
                        <select class="form-select form-select-sm" name="idnivel" id="idnivel">
                            <?php foreach ($lista_nivel as $registros) { ?>
                                <option value="<?php echo $registros['id'] ?>">
                                    <?php echo $registros['tipo'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Fecha_actual" class="form-label">Fecha de pago:</label>
                        <input type="date" class="form-control" name="Fecha_actual" id="Fecha_actual" aria-describedby="helpId" placeholder="Fecha">
                    </div>

                    

                    <div class="mb-3">
                        <label for="idpago" class="form-label">Método de Pago:</label>
                        <select class="form-select form-select-sm" name="idpago" id="idpago">
                            <?php foreach ($lista_pagos as $registros) { ?>
                                <option value="<?php echo $registros['id'] ?>">
                                    <?php echo $registros['nombre'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="monto" class="form-label">Pago:</label>
                        <div class="input-group">
                            <span class="input-group-text">S/</span>
                            <input type="text" class="form-control" name="monto" id="monto" aria-describedby="helpId" placeholder="En Soles...">
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="padding: 10px;">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#searchStudent').on('input', function () {
            var searchText = $(this).val().toLowerCase();
            var resultsContainer = $('#autocompleteResults');
            resultsContainer.empty();

            // Filtrar estudiantes y mostrar resultados previos
            $.each(<?php echo json_encode($lista_estudiante); ?>, function (index, estudiante) {
                var studentCode = estudiante['Codigo'].toLowerCase();
                if (studentCode.includes(searchText)) {
                    resultsContainer.append('<div class="autocompleteResult" data-id="' + estudiante['ID'] + '">' + estudiante['Codigo'] + '</div>');
                }
            });

            // Manejar la selección de un resultado previo
            $('.autocompleteResult').on('click', function () {
                var selectedId = $(this).data('id');
                $('#idestudiante').val(selectedId);
                $('#searchStudent').val($(this).text());
                resultsContainer.empty();
            });
        });
    });
</script>
