<?php 
include("bd.php");

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";


    $sentencia=$conexion->prepare(" SELECT * FROM tbl_estudiantes WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $Codigo=$registro["Codigo"];
    $Dni=$registro["Dni"];
    $Nombres=$registro["Nombres"];
    $Lugar=$registro["Lugar"];
    $Edad=$registro["Edad"];
    $Num_Cel=$registro["Num_Cel"];
    $Correo=$registro["Correo"];
    $Centro=$registro["Centro"];

    



}
if($_POST){

    //Recepcionando los valores del formulario.
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $Codigo=(isset($_POST['Codigo']))?$_POST['Codigo']:"";
    $Dni=(isset($_POST['Dni']))?$_POST['Dni']:"";
    $Nombres=(isset($_POST['Nombres']))?$_POST['Nombres']:""; 
    $Lugar=(isset($_POST['Lugar']))?$_POST['Lugar']:""; 
    $Edad=(isset($_POST['Edad']))?$_POST['Edad']:"";
    $Num_Cel=(isset($_POST['Num_Cel']))?$_POST['Num_Cel']:"";
    $Correo=(isset($_POST['Correo']))?$_POST['Correo']:"";
    $Centro=(isset($_POST['Centro']))?$_POST['Centro']:"";


    $sentencia=$conexion->prepare("UPDATE tbl_estudiantes 
    SET 
    Codigo=:Codigo,
    Dni=:Dni,
    Nombres=:Nombres,
    Lugar=:Lugar,
    Edad=:Edad,
    Num_Cel=:Num_Cel,
    Correo=:Correo,
    Centro=:Centro

    WHERE id=:id ");

$sentencia->bindParam(":Codigo",$Codigo);
$sentencia->bindParam(":Dni",$Dni);
$sentencia->bindParam(":Nombres",$Nombres);
$sentencia->bindParam(":Lugar",$Lugar);
$sentencia->bindParam(":Edad",$Edad);
$sentencia->bindParam(":Num_Cel",$Num_Cel);
$sentencia->bindParam(":Correo",$Correo);
$sentencia->bindParam(":Centro",$Centro);
$sentencia->bindParam(":id",$txtID);
$sentencia->execute();

$mensaje="Registro modificado con exito.";

    header("location:indexestudiante.php?mensaje=".$mensaje);


}

include("templates/header.php"); ?>

<div>
<main class="app-content">
    <div class="wrapp">
        <div>
            <h1><i class="fa fa-dashboard"></i> Editar Estudiante</h1>
        </div>
           
        <form action="" method="post">
            <label for="Codigo" class="form-label">ID</label>
            <input type="text" 
                class="form-control"
                readonly
                 value="<?php echo $txtID;?>" 
                name="txtID" id="txtID" aria-describedby="helpId"placeholder="Nombres">   
            </div>


            <div class="mb-3">
            <label for="Codigo" class="form-label">Codigo</label>
            <input type="text" 
                class="form-control" value="<?php echo $Codigo;?>" name="Codigo" id="Codigo" aria-describedby="helpId"placeholder="Nombres">   
            </div>

            <div class="mb-3">
            <label for="Dni" class="form-label">DNI</label>
            <input type="text"
             class="form-control" value="<?php echo $Dni;?>" name="Dni"id="Dni" placeholder="Escribe tu DNI" required>
            </div>

            <div class="mb-3">
            <label for="Nombres" class="form-label">Nombres</label>
            <input type="text" 
                class="form-control" value="<?php echo $Nombres;?>" name="Nombres" id="Nombres" aria-describedby="helpId"placeholder="Nombres">   
            </div>


            <div class="mb-3">
            <label for="Lugar" class="form-label">Lugar</label>
            <input type="text" 
                class="form-control" value="<?php echo $Lugar;?>" name="Lugar" id="Lugar" aria-describedby="helpId"placeholder="Lugar">   
            </div>

            <div class="mb-3">
            <label for="Edad" class="form-label">Edad</label>
            <input type="text" 
                class="form-control" value="<?php echo $Edad;?>" name="Edad" id="Edad" aria-describedby="helpId"placeholder="Edad">   
            </div>


        <div class="mb-3">
            <label for="Num_cel" class="form-label">Celular</label>
            <input type="text"
             class="form-control" value="<?php echo $Num_Cel;?>" name="Num_Cel"id="Num_Cel" placeholder="Escribe tu numero" required>
        </div>
        
        <div class="mb-3">
            <label for="Correo" class="form-label">Correo</label>
            <input type="email"
            class="form-control" value="<?php echo $Correo;?>" name="Correo" id="Correo" placeholder="Escribe tu correo electrónico" required>
        </div>

        <div class="mb-3">
                <label for="Centro" class="form-label">Centro</label>
                <input type="text" 
                class="form-control" value="<?php echo $Centro;?>" name="Centro" id="Centro" aria-describedby="helpId"placeholder="Edad">   
        </div>
            
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a name="" id="" class="btn btn-primary" href="indexestudiante.php" role="button">Cancelar</a>

            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>