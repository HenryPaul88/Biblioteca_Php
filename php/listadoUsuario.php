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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <title>Listado Usuarios</title>
</head>

<body>
    <div class="container">
        <div class="titulo">

            <h1>Listado de Usuario</h1>
        </div>
    </div>
    <div class="container-fluid">

        <form class="form-inline" action="listadoUsuario.php">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="buscar" style="border:solid blue" name="buscar" placeholder="Buscar">
                    <input type="submit" id="enviarBuscar" type="button" class="btn btn-primary">
                </div>
            </div>
        </form>

        <table class="table" border="1">
            <tr class="table-primary">
                <th scope="col"> ID
                    <a href="listadoUsuario.php?order=ID&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoUsuario.php?order=ID&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Usuario
                    <a href="listadoUsuario.php?order=usu&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoUsuario.php?order=usu&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Contraseña
                    <a href="listadoUsuario.php?order=pass&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoUsuario.php?order=pass&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Tipo
                    <a href="listadoUsuario.php?order=tipo&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoUsuario.php?order=tipo&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> DNI
                    <a href="listadoUsuario.php?order=dni&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoUsuario.php?order=dni&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Modificar </th>
                <th scope="col"> Borrar </th>
            </tr>
            <tbody>
                <?php
                require 'conexion.php';

                if (isset($_GET["order"]) && isset($_GET["esp"])) {
                    $sql = "SELECT ID, usu, pass, tipo, dni FROM usuario order by " . $_GET["order"] . " " . $_GET["esp"] . "";
                } elseif (isset($_GET["buscar"])) {
                    $sql = "SELECT ID, usu, pass, tipo, dni FROM usuario where usu like '%" . $_GET["buscar"] . "%' OR tipo like '%" . $_GET["buscar"] . "%'";
                } else {
                    $sql = "SELECT ID, usu, pass, tipo, dni FROM usuario ";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($fila = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $fila["ID"] . "</th>";
                        echo "<td>" . $fila["usu"] . "</td>";
                        echo "<td>" . $fila["pass"] . "</td>";
                        echo "<td>" . $fila["tipo"] . "</td>";
                        echo "<td>" . $fila["dni"] . "</td>";

                        echo "<td> <form action='modificarUsuario.php?id=" . $fila["ID"] . "'method='POST'>
                    <button type='submit' class='btn btn-primary'><i class='fas fa-edit'></i></button> 
                    </form>
                </td>";
                        echo "<td> <form action='borrarUsuario.php?id=" . $fila["ID"] . "'method='POST'>
                        <button type='submit' class='btn btn-primary'><i class='fas fa-trash-alt'></i></button> 
                        </form>
                    </td>";

                        echo "</tr>";
                    }
                } else {
                    echo "0 Libros";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="col-sm-6">
            <div class="form-row">
                <form class="form-inline" action="formularioAltaUsuario.php">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <input type="submit" value="Alta Usuario" id="enviar" type="button" class="btn btn-primary">
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
                <form class="form-inline" action="cerrarSesion.php">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <input type="submit" value="Salir" id="enviar" type="button" class="btn btn-danger">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>