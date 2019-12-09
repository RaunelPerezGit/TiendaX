<?php 
//session_start()
//if ($_SESSION['tiendaxyz']==1) {
//	$db="tiendax";
//}else{
//	$db="tienday";
//}

function conectar(){
$host="localhost";
$user="root";
$db="tiendax";
$pwd="12345678";
$cnn=new mysqli($host,$user,$pwd,$db);
if ($cnn->connect_error) {
    echo $cnn->connect_error;
    exit();
}
	return $cnn;
}
$opcion=$_GET['opcion'];
$salida="";
switch ($opcion) {
	case 'Nuevo':
		$salida="<br/>".
					"<h2 align='center'>Nuevo Usuario</h2>".
					"<table class='table table-striped'  style='width: 40%;' align='center'>".
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
							"<td><input type='number' max-lenght='10' pattern='[0-9]'  name='telefono' class='form-control'/></td>".
						"</tr>".
						"<tr>".
							"<td><label>Login:</label></td>".
							"<td><input type='text' max-lenght='10'  required  name='login' class='form-control'/></td>".
						"</tr>".
						"<tr>".
							"<td><label>Password:</label></td>".
							"<td><input type='password' max-lenght='10' required  name='contrasenia' class='form-control'/></td>".
						"</tr>".
						"<tr>".
						"<td><label>Tienda:</label></td>".
						"<td><select class='form-control'  required  name='selecttienda' />".
						"<option value='1'>Tienda 1</option> <option value='2'>Tienda 2</option> </select></td>".
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
      		$login=$_GET['login'];
      		$contrasenia=$_GET['contrasenia'];
      		$status=1;
      		$tienda=$_GET['selecttienda'];
 //$prueba=$nombre."$".$appat."$".$apmat."$".$rfc."$".$correo."$".$direccion."$".$telefono."$".$login."$".$contrasenia."$".$status;
			$qry="INSERT INTO usuario values(null,'$nombre','$appat','$apmat','$rfc','$correo','$direccion','$telefono','$login','$contrasenia',$status,$tienda)";
			$ejec=$cnn->query($qry);
//header("Location:http://192.168.0.13/Unidad3Dario/proyectoVacaciones/menuprincipal.php?resultadoClientes=".$salida);//AQUI VA A IR LA IP DE LA MAQUINA QUE ESTA EN LINUX
			$salida="registro con exito!!";
	break;

	case 'Detalles':
	$renglon=$_GET['renglon'];
	 for ($j=0; $j<$_COOKIE['cookietamanio4'] ; $j++) {
  		$dato=explode("$", $_COOKIE['cookieUsuario'.$j]);
 		 if($dato[0]==$renglon){
	$salida="<br/>".
					"<h2 align='center'>DETALLES USUARIO </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[1]."' name='nombre' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Paterno:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[2]."'  name='appat'/></td>".
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
							"<td><label>Login:</label></td>".
							"<td><input type='text' name='login' readonly  class='form-control'value='".$dato[8]."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Password:</label></td>".
							"<td><input type='text' name='contrasenia' readonly  class='form-control'value='".$dato[9]."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Status:</label></td>";
							$valor;
							if($dato[10]==1){
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
	$qry="SELECT * FROM  usuario where cve_usu=$renglon";
	$consul= $cnn->query($qry);
	$ren=$consul->fetch_array(MYSQL_ASSOC);
	$salida="<br/>".
					"<h2 align='center'>MODIFICAR USUARIO </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center' >".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['nombre_usu']."' name='nombre' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Paterno:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['paterno_usu']."'name='appat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Apellido Materno:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['materno_usu']."' name='apmat' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>RFC:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['rfc_usu']."' name='rfc' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Email:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['mail_usu']."' name='correo' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Dirección:</label></td>".
							"<td><input type='text' name='direccion'  class='form-control'value='".$ren['direccion_usu']."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Teléfono:</label></td>".
							"<td><input type='number' max-lenght='10' pattern='[0-9]'  value='".$ren['tel_usu']."' name='telefono' class='form-control'/></td>".
						"</tr>".
						"<tr>".
							"<td><label>Login:</label></td>".
							"<td><input type='text' name='login'  class='form-control'value='".$ren['login_usu']."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Password:</label></td>".
							"<td><input type='text' name='contrasenia'  class='form-control'value='".$ren['pass_usu']."' /></td>".
						"</tr>";
							if($ren['status_usu']==1){
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
					"<input type='hidden' name='clave' value='".$ren['cve_usu']."' >";
                    
	
	
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
      		$login=$_GET['login'];
      		$contrasenia=$_GET['contrasenia'];
      		$status=$_GET['status'];

	$qry="UPDATE usuario SET nombre_usu='$nombre',paterno_usu='$appat',materno_usu='$apmat',rfc_usu='$rfc',mail_usu='$correo',direccion_usu='$direccion',tel_usu='$telefono',login_usu='$login',pass_usu='$contrasenia',status_usu=$status where cve_usu=$ide";
	$consul=$cnn->query($qry);
			$salida="registro modificado con  exito!!";
	break;

	case 'Eliminar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE usuario SET status_usu=0 where cve_usu=$ide";
			$consul=$cnn->query($qry);
			$salida="eliminacion logica con  exito!!";

	break;

	case 'Activar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE usuario SET status_usu=1 where cve_usu=$ide";
			$consul=$cnn->query($qry);
			$salida="Activacion logica con  exito!!";

	break;

	default:
		$salida="Adios mundo cruelxyz";
		break;
}
header("Location:menuprincipal.php?resultadoUsuarios=".$salida);
?>

