<?php
session_start();
if (!isset($_SESSION["usuario"]))
    header("Location: index.php");
else {
    if ($_SESSION["tipo"] != "admin") {
        header("Location: index.php");
    }
}
?>

<?php
$id = $_GET["id"];
require 'conexion.php';

$stmt = $conn->prepare("SELECT ID, usu, pass, tipo, dni FROM usuario where ID=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$fila = $stmt->get_result()->fetch_assoc();

if ($fila) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="validar.js"></script>
        <link rel="stylesheet" href="estilos.css">
        <script src="funciones.js"></script>
        <title>formulario usuario</title>
    </head>

    <body>
        <div class="container">
            <div class="titulo">
                <h1> Alta Usuario </h1>
            </div>

            <?php echo "<form action='updateUsuario.php?id=" . $id . "'method='POST'>" ?>

            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Usuario: </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="usuario" style="border:solid blue" name="usuario" value="<?php echo $fila["usu"]; ?>">
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Contraseña: </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="contraseña" style="border:solid blue" name="contraseña" value="<?php echo $fila["pass"]; ?>">
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Tipo:</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="tipo" style="border:solid blue" name="tipo" value="<?php echo $fila["tipo"]; ?>">
                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">DNI:</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="dni" style="border:solid blue" name="dni" value="<?php echo $fila["dni"]; ?>">
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <input type="submit" value="Grabar" id="enviar" type="button" class="btn btn-primary">
                        </div>
                    </div>

                    </form>

                    <form class="form-inline" action="listadoUsuario.php">
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <input type="submit" value="Volver" id="enviar" type="button" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <! -- ultimo /div -->
        </div>


    </body>

    </html>
<?php
} else {
    echo "error en la base de datos";
}
?>