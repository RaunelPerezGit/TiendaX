
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body >
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div style="margin-top:100px; width: 300px; height: 400px; text-align: center;border-radius: 50px; font-size: 20px;">
                  <!-- <form action="http://192.168.0.12/Unidad3Dario/proyectoVacaciones/datos.php" method="GET">--> <!-- aqui va la direccion ip de l otra maquina -->
                    <form action="datos.php" method="GET">
                        <label style="margin-top:40px">Ingrese la cuenta de usuario: </label>
                        <input type="text" name="usuario" class="form-control">
                        <label>Ingrese la contraseña: </label>
                        <input type="password" name="password" class="form-control">
                        <br>
                        <br>
                        <input type="submit" class="btn btn-light" name="opcion" value="Iniciar Sesion">
                   </form>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>
</html>