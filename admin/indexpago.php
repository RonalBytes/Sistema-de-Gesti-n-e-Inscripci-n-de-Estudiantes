<?php 
require_once 'templates/header.php';
require_once 'templates/modals/modalpago.php';
include("bd.php");
date_default_timezone_set('America/Lima');
if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_pagos WHERE id = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_pagos`");
$sentencia->execute();
$lista_pagos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa-brands fa-cc-visa"></i> Tipo de Pago</h1>
            </div>
            <button class="btn btn-primary" type="button" onclick="openModal5()">Agregar Nuevo pago</button>
        </div>
        <ul class="app-breadcrumb breadcrumb"> 
            
        </ul>  
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tablepago">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Forma de pago</th>
                                        <th>Fecha actual</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($lista_pagos as $registros) { ?>
                                        <tr>
                                            <td><?php echo $registros['id']; ?></td>
                                            <td><?php echo $registros['nombre']; ?></td>
                                            <td><?php echo date('Y-m-d H:i:s');?></td>
                                            
                                            <td>
                                            <a class="btn btn-info btn-sm" href="editarpago.php?txtID=<?php echo $registros['id']; ?>" type="button" title="Editar">
                                            <i class="fas fa-edit"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="indexpago.php?txtID=<?php echo $registros['id']; ?>" role="button" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                            </td>
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
<?php
require_once 'templates/footer.php';
?> 