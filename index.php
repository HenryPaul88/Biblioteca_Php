<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="estilos.css">
    <title>Iniciar Sesion</title>
</head>
<body>
    
<div class="container">
        <div class="titulo">
            <h1> Inicio Sesion </h1>
        </div>
        <form action="validarUsuario.php" method="POST">


            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Usuario: </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="usuario" style="border:solid blue" 
                        name="usuario">
                    </div>
                    <label class="obligatorio" id="usuarioError" for="usuario">
                        usuario no encontrado </label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Contraseña: </span>
                        </div>
                        <input type="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="contraseña" style="border:solid blue" name="contraseña">
                    </div>
                    <label class="obligatorio" id="contraseñaError" for="contraseña">
                        contraseña erronea</label>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <input type="submit" value="Entrar" id="enviar" type="button" class="btn btn-primary">
                </div>
            </div>
        </form>
        <! -- ultimo /div -->
    </div>

</body>
</html>