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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php
        $id = $_GET["id"];
        echo "Deseas eliminar usuario ";
        echo "$id";



        echo " <div class='col-sm-6'>
        <div class='form-row'> <form action='deleteUsu.php?id=" . $id . "'method='POST'>
            <div class='col-sm-4'>
                <div class='input-group mb-3'>
                    <input type='submit' class='btn btn-primary' value='Si' >
                </div>
            </div>
       </form>";


        ?>
        <form action="listadoUsuario.php">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <input type="submit" value="No" id="enviar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>

</html>