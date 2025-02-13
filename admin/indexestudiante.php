<?php 
include("templates/header.php"); 
require_once 'templates/modals/modalsestudiante.php';
include("bd.php");

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_estudiantes WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

}

$sentencia=$conexion->prepare("SELECT*FROM `tbl_estudiantes`");
$sentencia->execute();
$lista_estudiante=$sentencia-> fetchAll(PDO::FETCH_ASSOC);


?>

<main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa-solid fa-users"></i> Registro de Estudiantes</h1>
            </div>
            <button class="btn btn-primary" type="button" onclick="openModal3()"> Nuevo Estudiante</button>
        </div>
        <ul class="app-breadcrumb breadcrumb"> 
            
        </ul>  
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tableestudiante">
                                <thead>
                                    <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Dni</th>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Lugar</th>
                                            <th scope="col">Edad</th>
                                            <th scope="col">Celular</th>
                                            <th scope="col">Correo Electronico</th>
                                            <th scope="col">Centro</th>
                                            <th scope="col">Acciones</th>
                                         </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php foreach($lista_estudiante as $registros){ ?>
                                                <tr>
                                                    <td><?php echo $registros['ID'];?></td>
                                                    <td><?php echo $registros['Codigo'];?></td>
                                                    <td> <?php echo $registros['Dni'];?></td>
                                                    <td><?php echo $registros['Nombres'];?></td>
                                                    <td><?php echo $registros['Lugar'];?></td>
                                                    <td><?php echo $registros['Edad'];?></td>
                                                    <td><?php echo $registros['Num_Cel'];?></td>
                                                    <td><?php echo $registros['Correo'];?></td>
                                                    <td><?php echo $registros['Centro'];?></td>
                
                                        <td>
                                        <a class="btn btn-info btn-sm" href="editarestudiante.php?txtID=<?php echo $registros['ID']; ?>" type="button" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a class="btn btn-danger btn-sm" href="indexestudiante.php?txtID=<?php echo $registros['ID']; ?>" role="button" title="Eliminar">
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
<?php include("templates/footer.php"); ?>