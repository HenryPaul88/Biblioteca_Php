<?php

session_start();
if(!isset($_SESSION["usuario"]))
    header("Location: index.php");

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
    <title>Listado Libros</title>
</head>

<body>
    <div class="container">
        <div class="titulo">

            <h1>Listado de Libros</h1>
        </div>
    </div>
    <div class="container-fluid">

        <form class="form-inline" action="listadoLibros.php">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="buscar" style="border:solid blue" name="buscar" placeholder="Buscar">
                    <input type="submit" id="crearFila" type="button" class="btn btn-primary">
                </div>
            </div>
        </form>

        <table class="table" border="1">
            <tr class="table-primary">
                <th scope="col"> ID
                    <a href="listadoLibros.php?order=ID&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoLibros.php?order=ID&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> ISBN
                    <a href="listadoLibros.php?order=ISBN&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoLibros.php?order=ISBN&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Titulo
                    <a href="listadoLibros.php?order=titulo&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoLibros.php?order=titulo&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Autor
                    <a href="listadoLibros.php?order=autor&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoLibros.php?order=autor&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Categoria
                    <a href="listadoLibros.php?order=ID&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoLibros.php?order=ID&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Editorial
                    <a href="listadoLibros.php?order=ID&esp=desc" role="button"><i class="fa fa-arrow-down" style="font-size: 16px;"></i></a>
                    <a href="listadoLibros.php?order=ID&esp=asc" role="button"><i class="fa fa-arrow-up" style="font-size: 16px;"></i></a>
                </th>
                <th scope="col"> Resumen </th>
                <th scope="col"> Info </th>
                <?php if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="admin"){ ?>
                <th scope="col"> Modificar </th>
                <th scope="col"> Borrar </th>
                <?php } ?>
            </tr>
            <tbody>
                <?php

                
                require 'conexion.php';

                if (isset($_GET["order"]) && isset($_GET["esp"])) {
                    $sql = "SELECT ID, ISBN, titulo, autor, categoria, editorial, resumen FROM libros order by " . $_GET["order"] . " " . $_GET["esp"] . "";
                } elseif (isset($_GET["buscar"])) {
                    $sql = "SELECT ID, ISBN, titulo, autor, categoria, editorial, resumen FROM libros where titulo like '%" . $_GET["buscar"] . "%' OR autor like '%" . $_GET["buscar"] . "%'";
                } else {
                    $sql = "SELECT ID, ISBN, titulo, autor, categoria, editorial, resumen FROM libros ";
                }

                
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($fila = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $fila["ID"] . "</th>";

                        $idC = $fila["categoria"];
                        $stmt = $conn->prepare("SELECT descripcion FROM categoria where idCat=?");
                        $stmt->bind_param("s", $idC);
                        $stmt->execute();

                        $filaC = $stmt->get_result()->fetch_assoc();
                        if ($filaC) {
                            $descripcion = $filaC["descripcion"];
                        } else {
                            echo "error en la busqueda";
                            echo ("error descripcion: " . $conn->error);
                        }


                        echo "<td>" . $fila["ISBN"] . "</td>";
                        echo "<td>" . $fila["titulo"] . "</td>";
                        echo "<td>" . $fila["autor"] . "</td>";
                        echo "<td>" . $descripcion . "</td>";
                        echo "<td>" . $fila["editorial"] . "</td>";
                        echo "<td>" . $fila["resumen"] . "</td>";

                        echo "<td> <form action='infoLibro.php?id=" . $fila["ID"] . "'method='POST'>
                                <button type='submit' class='btn btn-primary'><i class='fas fa-info-circle'></i></button> 
                                </form>
                            </td>";

                        if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="admin"){

                        echo "<td> <form action='modificarLibro.php?id=" . $fila["ID"] . "'method='POST'>
                            <button type='submit' class='btn btn-primary'><i class='fas fa-edit'></i></button> 
                            </form>
                        </td>";                     

                        echo "<td> <form action='borrarLibro.php?id=" . $fila["ID"] . "'method='POST'>
                                <button type='submit' class='btn btn-primary'><i class='fas fa-trash-alt'></i></button> 
                                </form>
                            </td>";
                        }

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
        <?php if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="admin"){ ?>
        <form class="form-inline" action="FormularioAltalibro.php">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <input type="submit" value="Alta Libro" id="enviar" type="button" class="btn btn-primary">
                </div>
            </div>
        </form>

        <form class="form-inline" action="listadoUsuario.php">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <input type="submit" value="Gestion Usuario" id="enviar" type="button" class="btn btn-primary">
                </div>
            </div>
        </form>
        <?php } ?>

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