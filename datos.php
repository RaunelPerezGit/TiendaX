<?php 
$cnnx="";
$usuario="";
$datosUsuarios="";
$datosClientes="";
$datosProductos="";
$datosProveedor="";

function conectar(){
$host="localhost";
$user="root";
$pwd="12345678";
$db="tiendax";
$cnn1=new mysqli($host,$user,$pwd,$db);
if ($cnn1->connect_error) {
    echo $cnn1->connect_error;
    exit();
}
	return $cnn1;
}



$opcion=$_GET['opcion'];
$salida="";
$datos="";
$tienda=0;
switch ($opcion) {
	case 'Iniciar Sesion':
		$cnnx=conectar();

		$qry="select * from usuario where login_usu='".$_GET['usuario']."' and pass_usu='".$_GET['password']."'";
		$consul=$cnnx->query($qry);
		$i=0;
		while($ren=$consul->fetch_array(MYSQL_ASSOC)){
			$i++;
		}

		if($i>0){//i funciona como bandera si es mayor que 0, significa que si encontro algun registro en la BDD1 
			header("Location:conexionBDD.php?opcion=".$_GET['opcion']."&usuario=".$_GET['usuario']."&password=".$_GET['password']);
		}else{
			//No encontro en la BDD1 asi que haremos una petición a la BDD2
			header("Location:conexionBDD2.php?opcion=".$_GET['opcion']."&usuario=".$_GET['usuario']."&password=".$_GET['password']);
		}
	}

?>