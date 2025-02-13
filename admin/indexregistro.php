<?php 
require_once 'templates/header.php';
require_once 'templates/modals/modalregistro.php';
include("bd.php");

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_registro WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

$sentencia = $conexion->prepare("
    SELECT
        estudiante.ID AS estudiante_id,
        estudiante.Codigo AS estudiante,
        GROUP_CONCAT(curso.Codigo SEPARATOR '& ') AS cursos_inscritos,
        nivel.tipo AS nivel,
        turno.tipo AS turno,
        modalidad.modalidad AS modalidad,
        registro.Fecha_actual,
        pago.nombre AS pago,
        registro.monto,
        curso.fecha_curso
    FROM `tbl_registro` registro
    LEFT JOIN `tbl_estudiantes` estudiante ON registro.idestudiante = estudiante.ID
    LEFT JOIN `tbl_servicios` curso ON registro.idcurso = curso.ID
    LEFT JOIN `tbl_nivel` nivel ON registro.idnivel = nivel.ID
    LEFT JOIN `tbl_turno` turno ON registro.idturno = turno.ID
    LEFT JOIN `tbl_modalidad` modalidad ON registro.idmodalidad = modalidad.ID
    LEFT JOIN `tbl_pagos` pago ON registro.idpago = pago.ID
    GROUP BY estudiante.ID;
");

$sentencia->execute();
$lista_portafolio = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Inscripciones</h1>
        </div>
        <button class="btn btn-primary" type="button" onclick="openModal7()"> Nueva Inscripción</button>
    </div>
    <div class="text-right mb-2">
        <a href="fpdf/reporte.php" target="_blank" class="btn btn-danger">
            <i class="fa-solid fa-file-pdf"></i> Generar Reporte
        </a>
    </div>

    <ul class="app-breadcrumb breadcrumb"> </ul>  

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableregistrar">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">N° Estudiante</th>
                                    <th scope="col">Cursos Inscritos</th>
                                    <th scope="col">Nivel</th>
                                    <th scope="col">Turno</th>
                                    <th scope="col">Modalidad</th>
                                    <th scope="col">Fecha de pago</th>
                                    <th scope="col">Billetera</th>
                                    
                                    <th scope="col">Pago </th>
                                    <th scope="col">Fecha Curso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($lista_portafolio as $registros) { ?>
                                    <tr>
                                        <td><?php echo $registros['estudiante_id']; ?></td>
                                        <td><?php echo $registros['estudiante']; ?></td>
                                        <td><?php echo $registros['cursos_inscritos']; ?></td>
                                        <td><?php echo $registros['nivel']; ?></td>
                                        <td><?php echo $registros['turno']; ?></td>
                                        <td><?php echo $registros['modalidad']; ?></td>
                                        <td><?php echo $registros['Fecha_actual']; ?></td>
                                        <td><?php echo $registros['pago']; ?></td>
                                        <td>S/. <?php echo $registros['monto']; ?></td>
                                        <td><?php echo $registros['fecha_curso']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>
