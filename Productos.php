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
					"<h2 align='center'>Nuevo Producto</h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Clave:</label></td>".
							"<td><input class='form-control' type='text' required  name='clave' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Nombre :</label></td>".
							"<td><input class='form-control' type='text' required  name='nombre' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Precio U:</label></td>".
							"<td><input class='form-control' type='text' required name='precio' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Unidad de Medida:</label></td>".
							"<td><input class='form-control' type='text' required  name='umd' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>";
							"<td><select class='form-control'  required  name='selectproveedor' />";
							$cnn=conectar();
							$qry="SELECT * FROM proveedor";
							$consul=$cnn->query($qry);
							while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
								$salida.="<option value='".$ren[0]."'>".$ren[1]."</option>";
							}
							$salida.="</select>".
							"</td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Guardar' /></td>".
						"</tr>".
					"</table>";

		break;

	case 'Guardar':
      		$cnn=conectar();
      		$clave=$_GET['clave'];
      		$nombre=$_GET['nombre'];
      		$precio=$_GET['precio'];
      		$umd=$_GET['umd'];
      		$selectproveedor=$_GET['selectproveedor'];
      		$status=1;
			$qry="INSERT INTO producto values('$clave','$nombre',$precio,'$umd',$status,$selectproveedor)";
			$ejec=$cnn->query($qry);
			$salida="registro con exito!!";
	break;

	case 'Detalles':
	$renglon=$_GET['renglon'];
		$renglon=$_GET['renglon'];
	 for ($j=0; $j<$_COOKIE['cookietamanio3'] ; $j++) {
  		$dato=explode("$", $_COOKIE['cookieProductos'.$j]);
 		 if($dato[0]==$renglon){
	$salida="<br/>".
					"<h2 align='center'>DETALLES PRODUCTO </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center' >".
						"<tr>".
							"<td><label>Clave:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[0]."' name='clave' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[1]."' name='nombre'/></td>".
						"</tr>".
						"<tr>".
							"<td><label>Precio Unidad:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$dato[2]."' name='precio' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Unidad de medida:</label></td>".
							"<td><input class='form-control' type='text' readonly  value='".$dato[3]."' name='umd' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Status:</label></td>";
							$valor;
							if($dato[5]==1){
								$valor='Activo';
							}else{
								$valor='Inactivo';
							}
							$salida.="<td><input type='text' name='status' readonly='readonly' value='".$valor."' class='form-control'/></td>".
						"</tr>";
						for ($i=0; $i<$_COOKIE['cookietamanio2'] ; $i++) {
						$dato1=explode("$", $_COOKIE['cookieProveedor'.$i]);
 		 				if($dato1[0]==$dato[6]){
 		 					$nom=$dato1[1];
 		 				}
 		 			}
						$salida.="<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$nom."' name='proveedor' /></td>".
						"</tr>".
					"</table>";	
					}
				} 
	break;
	case 'Modificar':
	$renglon=$_GET['renglon'];
	$cnn=conectar();
	$qry="SELECT cve_prod,desc_prod,pu_prod,umed_prod,status_prod,nombre_prov from producto join proveedor on producto.cve_prov=proveedor.cve_prov where producto.cve_prod='$renglon'";//NO SE SI VA ENTRE COMILLAS EL VALOR DE RENGLON
	$consul= $cnn->query($qry);
	$ren=$consul->fetch_array(MYSQL_ASSOC);
	$salida="<br/>".
					"<h2 align='center'>MODIFICAR PRODUCTO </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center' >".
						"<tr>".
							"<td><label>Nombre:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['desc_prod']."' name='nombre'/></td>".
						"</tr>".
						"<tr>".
							"<td><label>Precio Unidad:</label></td>".
							"<td><input class='form-control' type='text'  value='".$ren['pu_prod']."' name='precio' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Unidad de medida:</label></td>".
							"<td><input class='form-control' type='text'   value='".$ren['umed_prod']."' name='umd' /></td>".
						"</tr>";
						if($ren['status_prod']==1){
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
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text' readonly value='".$ren['nombre_prov']."' name='proveedor' /></td>".
						"</tr>";
				$salida.="<tr>".
							"<td colspan='2'><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Guardar Cambios' /></td>".
						"</tr>".
					"</table><br/>".
					"<input type='hidden' name='clave' value='".$ren['cve_prov']."' >";
	break;

	case 'Guardar Cambios':
	$ide=$_GET['clave'];
	$cnn=conectar();
	$clave=$_GET['clave'];
      		$nombre=$_GET['nombre'];
      		$precio=$_GET['precio'];
      		$umd=$_GET['umd'];
      		$status=$_GET['status'];
	$qry="UPDATE producto SET desc_prod='$nombre',pu_prod=$precio,umed_prod='$umd',status_prod=$status where cve_prod=$ide";
	$consul=$cnn->query($qry);
			$salida="registro modificado con  exito!!";
	break;

	case 'Eliminar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE producto SET status_prod=0 where cve_prod=$ide";
			$consul=$cnn->query($qry);
			$salida="eliminacion logica con  exito!!";
	break;
	case 'Activar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE producto SET status_prod=1 where cve_prod=$ide";
			$consul=$cnn->query($qry);
			$salida="Activcion logica con  exito!!";
	break;

	default:
		$salida="Adios mundo cruelxyz";
		break;
}

header("Location:http:menuprincipal.php?resultadoProductos=".$salida);
?>

