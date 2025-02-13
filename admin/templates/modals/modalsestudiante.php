<?php 
include("bd.php");
if($_POST){
    //Recepcionando los valores del formulario.
    $Codigo=(isset($_POST['Codigo']))?$_POST['Codigo']:"";
    $Dni=(isset($_POST['Dni']))?$_POST['Dni']:"";
    $Nombres=(isset($_POST['Nombres']))?$_POST['Nombres']:"";
    $Lugar=(isset($_POST['Lugar']))?$_POST['Lugar']:""; 
    $Edad=(isset($_POST['Edad']))?$_POST['Edad']:"";
    $Num_Cel=(isset($_POST['Num_Cel']))?$_POST['Num_Cel']:"";
    $Correo=(isset($_POST['Correo']))?$_POST['Correo']:"";
    $Centro=(isset($_POST['Centro']))?$_POST['Centro']:"";

    


    $sentencia=$conexion->prepare("INSERT INTO `tbl_estudiantes` (`ID`, `Codigo`, `Dni`, `Nombres`, `Lugar`, `Edad`, `Num_Cel`, `Correo`,
      `Centro`) VALUES (NULL,:Codigo,:Dni,:Nombres,:Lugar,:Edad,:Num_Cel,:Correo,:Centro);");


        $sentencia->bindParam(":Codigo",$Codigo);
        $sentencia->bindParam(":Dni",$Dni);
        $sentencia->bindParam(":Nombres",$Nombres);
        $sentencia->bindParam(":Lugar",$Lugar);
        $sentencia->bindParam(":Edad",$Edad);
        $sentencia->bindParam(":Num_Cel",$Num_Cel);
        $sentencia->bindParam(":Correo",$Correo);
        $sentencia->bindParam(":Centro",$Centro);
        


        $sentencia->execute();
        
        $mensaje="Registro agregado con exito.";

    header("location:indexestudiante.php?mensaje=".$mensaje);
}

?>

<div class="modal fade" id="modalsestudiante" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
        <div class="modal-content" style="padding: 10px;">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloModal">Nuevo Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="post">
                <div class="modal-body">

                <div class="mb-3">
                        <label for="Codigo" class="form-label" style="font-size: 14px;">Codigo</label>
                        <input type="text" class="form-control" name="Codigo" id="Codigo" placeholder="Escribe su Codigo" required style="font-size: 14px; padding: 5px;">
                    </div>
                    <div class="mb-3">
                        <label for="Dni" class="form-label" style="font-size: 14px;">DNI</label>
                        <input type="text" class="form-control" name="Dni" id="Dni" placeholder="Escribe tu DNI" required style="font-size: 14px; padding: 5px;">
                    </div>

                    <div class="mb-3">
                        <label for="Nombres" class="form-label" style="font-size: 14px;">Nombres</label>
                        <input type="text" class="form-control" name="Nombres" id="Nombres" aria-describedby="helpId" placeholder="Nombres" style="font-size: 14px; padding: 5px;">
                    </div>

                    <div class="mb-3">
                        <label for="Lugar" class="form-label" style="font-size: 14px;">Lugar</label>
                        <input type="text" class="form-control" name="Lugar" id="Lugar" placeholder="Coloque el lugar" required style="font-size: 14px; padding: 5px;">
                    </div>

                    <div class="mb-3">
                        <label for="Edad" class="form-label" style="font-size: 14px;">Edad</label>
                        <input type="text" class="form-control" name="Edad" id="Edad" placeholder="Escribe tu Edad" required style="font-size: 14px; padding: 5px;">
                    </div>

                    <div class="mb-3">
                        <label for="Num_Cel" class="form-label" style="font-size: 14px;">Celular</label>
                        <input type="text" class="form-control" name="Num_Cel" id="Num_Cel" placeholder="Escribe tu número de celular" required style="font-size: 14px; padding: 5px;">
                    </div>

                    <div class="mb-3">
                        <label for="Correo" class="form-label" style="font-size: 14px;">Correo</label>
                        <input type="text" name="Correo" class="form-control" id="Correo" placeholder="Escribe tu correo electrónico" required style="font-size: 14px; padding: 5px;">
                    </div>

                    <div class="form-group">
                        <label for="Centro" class="form-label" style="font-size: 14px;">Centro</label>
                        <input type="text" name="Centro" class="form-control" id="Centro" placeholder="Centro educativo" required style="font-size: 14px; padding: 5px;">
                    </div>
                </div>

                <div class="modal-footer" style="padding: 10px;">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

