<?php 
session_start();
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
					"<h2 align='center'>Nuevo Kit</h2>".
					"<h4 align='center'>Nombre:<input  type='text' required  name='nombrekit' /> <input type='submit' name='opcion'  value='Checar' /></h4>";

		break;
		case 'Checar':
              $bandera=0;
            for ($j=0; $j<$_COOKIE['cookietamanio5']; $j++) {
             $dato=explode("$", $_COOKIE['cookieKit'.$j]);
				if ($_GET['nombrekit']==$dato[1]) {
				  $bandera++;
				 }
				}
				if ($bandera==0) {
					$salida="<br><div align='center'><label >Producto: </label>".
					"<select  name='selectproducto'  />";
							for ($j=0; $j<$_COOKIE['cookietamanio3'] ; $j++) {
                                    $datop=explode("$", $_COOKIE['cookieProductos'.$j]);
                                    $salida.="<option value='".$datop[0]."' >".$datop[1]."</option>";
                                    }
							$salida.="</select><input type='submit' name='opcion' value='Agregar'></div>";
							$_SESSION['nombrekit']=$_GET['nombrekit'];

				}else{
					$salida="<label style='color:red;' align='center'>El nombre del kit ya fue registrado ateriormente</label>";
					$salida.="<br/>".
					"<h2 align='center'>Nuevo Kit</h2>".
					"<h4 align='center'>Nombre:<input  type='text' required  name='nombrekit' /> <input type='submit' name='opcion'  value='Checar' /></h4>";
				}
		break;
		case 'Agregar':

		$salida="<br><div align='center'><label >Producto: </label>".
					"<select  name='selectproducto'  />";
		for ($j=0; $j<$_COOKIE['cookietamanio3'] ; $j++) {
           $datop=explode("$", $_COOKIE['cookieProductos'.$j]);
             $salida.="<option value='".$datop[0]."' >".$datop[1]."</option>";
               }
			$salida.="</select><input type='submit' name='opcion' value='Agregar'></div>";//HASTA AQUI ES EL DELECT DEL OPTION
						
$banderax=0;
		 for ($h=0; $h<$_COOKIE['cookietamanio3']; $h++) {
			$dato=explode("$", $_COOKIE['cookieProductos'.$h]);
				if ($_GET['selectproducto']==$dato[0]) { //AQUI VA A IR EL IF PARA VERIFICAR SI YA FUE AGREGADO EN LA SESSION
					$renglonk1=explode("|",$_SESSION['renglonKit']);
					$can1=count($renglonk1)-1;
					for ($b=0; $b<$can1 ; $b++){ 
							$inf1=explode("$", $renglonk1[$b]);
						if ($_GET['selectproducto']==$inf1[0]) {
							$banderax=1;
						}
				}
				if ($banderax==1){
							$salida.="<label style='color:red;' align='center'>El nombre del kit ya fue registrado ateriormente</label>";
						}
				else{
				$_SESSION['renglonKit'].=$dato[0]."$".$dato[1]."$1$".$dato[2]."$0$0$0$|";
				 }
				}
				}

				$renglonk=explode("|",$_SESSION['renglonKit']);
				$can=count($renglonk)-1;
				$salida.="<table class='table table-striped' style='width: 75%;' align='center'>".
						"<tr>".
							"<td>Producto</td>".
							"<td>Cantidad</td>".
							"<td>Precio</td>".
							"<td>Descuento %</td>".
							"<td>Subtotal</td>".
							"<td>Acciones</td>".
						"</tr>";
						for ($i=0; $i<$can ; $i++) { 
							$inf=explode("$", $renglonk[$i]);
							if($inf[6]==1){
							$salida.="<tr>".
							"<td><input type='text'  readonly value='".$inf[1]."' name='nombre'></td>".
							"<td><input type='number' name='cantidad' pattern='[0-9]' readonly required value='".$inf[2]."'></td>".
							"<td><input type='text'  readonly name='precio' value='".$inf[3]."'></td>".
							"<td><input type='number'  name='porcentaje' readonly required pattern='[0-9]' value='".$inf[4]."'></td>".
							"<td><input type='text'  readonly name='total' value='".$inf[5]."' ></td>".
							"<td ><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Modificar' /><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Eliminar' /></td>".
							"<input type='hidden' name='renglon' value='".$inf[0]."'>".
						"</tr>";
					}else{
						$salida.="<tr>".
							"<td><input type='text'  readonly value='".$inf[1]."' name='nombre'></td>".
							"<td><input type='number' name='cantidad' pattern='[0-9]' required value='".$inf[2]."'></td>".
							"<td><input type='text'  readonly name='precio' value='".$inf[3]."'></td>".
							"<td><input type='number'  name='porcentaje' required pattern='[0-9]' value='".$inf[4]."'></td>".
							"<td><input type='text'  readonly name='total' value='".$inf[5]."' ></td>".
							"<td ><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Asignar' /></td>".
							"<input type='hidden' name='renglon' value='".$inf[0]."'>".
						"</tr>";
					}
					}
						$salida.="</table>".
					"<input type='submit' name='opcion'  value='Cancelar' />".
					"<input type='submit' name='opcion'  value='Guardar' />";
		break;
	case 'Asignar':
		$total1=($_GET['cantidad'])*($_GET['precio']);
		$total=($total*($_GET['porcentaje']))/100;
		$total=$total1-$total;  //AQUI CALCULAMOS LO QUE VAMOS A DESCONTAR DEL PORCENTAJE

	/////////////////////////////////////////////////////////	 REASIGNAMOS VALORES A LA tabla		
			$renglonk=explode("|",$_SESSION['renglonKit']);
			$can1=count($renglonk)-1;
			for ($b=0; $b<$can1 ; $b++){ 
			$subinformacion=explode("$", $renglonk[$b]);
			if ($_GET['renglon']==$subinformacion[0]){
				$auxiliar.=$_GET['renglon']."$".$_GET['nombre']."$".$_GET['cantidad']."$".$_GET['precio']."$".$_GET['porcentaje']."$".$total."$1$|";
				}else
				$auxiliar.=$renglonk[$b]."|";
				}
				$_SESSION['renglonKit']=$auxiliar;
			//$salida.=$_SESSION['renglonKit'];
		///////////////////////////////////////////////////////// HASTA AQUI ESTA LO DE AGREGAR YA HACE LOS CALCULOS

			//////////////////////////////AQUI VA  IR AHORA OTRA VES EL SELECT DE LOS PRODUCTOS Y VERIFICAR SI NO SE AH AGREGADO

			$salida.="<br><div align='center'><label >Producto: </label>".
					"<select  name='selectproducto'  />";
				for ($j=0; $j<$_COOKIE['cookietamanio3'] ; $j++) {
           $datop=explode("$", $_COOKIE['cookieProductos'.$j]);
             $salida.="<option value='".$datop[0]."' >".$datop[1]."</option>";
               }
			$salida.="</select><input type='submit' name='opcion' value='Agregar'></div>";//HASTA AQUI ES EL DELECT DEL OPTION
						
			$banderax=0;
		 for ($h=0; $h<$_COOKIE['cookietamanio3']; $h++) {
			$dato=explode("$", $_COOKIE['cookieProductos'.$h]);
				if ($_GET['selectproducto']==$dato[0]) { //AQUI VA A IR EL IF PARA VERIFICAR SI YA FUE AGREGADO EN LA SESSION
					$renglonk1=explode("-",$_SESSION['renglonKit']);
					$can1=count($renglonk1)-1;
					for ($b=0; $b<$can1 ; $b++){ 
							$inf1=explode("$", $renglonk1[$b]);
						if ($_GET['selectproducto']==$inf1[0]) {
							$banderax=1;
						}
				}
				if ($banderax==1){
							$salida.="<label style='color:red;' align='center'>El nombre del kit ya fue registrado ateriormente</label>";
						}
				}
				}

			////////////////////////////////////////////////////
			////////////AQUI ESTA LA CONSTRUCCION DE LA TABLA PARA QUE MUESTRE LOS RESULTADOS///////////////
			$renglonkx=explode("|",$_SESSION['renglonKit']);
				$can=count($renglonkx)-1;
				$salida.="<table class='table table-striped' style='width: 75%;' align='center'>".
						"<tr>".
							"<td>Producto</td>".
							"<td>Cantidad</td>".
							"<td>Precio</td>".
							"<td>Descuento %</td>".
							"<td>Subtotal</td>".
							"<td>Acciones</td>".
						"</tr>";
						for ($i=0; $i<$can ; $i++) { 
							$inf=explode("$", $renglonkx[$i]);
							if($inf[6]==1){
							$salida.="<tr>".
							"<td><input type='text'  readonly value='".$inf[1]."' name='nombre'></td>".
							"<td><input type='number' name='cantidad' readonly pattern='[0-9]' required value='".$inf[2]."'></td>".
							"<td><input type='text'  readonly name='precio' value='".$inf[3]."'></td>".
							"<td><input type='number'  name='porcentaje' readonly required pattern='[0-9]' value='".$inf[4]."'></td>".
							"<td><input type='text'  readonly name='total' value='".$inf[5]."' ></td>".
							"<td ><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Modificar' /><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Eliminar' /></td>".
							"<input type='hidden' name='renglon' value='".$inf[0]."'>".
						"</tr>";
					}else{
						$salida.="<tr>".
							"<td><input type='text'  readonly value='".$inf[1]."' name='nombre'></td>".
							"<td><input type='number' name='cantidad' pattern='[0-9]' required value='".$inf[2]."'></td>".
							"<td><input type='text'  readonly name='precio' value='".$inf[3]."'></td>".
							"<td><input type='number'  name='porcentaje' required pattern='[0-9]' value='".$inf[4]."'></td>".
							"<td><input type='text'  readonly name='total' value='".$inf[5]."' ></td>".
							"<td ><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Asignar' /></td>".
							"<input type='hidden' name='renglon' value='".$inf[0]."'>".
						"</tr>";
					}
					}
						$salida.="</table>".
					"<input type='submit' name='opcion'  value='Cancelar' />".
					"<input type='submit' name='opcion'  value='Guardar' />";

	break;
	case 'Modificar':
		$total1=($_GET['cantidad'])*($_GET['precio']);
		$total=($total*($_GET['porcentaje']))/100;
		$total=$total1-$total;  //AQUI CALCULAMOS LO QUE VAMOS A DESCONTAR DEL PORCENTAJE


			//////////////////////////////AQUI VA  IR AHORA OTRA VES EL SELECT DE LOS PRODUCTOS Y VERIFICAR SI NO SE AH AGREGADO

			$salida.="<br><div align='center'><label >Producto: </label>".
					"<select  name='selectproducto'  />";
				for ($j=0; $j<$_COOKIE['cookietamanio3'] ; $j++) {
           $datop=explode("$", $_COOKIE['cookieProductos'.$j]);
             $salida.="<option value='".$datop[0]."' >".$datop[1]."</option>";
               }
			$salida.="</select><input type='submit' name='opcion' value='Agregar'></div>";//HASTA AQUI ES EL DELECT DEL OPTION
			$banderax=0;
		 for ($h=0; $h<$_COOKIE['cookietamanio3']; $h++) {
			$dato=explode("$", $_COOKIE['cookieProductos'.$h]);
				if ($_GET['selectproducto']==$dato[0]) { //AQUI VA A IR EL IF PARA VERIFICAR SI YA FUE AGREGADO EN LA SESSION
					$renglonk1=explode("-",$_SESSION['renglonKit']);
					$can1=count($renglonk1)-1;
					for ($b=0; $b<$can1 ; $b++){ 
							$inf1=explode("$", $renglonk1[$b]);
						if ($_GET['selectproducto']==$inf1[0]) {
							$banderax=1;
						}
				}
				if ($banderax==1){
							$salida.="<label style='color:red;' align='center'>El nombre del kit ya fue registrado ateriormente</label>";
						}
				}
				}

			////////////////////////////////////////////////////
			////////////AQUI ESTA LA CONSTRUCCION DE LA TABLA PARA QUE MUESTRE LOS RESULTADOS///////////////
			$renglonkx=explode("|",$_SESSION['renglonKit']);
				$can=count($renglonkx)-1;
				$salida.="<table class='table table-striped' style='width: 75%;' align='center'>".
						"<tr>".
							"<td>Producto</td>".
							"<td>Cantidad</td>".
							"<td>Precio</td>".
							"<td>Descuento %</td>".
							"<td>Subtotal</td>".
							"<td>Acciones</td>".
						"</tr>";
						for ($i=0; $i<$can ; $i++) { 
							$inf=explode("$", $renglonkx[$i]);
							if($inf[0]==$_GET['renglon']){
							$salida.="<tr>".
							"<td><input type='text'  readonly value='".$inf[1]."' name='nombre'></td>".
							"<td><input type='number' name='cantidad' pattern='[0-9]' required value='".$inf[2]."'></td>".
							"<td><input type='text'  readonly name='precio' value='".$inf[3]."'></td>".
							"<td><input type='number'  name='porcentaje' required pattern='[0-9]' value='".$inf[4]."'></td>".
							"<td><input type='text'  readonly name='total' value='".$inf[5]."' ></td>".
							"<td ><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Asignar' /></td>".
							"<input type='hidden' name='renglon' value='".$inf[0]."'>".
						"</tr>";
					}
					}
					$salida.="</table>".
					"<input type='submit' name='opcion'  value='Cancelar' />".
					"<input type='submit' name='opcion'  value='Guardar' />";
		break;
		case 'Cancelar':
			unset($_SESSION['renglonKit']);
			break;
case 'Eliminar':

$salida.="<br><div align='center'><label >Producto: </label>".
					"<select  name='selectproducto'  />";
				for ($j=0; $j<$_COOKIE['cookietamanio3'] ; $j++) {
           $datop=explode("$", $_COOKIE['cookieProductos'.$j]);
             $salida.="<option value='".$datop[0]."' >".$datop[1]."</option>";
               }
			$salida.="</select><input type='submit' name='opcion' value='Agregar'></div>";//HASTA AQUI ES EL SELECT DEL OPTION
						
			$banderax=0;
		 for ($h=0; $h<$_COOKIE['cookietamanio3']; $h++) {
			$dato=explode("$", $_COOKIE['cookieProductos'.$h]);
				if ($_GET['selectproducto']==$dato[0]) { //AQUI VA A IR EL IF PARA VERIFICAR SI YA FUE AGREGADO EN LA SESSION
					$renglonk1=explode("-",$_SESSION['renglonKit']);
					$can1=count($renglonk1)-1;
					for ($b=0; $b<$can1 ; $b++){ 
							$inf1=explode("$", $renglonk1[$b]);
						if ($_GET['selectproducto']==$inf1[0]) {
							$banderax=1;
						}
				}
				if ($banderax==1){
							$salida.="<label style='color:red;' align='center'>El nombre del kit ya fue registrado ateriormente</label>";
						}
				}
				}
				////////////////////////////////aqui esta sucediendo la eliminacion 
	$renglonk=explode("|",$_SESSION['renglonKit']);
			$can1=count($renglonk)-1;
			for ($b=0; $b<$can1 ; $b++){ 
			$subinformacion=explode("$", $renglonk[$b]);
			if ($_GET['renglon']==$subinformacion[0]){
				 //ELIMINACION POR SELECCION
				}else{
				$auxiliar.=$renglonk[$b]."|";
				}
			}
				$_SESSION['renglonKit']=$auxiliar;

		////////////////////////////AQUI SE TENDRIA QUE RECONSTRUIR LA TABLA CON LOS NUEVOS VALORES
				$renglonk=explode("|",$_SESSION['renglonKit']);
				$can=count($renglonk)-1;
				$salida.="<table class='table table-striped' style='width: 75%;' align='center'>".
						"<tr>".
							"<td>Producto</td>".
							"<td>Cantidad</td>".
							"<td>Precio</td>".
							"<td>Descuento %</td>".
							"<td>Subtotal</td>".
							"<td>Acciones</td>".
						"</tr>";
						for ($i=0; $i<$can ; $i++) { 
							$inf=explode("$", $renglonk[$i]);
							if($inf[6]==1){
							$salida.="<tr>".
							"<td><input type='text'  readonly value='".$inf[1]."' name='nombre'></td>".
							"<td><input type='number' name='cantidad' pattern='[0-9]' readonly required value='".$inf[2]."'></td>".
							"<td><input type='text'  readonly name='precio' value='".$inf[3]."'></td>".
							"<td><input type='number'  name='porcentaje' readonly required pattern='[0-9]' value='".$inf[4]."'></td>".
							"<td><input type='text'  readonly name='total' value='".$inf[5]."' ></td>".
							"<td ><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Modificar' /><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Eliminar' /></td>".
							"<input type='hidden' name='renglon' value='".$inf[0]."'>".
						"</tr>";
					}else{
						$salida.="<tr>".
							"<td><input type='text'  readonly value='".$inf[1]."' name='nombre'></td>".
							"<td><input type='number' name='cantidad' pattern='[0-9]' required value='".$inf[2]."'></td>".
							"<td><input type='text'  readonly name='precio' value='".$inf[3]."'></td>".
							"<td><input type='number'  name='porcentaje' required pattern='[0-9]' value='".$inf[4]."'></td>".
							"<td><input type='text'  readonly name='total' value='".$inf[5]."' ></td>".
							"<td ><input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Asignar' /></td>".
							"<input type='hidden' name='renglon' value='".$inf[0]."'>".
						"</tr>";
					}
					}
					$salida.="</table>".
					"<input type='submit' name='opcion'  value='Cancelar' />".
					"<input type='submit' name='opcion'  value='Guardar' />";

	break;

	case 'Guardar': //////////////////////AQUI VA LA INSERCION A LA BDD
		$nom=$_SESSION['nombrekit'];
		$cnn=conectar();
		$qry="INSERT INTO kit values(null,'$nom',1)"; //////////////INSERCION DE KIT EN LA BDD
		$ejec=$cnn->query($qry);

		$qry1="select *from kit where nombre_kit='$nom'";///////////EXTRACCION DE LA CVE QUE SE ACABA DE REGISTRAR PARA PODER INSERTAR
		$consul1= $cnn->query($qry1); 						//// Y PASARLA COMO FORANEA
		$ren=$consul1->fetch_array(MYSQL_ASSOC);
		$cve=$ren['cve_kit'];

		///////////AQUI SE TIENE QUE HACER EL EXPLODE DE LA BASE DE DATOS PARA HACER LA INSERCION A KITPRODUCTO///////////////////////
		$renglonkx=explode("|",$_SESSION['renglonKit']);
			$canx=count($renglonkx)-1;
				for ($b=0; $b<$canx ; $b++) { 
						$infx=explode("$", $renglonkx[$b]);
						if($infx[6]==1){
							$total+=$infx[5];
					}
				}


		$renglonk=explode("|",$_SESSION['renglonKit']);
			$can=count($renglonk)-1;
				for ($i=0; $i<$can ; $i++) { 
						$inf=explode("$", $renglonk[$i]);
						if($inf[6]==1){
	$qryx="select *from producto where desc_prod='$inf[1]'";///////////EXTRACCION DE LA CVE QUE SE ACABA DE REGISTRAR PARA PODER INSERTAR
						$consul2= $cnn->query($qryx); 						//// Y PASARLA COMO FORANEA
						$ren2=$consul2->fetch_array(MYSQL_ASSOC);
						
						$cveprod=$ren2['cve_prod']; //clave del producto para pasarla como foranea
						$total; 					//costo total del kit ya contiene el descuento
						$porcentaje=$inf[4];		//porcentaje que se le va a descontar
						$cantidad=$inf[2];			//Cantidad de productos de cada uno que se va a agregar
						$cve;
				//$ubu=$total."$".$porcentaje."$".$cantidad."$"
			$qry3="INSERT INTO kitproducto values(null,$total,$porcentaje,$cantidad,'$cveprod',$cve)";//INSERCION DE KITPRODUCTO EN LA BDD
					$ejec3=$cnn->query($qry3);
					}
				}
				//$Linux=$_SESSION['renglonKit'];
 	unset($_SESSION['renglonKit']);
		$salida="Guardado con exito";
		break;///////////////////////////////////////////////////////////

	case 'Detalles':
	$renglon=$_GET['renglon'];
	$cnn=conectar();
	$qry="select nombre_kit,precio_kitprod,status_kit from kit join kitproducto on kit.cve_kit=kitproducto.cve_kit join producto on kitproducto.cve_prod=producto.cve_prod where kit.cve_kit=$renglon";
	$consul= $cnn->query($qry);
	$ren=$consul->fetch_array(MYSQL_ASSOC);
	$salida="<br/>".
					"<h2 align='center'>DETALLES KIT </h2>".
					"<h3 align='center'>Nombre: ".$ren['nombre_kit']." </h3>".
					
					"<table class='table table-striped' style='width: 40%;' align='center' >".
						"<tr>".
							"<td><label>Clave</label></td>".
							"<td><label>Producto</label></td>".
							"<td><label>Cantidad</label></td>".
							"<td><label>Precio P*U</label></td>".
							"<td><label>Descueto en %</label></td>".
							"<td><label>Total</label></td>".
							"</tr>";

							$qry1="select producto.cve_prod,desc_prod,pu_prod,kitproducto.porcentaje,cantidad from kit join kitproducto on kit.cve_kit=kitproducto.cve_kit join producto on kitproducto.cve_prod=producto.cve_prod where kit.cve_kit=$renglon";
							$consul1=$cnn->query($qry1);
							while ($ren1=$consul1->fetch_array(MYSQL_ASSOC)) {
								$total1=$ren1['cantidad']*$ren1['pu_prod'];
								$total=($total1*($ren1['porcetaje']))/100;
								$total=$total1-$total;
							$salida.="<tr>".
							"<td><input class='form-control' type='text' readonly value='".$ren1['cve_prod']."' /></td>".
							"<td><input class='form-control' type='text' readonly value='".$ren1['desc_prod']."' /></td>".
							"<td><input class='form-control' type='text' readonly value='".$ren1['cantidad']."' /></td>".
							"<td><input class='form-control' type='text' readonly value='".$ren1['pu_prod']."' /></td>".
							"<td><input class='form-control' type='text' readonly value='".$ren1['porcentaje']."%' /></td>".
							"<td><input class='form-control' type='text' readonly value='$total' /></td></tr>";
						}
						$salida.="<tr>".
							"<td><label>Precio Final:</label></td>".
							"<td></td>".
							"<td></td>".
							"<td></td>".
							"<td></td>".
							"<td><input class='form-control' type='text' readonly value='".$ren['precio_kitprod']."' /></td>".
						"</tr>".
						"<tr>".
							"<td><label>Status:</label></td>";
							$valor;
							if($ren['status_kit']==1){
								$valor='Activo';
							}else{
								$valor='Inactivo';
							}
							$salida.="<td><input type='text' name='status' readonly='readonly' value='".$valor."' class='form-control'/></td>".
						"</tr>".
					"</table>";
	 
	break;

	case 'Eliminar1':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE kit SET status_kit=0 where cve_kit=$ide";
			$consul=$cnn->query($qry);
			$salida="eliminacion logica con  exito!!";
	break;

	case 'Activar':
			$ide=$_GET['renglon'];
			$cnn=conectar();
			$qry="UPDATE kit SET status_kit=1 where cve_kit=$ide";
			$consul=$cnn->query($qry);
			$salida="Kit activado con exito!!";

	break;

	default:
		$salida="Adios mundo cruelxyz";
		break;
}
header("Location:menuprincipal.php?resultadoKits=".$salida);
?>