<?php 
require_once 'templates/header.php';
require_once 'templates/modals/modalnivel.php';
include("bd.php");

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_nivel WHERE id = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_nivel`");
$sentencia->execute();
$lista_nivel= $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa-solid fa-user-graduate"></i> Tipo de Nivel</h1>
            </div>
            <button class="btn btn-primary" type="button" onclick="openModal1()">Agregar Nivel</button>
        </div>
        <ul class="app-breadcrumb breadcrumb"> 
           
        </ul>  
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tablenivel">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo Nivel</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($lista_nivel as $registros) { ?>
                                        <tr>
                                            <td><?php echo $registros['id']; ?></td>
                                            <td><?php echo $registros['tipo']; ?></td>
                                            <td>
                                            <a class="btn btn-info btn-sm" href="editarnivel.php?txtID=<?php echo $registros['id']; ?>" type="button" title="Editar">
    <i class="fas fa-edit"></i>
</a>

<a class="btn btn-danger btn-sm" href="indexnivel.php?txtID=<?php echo $registros['id']; ?>" role="button" title="Eliminar">
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