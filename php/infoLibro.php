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
            <form action="listadoLibros.php" method="POST">


                <div class="col-sm-6">
                    <div class="form-row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ISBN:</span>
                            </div>
                            <label class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue"><?php echo $fila["ISBN"]; ?></label>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Titulo:</span>
                            </div>
                            <label class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue"><?php echo $fila["titulo"]; ?></label>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Autor:</span>
                            </div>
                            <label class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue"><?php echo $fila["autor"]; ?></label>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Categorias: </span>
                        </div>
                        <?php
                        require 'conexion.php';
                        $stmt = $conn->prepare("SELECT descripcion FROM categoria where idCat=?");
                        $stmt->bind_param("s", $fila["categoria"]);
                        $stmt->execute();
                        $filaa = $stmt->get_result()->fetch_assoc();

                        ?>
                        <label class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue"><?php echo $filaa["descripcion"];  ?></label>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Editorial:</span>
                            </div>
                            <label class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue"><?php echo $fila["editorial"];  ?></label>
                        </div>

                    </div>
                </div>
                <h3>Resumen: </h3>
                <div class="input-group mb-3">
                    <textarea id="resumen" name="resumen" rows="4" cols="70" style="border:solid blue" disabled><?php echo $fila["resumen"]; ?></textarea>
                </div>


                <form class="form-inline" action="listadoLibros.php">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <input type="submit" value="Volver" id="enviar" type="button" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                <! -- ultimo /div -->
        </div>

    </body>

    </html>
<?php
} else {
    echo "error en la base de datos";
}
?>