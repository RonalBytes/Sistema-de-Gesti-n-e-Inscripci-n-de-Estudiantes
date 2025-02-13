<?php
include("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCurso = $_POST['idCurso'];
    $habilitado = $_POST['habilitado'];

    $query = "UPDATE tbl_servicios SET habilitado = :habilitado WHERE ID = :idCurso";
    $statement = $conexion->prepare($query);

    $statement->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
    $statement->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);

    if ($statement->execute()) {
        // Obtener información actualizada del curso
        $infoCurso = obtenerInformacionCurso($conexion, $idCurso);
        echo json_encode(['success' => true, 'curso' => $infoCurso]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado del curso']);
    }
}

function obtenerInformacionCurso($conexion, $idCurso) {
    $query = "SELECT * FROM tbl_servicios WHERE ID = :idCurso";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
?>
