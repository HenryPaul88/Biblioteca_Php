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
    <title>Biblioteca</title>
</head>

<body>



    <div class="container">
        <div class="titulo">
            <h1> Alta Libros </h1>
        </div>
        <form action="altaLibro.php" method="POST">


            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">ISBN:</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="ISBN" style="border:solid blue" onblur="validarISBNInside(this,ISBNError)" name="ISBN">
                    </div>
                    <label class="obligatorio" id="ISBNError" for="ISBN">
                        Se requiere un ISBN valido </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Titulo:</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="titulo" style="border:solid blue" onblur="validarStringInside(this,2,150,tituloError)" name="titulo">
                    </div>
                    <label class="obligatorio" id="tituloError" for="titulo">
                        Se requiere un Titulo valido de mas de 2 caracteres</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Autor:</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="autor" style="border:solid blue" onblur="validarStringInside(this,2,150,autorError)" name="autor">
                    </div>
                    <label class="obligatorio" id="autorError" for="autor">
                        Se requiere un Autor valido de mas de 2 caracteres </label>
                </div>
            </div>
            <?php
            require 'conexion.php';

            ?>
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
                            while ($fila = $result->fetch_assoc()) {
                                echo "<option ' value=" . $fila["idCat"] . ">" . $fila["descripcion"] . "</option>";
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
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="editorial" style="border:solid blue" onblur="validarStringInside(this,2,150,editorialError)" name="editorial">
                    </div>
                    <label class="obligatorio" id="editorialError" for="editorial">
                        Se requiere un Editorial valido de mas de 2 caracteres </label>
                </div>
            </div>
            <h3>Resumen: </h3>
            <div class="input-group mb-3">
                <textarea id="resumen" name="resumen" rows="4" cols="70" style="border:solid blue"></textarea>
            </div>

            <div class="col-sm-6">
            <div class="form-row">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <input type="submit" value="Grabar"  class="btn btn-primary">
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


    <! -- ultimo /div -->
        </div>

</body>

</html>