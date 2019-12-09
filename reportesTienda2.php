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
			case 'Inventario':
				$salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='selecttienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda1'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";
				break;

				case 'Filtrar':
				if ($_GET['selecttienda']=='tienda1' && $_GET['producto']==NULL && $_GET['proveedor']==NULL && $_GET['existencia']==NULL) {
					 $salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";
			$cnn=conectar();
			$qry="select nombre_prov,producto.cve_prod,desc_prod,existencia_renkar from proveedor join producto on proveedor.cve_prov=producto.cve_prov join kardex on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar";
				$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>PROVEEDOR</td> <td> CVE PROD</td> <td>PRODUCTO</td><td>EXISTENCIA</td></tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' value='".$ren['nombre_prov']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['cve_prod']."' ></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' ></td>".
					"<td><input type='text' value='".$ren['existencia_renkar']."' ></td>".
					"</tr>";
						}
					$salida.="</table>";
////////////////////////////////////////////////////////////////////
				}elseif ($_GET['selecttienda']=='tienda1' && $_GET['producto']!=NULL && $_GET['proveedor']!=NULL && $_GET['existencia']!=NULL) {
					$salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";
			$cnn=conectar();
			$proveedor=$_GET['proveedor'];
			$producto=$_GET['producto'];
			$existencia=$_GET['existencia'];
			$qry="select nombre_prov,producto.cve_prod,desc_prod,existencia_renkar from proveedor join producto on proveedor.cve_prov=producto.cve_prov join kardex on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar where nombre_prov like '%$proveedor%' and desc_prod like'%$producto%' and existencia_renkar=$existencia;";
				$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>PROVEEDOR</td> <td> CVE PROD</td> <td>PRODUCTO</td><td>EXISTENCIA</td></tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' value='".$ren['nombre_prov']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['cve_prod']."' ></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' ></td>".
					"<td><input type='text' value='".$ren['existencia_renkar']."' ></td>".
					"</tr>";
						}
					$salida.="</table>";
///////////////////////////////////////////////////////////////
				}elseif ($_GET['selecttienda']=='tienda1' && $_GET['producto']!=NULL && $_GET['proveedor']==NULL && $_GET['existencia']==NULL) {
					$salida="dentro del if";
					$salida.="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";

				$producto=$_GET['producto'];
				$cnn=conectar();
					$qry="SELECT * FROM producto where desc_prod like '%$producto%'";
					$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>ID</td> <td> NOMBRE</td> <td>PU</td> <td>UMED</td>  </tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' readonly='' name='clave' value='".$ren['cve_prod']."'></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['pu_prod']."' name='precio'></td>".
					"<td><input type='text' value='".$ren['umed_prod']."' name='medida'></td>".
					"</tr>";
						}
					$salida.="</table>";
//////////////////////////////////////////////////////
				}elseif ($_GET['selecttienda']=='tienda1' && $_GET['producto']==NULL && $_GET['proveedor']!=NULL && $_GET['existencia']==NULL) {
					$salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";

				$nombre=$_GET['proveedor'];
				$cnn=conectar();
					$qry="SELECT * FROM proveedor where nombre_prov like '%$nombre%'";
					$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr><td> NOMBRE</td> <td> APELLIDO P</td><td> APELLIDO M</td><td>RFC</td> <td>MAIL</td> <td>DIRECCION</td><td>TELEFONO</td> </tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' value='".$ren['nombre_prov']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['paterno_prov']."' name='appat'></td>".
					"<td><input type='text' value='".$ren['materno_prov']."' name='ampat'></td>".
					"<td><input type='text' value='".$ren['rfc_prov']."' name='medida'></td>".
					"<td><input type='text' value='".$ren['mail_prov']."' name='medida'></td>".
					"<td><input type='text' value='".$ren['direccion_prov']."' name='medida'></td>".
					"<td><input type='text' value='".$ren['tel_prov']."' name='medida'></td>".
					"</tr>";
						}
					$salida.="</table>";
///////////////////////////////////////////////////////////////////////
				}elseif ($_GET['selecttienda']=='tienda1' && $_GET['producto']==NULL && $_GET['proveedor']==NULL && $_GET['existencia']!=NULL) {
					$salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";
			$existencia=$_GET['existencia'];
			$cnn=conectar();
			$qry="select producto.cve_prod, desc_prod,existencia_renkar from producto join kardex on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar where existencia_renkar=$existencia";
				$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>ID</td> <td> NOMBRE</td> <td> EXISTENCIA</td></tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' value='".$ren['cve_prod']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' name='appat'></td>".
					"<td><input type='text' value='".$ren['existencia_renkar']."' name='ampat'></td>".
					"</tr>";
						}
					$salida.="</table>";
///////////////////////////////////////////////////////////////////
				}elseif ($_GET['selecttienda']=='tienda1' && $_GET['producto']!=NULL && $_GET['proveedor']!=NULL && $_GET['existencia']!=NULL) {
						$salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";

				$producto=$_GET['producto'];
				$proveedor=$_GET['proveedor'];
				$cnn=conectar();
					$qry="select nombre_prov,cve_prod,desc_prod,pu_prod,umed_prod,status_prod from proveedor join producto on proveedor.cve_prov=producto.cve_prov where nombre_prov like '$proveedor' and desc_prod like '$%producto%'";
					$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>PROVEEDOR</td> <td>ID</td> <td> NOMBRE</td> <td>PU</td> <td>UMED</td>  </tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' value='".$ren['nombre_prov']."' name='nombre'></td>".
					"<td><input type='text' readonly='' name='clave' value='".$ren['cve_prod']."'></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['pu_prod']."' name='precio'></td>".
					"<td><input type='text' value='".$ren['umed_prod']."' name='medida'></td>".
					"</tr>";
						}
					$salida.="</table>";
//////////////////////////////////////////////////////////////////////
				}elseif ($_GET['selecttienda']=='tienda1' && $_GET['producto']!=NULL && $_GET['proveedor']==NULL && $_GET['existencia']!=NULL) {
					$salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";
			$existencia=$_GET['existencia'];
			$producto=$_GET['producto'];
			$cnn=conectar();
			$qry="select cve_prod,desc_prod,pu_prod,umed_prod,existencia_renkar from producto join kardex on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar where desc_prod like '%$producto%' and existencia_renkar like '%$existencia%';";
				$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>CVE PRODUCTO</td> <td> NOMBRE</td> <td> UMED</td><td> EXISTENCIA</td></tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' value='".$ren['cve_prod']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' ></td>".
					"<td><input type='text' value='".$ren['umed_prod']."' ></td>".
					"<td><input type='text' value='".$ren['existencia_renkar']."' ></td>".
					"</tr>";
						}
					$salida.="</table>";
//////////////////////////////////////////////////////////////
				}elseif ($_GET['selecttienda']=='tienda1' && $_GET['producto']==NULL && $_GET['proveedor']!=NULL && $_GET['existencia']!=NULL) {
						$salida="<br/>".
					"<h2 align='center'>Reportes De Tienda </h2>".
					"<table class='table table-striped' style='width: 40%;' align='center'>".
						"<tr>".
							"<td><label>Tienda:</label></td>".
							"<td><select name='tienda' class='form-control'>".
							"<option value='tienda1'>Tienda 1</option>".
							"<option value='tienda2'>Tienda 2</option>".
							"</select></td>".
						"</tr>".
						"<tr>".
							"<td><label>Producto: </label></td>".
							"<td><input class='form-control' type='text'   name='producto' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Proveedor:</label></td>".
							"<td><input class='form-control' type='text'   name='proveedor' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Existencia:</label></td>".
							"<td><input class='form-control' type='text'   name='existencia' /></td>".
						"</tr>".
						"<tr>".
							"<td colspan='2'><input type='submit' name='opci' class='btn btn-sm btn-success form-control' value='Filtrar' /></td>".
						"</tr>".
					"</table>";
			$proveedor=$_GET['proveedor'];				
			$existencia=$_GET['existencia'];
			$cnn=conectar();
			$qry="select nombre_prov,producto.cve_prod,desc_prod,existencia_renkar from proveedor join producto on proveedor.cve_prov=producto.cve_prov join kardex on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar where nombre_prov like '%$proveedor%' and existencia_renkar=$existencia";
				$consul=$cnn->query($qry);
					$salida.="<table border='1px' align='center'><tr> <td>PROVEEDOR</td> <td>CVE PRODUCTO</td><td> PRODUCTO</td><td> EXISTENCIA</td></tr>";
					while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
					$salida.="<tr><td><input type='text' value='".$ren['nombre_prov']."' name='nombre'></td>".
					"<td><input type='text' value='".$ren['cve_prod']."' ></td>".
					"<td><input type='text' value='".$ren['desc_prod']."' ></td>".
					"<td><input type='text' value='".$ren['existencia_renkar']."' ></td>".
					"</tr>";
						}
					$salida.="</table>";

				}

					break;
		}
		header("Location:Menubusqueda.php?resultadoTienda=".$salida);
?>