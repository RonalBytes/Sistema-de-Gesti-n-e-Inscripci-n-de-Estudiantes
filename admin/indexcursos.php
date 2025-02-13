<?php
require_once 'templates/header.php';
require_once 'templates/modals/modalscursos.php';
include("bd.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
}

// Seleccionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_cursos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-book-bookmark"></i> Registro de Cursos</h1>
        </div>
        <button class="btn btn-primary" type="button" onclick="openModal4()">Nuevo curso</button>
    </div>
    <ul class="app-breadcrumb breadcrumb">

    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablecursos">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Habilitado</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col" style="width: 150px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lista_cursos as $registros) { ?>
                                    <tr>
                                        <td><?php echo $registros['ID']; ?> </td>
                                        <td><?php echo $registros['Codigo']; ?></td>
                                        <td><?php echo $registros['Curso']; ?></td>
                                        <td><?php echo $registros['descripcion']; ?></td>
                                        

                                        
                                        <td>
                                            <input type="checkbox" class="curso-checkbox" data-id="<?php echo $registros['ID']; ?>" <?php echo $registros['habilitado'] ? 'checked' : ''; ?>>
                                        </td>
                                        <td><?php echo isset($registros['fecha_curso']) ? $registros['fecha_curso'] : ''; ?></td>
                                        <td>
                                        <a class="btn btn-info btn-sm" href="editarcursos.php?txtID=<?php echo $registros['ID']; ?>" type="button" title="Editar">
    <i class="fas fa-edit"></i>
</a>
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
<?php require_once 'templates/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.curso-checkbox').change(function () {
            var idCurso = $(this).data('id');
            var habilitado = this.checked ? 1 : 0;

            $.ajax({
                type: 'POST',
                url: 'actualizar_estado_curso.php',
                data: { idCurso: idCurso, habilitado: habilitado },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Actualizar tabla de cursos
                        var cursoID = response.curso.ID;
                        var row = $('#tablecursos').find('tr[data-curso-id="' + cursoID + '"]');
                        
                        if (habilitado == 0) {
                            // Deshabilitar curso: ocultar la fila
                            row.hide();
                        } else {
                            // Habilitar curso: mostrar la fila
                            row.show();
                        }

                        // Actualizar modal de registro
                        if (habilitado == 0) {
                            // Deshabilitar curso: quitar opción del modal
                            $('#curso_' + cursoID).parent().hide();
                        } else {
                            // Habilitar curso: mostrar opción en el modal
                            $('#curso_' + cursoID).parent().show();
                        }

                        // Actualizar modal de registro (recargando la lista de cursos)
                        $('#cursos_disponibles').load('modalregistro_cursos.php');
                    } else {
                        console.error('Error:', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        });
    });
</script>



