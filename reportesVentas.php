<?php
$cnn="";
function conectar(){
$host="localhost";
$user="root";
$pwd="12345678";
$db="tienday";
$cnn1=new mysqli($host,$user,$pwd,$db);
if ($cnn1->connect_error) {
    echo $cnn1->connect_error;
    exit();
}
	return $cnn1;
}
	$salida='';
		switch ($_GET['opci']) {
			case 'Ventas':
				$salida="<br/>".
					"<h2 align='center'>Reportes De Ventas </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
							"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Fecha:</label></td>".
							"<td><input class='form-control' type='date'   name='incio' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Hasta:</label></td>".
							"<td><input class='form-control' type='date'   name='fin' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";
				break;
			
			case 'Filtrar':
				$inicio=$_GE['incio'];
				$fin=$_GET['fin'];
				$cnn=conectar();
					$qry="SELECT venta.cve_ven,fecha_ven,total_ven,nombre_cli,nom_prod,cant_renven FROM cliente join  venta on cliente.cve_cli=venta.cve_cli join renglonventa on venta.cve_ven=renglonventa.cve_ven WHERE fecha_ven BETWEEN '$inicio' AND '$fin'";
					$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>ID</td> <td> NOMBRE</td> <td>PU</td> <td>UMED</td>  </tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' readonly='' name='clave' value='".$ren['cve_prod']."'></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['pu_prod']."' name='precio'></td>".
					"<td><input type='text' value='".$ren['umed_prod']."' name='medida'></td>".
					"</tr>";
						}
					$salida.="</table> </form>";

				break;

		}
		header("Location:Menubusqueda.php?resultadoVentas=".$salida);
?>