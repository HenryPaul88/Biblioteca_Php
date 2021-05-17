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
        <form action="registrarUsuario.php" method="POST">


            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Usuario: </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="usuario" style="border:solid blue" name="usuario" onblur="validarStringInside(this,4,150,usuarioError)">
                    </div>
                    <label class="obligatorio" id="usuarioError" for="usuario">
                        Se requiere un Usuario valido de mas de 4 caracteres </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Contraseña: </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="contraseña" style="border:solid blue" name="contraseña" onblur="validarClaveInside(this,contraseñaError)">
                    </div>
                    <label class="obligatorio" id="contraseñaError" for="contraseña">
                        Se requiero minimo 6 caractes, 1 letra nimuscula, 1 mayuscula y un numero </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Tipo:</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="tipo" style="border:solid blue" name="tipo" onblur="validarStringInside(this,2,150,tipoError)">
                    </div>
                    <label class="obligatorio" id="tipoError" for="tipo">
                        Se requiere un tipo valido de mas de 2 caracteres </label>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">DNI:</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="border:solid blue" name="dni" onblur="validarDocumentoIndise(this,dniError)" onkeyup="showHint(this.value)">
                    </div>
                    <label class="obligatorio" id="dniError" for="dni">Se requiere un dni valido </label><br>
                    
                </div>
            </div>
            <div><p>DNI: <span id="txtHint"></span></p></div>

            <script>
                function showHint(str) {
                    if (str.length == 0) {
                        document.getElementById("txtHint").innerHTML = "";
                        return;
                    } else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("txtHint").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", "registrarUsuario.php?dni=" + str, true);
                        xmlhttp.send();
                    }
                }
            </script>
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