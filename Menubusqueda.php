<!DOCTYPE html>
<html>
<head>
	<title>Reportes</title>
</head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<body>
    <br>
<div class="row col-sm-12">

<form method="GET" action="reportesTienda2.php" style="margin-top: 0px;">
        <div class="row col-sm-offset-4 col-sm-3">
            <input type="submit" name="opci" value="Inventario" class="btn btn-primary"   >
        </div>        
    </form>
<form method="GET" action="reportesVentas.php" style="margin-top: 0px;">
        <div class="row  col-sm-3">
            <input type="submit" name="opci" value="Ventas" class="btn btn-primary"   >
        </div>
        <br/>         
    </form>
</div>
 <?php
    if (isset($_GET['resultadoTienda'])) {
        ?>
        <form method="GET" action="reportesTienda2.php">
       <?php
       echo $_GET['resultadoTienda'];
       ?>
        </form>
            <?php
         }
      ?>

       <?php
    if (isset($_GET['resultadoVentas'])) {
        ?>
        <form method="GET" action="reportesVentas.php">
       <?php
       echo $_GET['resultadoVentas'];
       ?>
        </form>
            <?php
         }
      ?>
</body>
</html>