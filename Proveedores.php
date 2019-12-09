<?php 
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
					"<h2 align='center'>Nuevo Proveedor</h2>".
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
							"<td colspan=''partero_prov''><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Guardar' /></td>".
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
			$qry="INSERT INTO proveedor values(null,'$nombre','$appat','$apmat','$rfc','$correo','$direccion','$telefono',$status)";
			$ejec=$cnn->query($qry);
			$salida="registro con exito!!";
	break;

	case 'Detalles':
		$renglon=$_GET['renglon'];
	 for ($j=0; $j<$_COOKIE['cookietamanio2'] ; $j++) {
  		$dato=explode("$", $_COOKIE['cookieProveedor'.$j]);
 		 if($dato[0]==$renglon){
	$salida="<br/>".
					"<h2 align='center'>DETALLES PROVEEDOR </h2>".
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
	$qry="SELECT * FROM proveedor where cve_prov=$renglon";
	$consul= $cnn->query($qry);
	$ren=$consul->fetch_array(MYSQL_ASSOC);
	$salida="<br/>".
					"<h2 align='center'>MODIFICAR CLIENTE </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center' >".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['nombre_prov']."' name='nombre' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Paterno:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['paterno_prov']."' name='appat'/></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Materno:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['materno_prov']."' name='apmat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>RFC:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['rfc_prov']."' name='rfc' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Email:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['mail_prov']."' name='correo' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Dirección:</label></td>".
							"<td><input type='text' name='direccion'  class='form-control'value='".$ren['direccion_prov']."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Teléfono:</label></td>".
							"<td><input type='number' max-lenght='10' pattern='[0-9]'  value='".$ren['tel_prov']."' name='telefono' class='form-control'/></td>".
						"</tr>";
							if($ren['status_prov']==1){
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
					"<input type='hidden' name='clave' value='".$ren['cve_prov']."' >";
		
	
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

	$qry="UPDATE proveedor SET nombre_prov='$nombre',paterno_prov='$appat',materno_prov='$apmat',rfc_prov='$rfc',mail_prov='$correo',direccion_prov='$direccion',tel_prov='$telefono',status_prov=$status where cve_prov=$ide";
	$consul=$cnn->query($qry);
			$salida="registro modificado con  exito!!";
	break;

	case 'Eliminar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE proveedor SET status_prov=0 where cve_prov=$ide";
			$consul=$cnn->query($qry);
			$salida="eliminacion logica con  exito!!";

	break;
	case 'Activar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE proveedor SET status_prov=1 where cve_prov=$ide";
			$consul=$cnn->query($qry);
			$salida="Activacion logica con  exito!!";

	break;

	default:
		$salida="Adios mundo cruelxyz";
		break;
}
header("Location:menuprincipal.php?resultadoProveedores=".$salida);
?>

