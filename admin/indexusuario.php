<?php
require_once 'templates/header.php';
require_once 'templates/modals/modalsusuario.php';
include("bd.php");


if (isset($_GET['txtID'])) {
    // Borrar
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-user-tie"></i> Lista de Usuarios</h1>
        </div>
            <button class="btn btn-primary" type="button"  onclick="openModal()">Nuevo Usuario</button>
    </div> 
    <ul class="app-breadcrumb breadcrumb"> 
        
          
</ul>  
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableusuarios">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuarios</th>
                                    <th>Correos</th>
                                    <th>Contraseñas</th>
                                    <th>Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lista_usuarios as $registros) { ?>
                                    <tr>
                                    <td><?php echo $registros['id']; ?></td>
                                        <td><?php echo $registros['usuario']; ?></td>
                                        <td><?php echo $registros['correo']; ?></td>
                                        <td><?php echo str_repeat("*", strlen($registros['password'])); ?></td>
                                        <td>
                                        <a class="btn btn-info btn-sm" href="editarusuario.php?txtID=<?php echo $registros['id']; ?>" type="button" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="indexusuario.php?txtID=<?php echo $registros['id']; ?>" role="button" title="Eliminar">
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
