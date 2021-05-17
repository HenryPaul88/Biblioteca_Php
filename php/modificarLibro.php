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

$stmt = $conn->prepare("SELECT ID, ISBN, titulo, autor, categoria, editorial, resumen FROM libros where ID=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$fila = $stmt->get_result()->fetch_assoc();

if ($fila) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="validar.js"></script>
        <link rel="stylesheet" href="estilos.css">
        <script src="funciones.js"></script>
        <title>Informacion Libro</title>
    </head>

    <body>



        <div class="container">
            <div class="titulo">
                <h1> Informacion Libro </h1>
            </div>
            <?php echo " <form action='updateLibros.php?id=" . $id . "'method='POST'>" ?>

            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">ISBN:</span>
                        </div>
                        <input name="ISBN" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue" value="<?php echo $fila["ISBN"]; ?>">
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Titulo:</span>
                        </div>
                        <input name="titulo" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue" value="<?php echo $fila["titulo"]; ?>">
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Autor:</span>
                        </div>
                        <input name="autor" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue" value="<?php echo $fila["autor"]; ?>">
                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Categorias: </span>
                    </div>
                    <select name="descripcion" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="especialidades" style="border:solid blue">
                        <?php
                        require 'conexion.php';
                        $sql = "SELECT idCat, descripcion FROM categoria";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($filaa = $result->fetch_assoc()) {
                                echo "<option ' value=" . $filaa["idCat"] . ">" . $filaa["descripcion"] . "</option>";
                            }
                        } else {
                            echo "0 Libros";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Editorial:</span>
                        </div>
                        <input name="editorial" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue" value="<?php echo $fila["editorial"]; ?>">
                    </div>

                </div>
            </div>
            <h3>Resumen: </h3>
            <div class="input-group mb-3">
                <textarea id="resumen" name="resumen" rows="4" cols="70" style="border:solid blue"><?php echo $fila["resumen"]; ?></textarea>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <input type="submit" value="Grabar" id="enviar" type="button" class="btn btn-primary">
                        </div>
                    </div>
                    </form>

                    <form class="form-inline" action="listadoLibros.php">
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