<?php 
//$db="";
//if ($_SESSION['tiendaxyz']==1) {
//	$db="tiendax";
//}else{
//	$db="tienday";
//}
function conectar(){
$host="localhost";
$user="root";
$pwd="12345678";
$db="tiendax";
$cnn=new mysqli($host,$user,$pwd,$db);
if ($cnn->connect_error) {
    echo $cnn->connect_error;
    exit();
}
	return $cnn;
}
$opcion=$_GET['opcion'];
$opc=$_POST['opcionmenu'];
$salida="";
switch ($opcion) {
	case 'Nuevo':
		$salida="<br/>".
					"<h2>Nuevo Cliente</h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text' required  name='nombre' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Paterno:</label></td>".
							"<td><input class='form-control' type='text' required  name='appat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Materno:</label></td>".
							"<td><input class='form-control' type='text' required  name='apmat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>RFC:</label></td>".
							"<td><input class='form-control' type='text' required  name='rfc' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Email:</label></td>".
							"<td><input class='form-control' type='text' required  name='correo' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Dirección:</label></td>".
							"<td><input type='text' name='direccion'required  class='form-control' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Teléfono:</label></td>".
							"<td><input type='number' max-lenght='10' pattern='[0-9]' required  name='telefono' class='form-control'/></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Guardar' /></td>".
						"</tr>".
					"</table>";

		break;

	case 'Guardar':
      		$cnn=conectar();
      		$nombre=$_GET['nombre'];
      		$appat=$_GET['appat'];
      		$apmat=$_GET['apmat'];
      		$rfc=$_GET['rfc'];
      		$correo=$_GET['correo'];
      		$direccion=$_GET['direccion'];
      		$telefono=$_GET['telefono'];
      		$status=1;
//$prueba=$nombre."$".$appat."$".$apmat."$".$rfc."$".$correo."$".$direccion."$".$telefono."$".$status;
			$qry="INSERT INTO cliente values(null,'$nombre','$appat','$apmat','$rfc','$correo','$direccion','$telefono',$status)";
			$ejec=$cnn->query($qry);
//header("Location:http://192.168.0.13/Unidad3Dario/proyectoVacaciones/menuprincipal.php?resultadoClientes=".$salida);//AQUI VA A IR LA IP DE LA MAQUINA QUE ESTA EN LINUX
			$salida="registro con exito!!";
	break;

	case 'Detalles':
	$renglon=$_GET['renglon'];
	 for ($j=0; $j<$_COOKIE['cookietamanio'] ; $j++) {
  		$dato=explode("$", $_COOKIE['cookieClientes'.$j]);
 		 if($dato[0]==$renglon){
	$salida="<br/>".
					"<h2 align='center'>DETALLES CLIENTE </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center' >".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[1]."' name='nombre' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Paterno:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[2]."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Materno:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[3]."' name='apmat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>RFC:</label></td>".
							"<td><input class='form-control' type='text' readonly  value='".$dato[4]."' name='rfc' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Email:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[5]."' name='correo' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Dirección:</label></td>".
							"<td><input type='text' name='direccion'readonly  class='form-control'value='".$dato[6]."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Teléfono:</label></td>".
							"<td><input type='number' max-lenght='10' pattern='[0-9]' readonly value='".$dato[7]."' name='telefono' class='form-control'/></td>".
						"</tr>".
						"<tr>".
							"<td><label>Status:</label></td>";
							$valor;
							if($dato[8]==1){
								$valor='Activo';
							}else{
								$valor='Inactivo';
							}
							$salida.="<td><input type='text' name='status' readonly='readonly' value='".$valor."' class='form-control'/></td>".
						"</tr>".
					"</table>";
				}
			}
	 
	break;
	case 'Modificar':
		$renglon=$_GET['renglon'];
	$cnn=conectar();
	$qry="SELECT * FROM cliente where cve_cli=$renglon";
	$consul= $cnn->query($qry);
	$ren=$consul->fetch_array(MYSQL_ASSOC);
	$salida="<br/>".
					"<h2 align='center'>MODIFICAR CLIENTE </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center' >".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['nombre_cli']."' name='nombre' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Paterno:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['paterno_cli']."'name='appat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Materno:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['materno_cli']."' name='apmat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>RFC:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['rfc_cli']."' name='rfc' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Email:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['mail_cli']."' name='correo' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Dirección:</label></td>".
							"<td><input type='text' name='direccion'  class='form-control'value='".$ren['direccion_cli']."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Teléfono:</label></td>".
							"<td><input type='number' max-lenght='10' pattern='[0-9]'  value='".$ren['tel_cli']."' name='telefono' class='form-control'/></td>".
						"</tr>";
							if($ren['status_cli']==1){
								$salida.="<tr>".
								"<td><label>Status:</label></td>".
								"<td>Activo<input type='radio' name='status' value='1' checked=''/>Inactivo<input type='radio'  name='status' value='0' /></td>".
								"</tr>";
							}else{
								$salida.="<tr>".
								"<td><label>Status:</label></td>".
								"<td>Activo<input type='radio' name='status' value='1'/>Inactivo<input type='radio' checked='' name='status' value='0' /></td>".
								"</tr>";
							}
						$salida.="<tr>".
							"<td colspan='2'><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Guardar Cambios' /></td>".
						"</tr>".
					"</table><br/>".
					"<input type='hidden' name='clave' value='".$ren['cve_cli']."' >";
                    
	
	
	break;

	case 'Guardar Cambios':
	$ide=$_GET['clave'];
	$cnn=conectar();
	$nombre=$_GET['nombre'];
      		$appat=$_GET['appat'];
      		$apmat=$_GET['apmat'];
      		$rfc=$_GET['rfc'];
      		$correo=$_GET['correo'];
      		$direccion=$_GET['direccion'];
      		$telefono=$_GET['telefono'];
      		$status=$_GET['status'];

	$qry="UPDATE cliente SET nombre_cli='$nombre',paterno_cli='$appat',materno_cli='$apmat',rfc_cli='$rfc',mail_cli='$correo',direccion_cli='$direccion',tel_cli='$telefono',status_cli=$status where cve_cli=$ide";
	$consul=$cnn->query($qry);
			$salida="registro modificado con  exito!!";
	break;

	case 'Eliminar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE cliente SET status_cli=0 where cve_cli=$ide";
			$consul=$cnn->query($qry);
			$salida="eliminacion logica con  exito!!";

	break;


	case 'Activar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE cliente SET status_cli=1 where cve_cli=$ide";
			$consul=$cnn->query($qry);
			$salida="Activacion logica con  exito!!";

	break;
	default:
		$salida="Adios mundo cruelxyz";
		break;
}
//header("Location:http://192.168.0.13/Unidad3Dario/proyectoVacaciones/menuprincipal.php?resultadoClientes=".$salida);
header("Location:menuprincipal.php?resultadoClientes=".$salida);
?>

