<?php 
/*$url="src='http://localhost/Unidad3Dario/menuprincipal.php?login=".$_POST['login']."&usuario=".$_POST['usuario']."&contra=".$_POST['contra']."'";*/
$datosUsuario=explode("#",$_GET['resultado']);
$nombre=$datosUsuario[0];
$password=$datosUsuario[1];
$url="src='login.php'";
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<iframe <?php echo $url;?> style="margin:0; padding:0; height:630px; display:block; width:100%; border:none;"></iframe>
</body>
</html>