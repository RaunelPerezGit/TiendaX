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
		$tipoUsu="";
		$qry="select * from usuario where login_usu='".$_GET['usuario']."' and pass_usu='".$_GET['password']."'";
		$consul=$cnnx->query($qry);
		$i=0;
		while($ren=$consul->fetch_array(MYSQL_ASSOC)){
			$tipoUsu=$ren['tipo_usu'];
			$i++;
		}

		if($i>0){//No se encontró nada tampoco en la BDD2
			$usuario=$_GET['usuario']."$".$_GET['password']."$".$tipoUsu."$";
			$tienda=1;
		}else{
			//No encontro en la BDD1 asi que haremos una petición a la BDD2
		}

		$cnn=conectar();
		
	$qry1="SELECT cve_usu,nombre_usu,paterno_usu,materno_usu,rfc_usu,mail_usu,direccion_usu,tel_usu,login_usu,pass_usu,status_usu from usuario";
				$consul1=$cnn->query($qry1);
				$j=0;
				while ($ren1=$consul1->fetch_array(MYSQL_ASSOC)) {
					$datosUsuarios.=$ren1['cve_usu']."$".$ren1["nombre_usu"]."$".$ren1['paterno_usu']."$".$ren1['materno_usu']."$".$ren1['rfc_usu']."$".$ren1['mail_usu']."$".$ren1['direccion_usu']."$".$ren1['tel_usu']."$".$ren1['login_usu']."$".$ren1['pass_usu']."$".$ren1['status_usu']."$|";
				$j++;
				}


	$qry2="SELECT * FROM cliente";
				$consul2=$cnn->query($qry2);
				$a=0;
				while ($ren2=$consul2->fetch_array(MYSQL_ASSOC)) {
					$datosClientes.=$ren2['cve_cli']."$".$ren2["nombre_cli"]."$".$ren2['paterno_cli']."$".$ren2['materno_cli']."$".$ren2['rfc_cli']."$".$ren2['mail_cli']."$".$ren2['direccion_cli']."$".$ren2['tel_cli']."$".$ren2['status_cli']."$|";
				$a++;
				}



	$qry3="select producto.cve_prod,desc_prod,pu_prod,umed_prod,existencia_renkar,status_prod,cve_prov from producto join kardex  on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar;"; 
				$consul3=$cnn->query($qry3);
				$b=0;
				while ($ren3=$consul3->fetch_array(MYSQL_ASSOC)) {
					$existencia=0;
					$cveProd=$ren3['cve_prod'];
					$qryx="select existencia_renkar from renglonkardex where num_renkar=(select max(num_renkar)from producto join kardex on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar  where producto.cve_prod='$cveProd');";
					$consulx=$cnn->query($qryx);
					while($renx=$consulx->fetch_array(MYSQL_ASSOC)){
						$existencia=$renx['existencia_renkar'];
					}
					$datosProductos.=$ren3['cve_prod']."$".$ren3["desc_prod"]."$".$ren3['pu_prod']."$".$ren3['umed_prod']."$".$existencia."$".$ren3['status_prod']."$".$ren3['cve_prov']."$|";
				$b++;
				}

	$qry4="SELECT * FROM proveedor";
				$consul4=$cnn->query($qry4);
				$c=0;
				while ($ren4=$consul4->fetch_array(MYSQL_ASSOC)) {
					$datosProveedor.=$ren4['cve_prov']."$".$ren4["nombre_prov"]."$".$ren4['paterno_prov']."$".$ren4['materno_prov']."$".$ren4['rfc_prov']."$".$ren4['mail_prov']."$".$ren4['direccion_prov']."$".$ren4['tel_prov']."$".$ren4['status_prov']."$|";
				$c++;
				}


	$qry5="SELECT * FROM kit";
				$consul5=$cnn->query($qry5);
				$d=0;
				while ($ren5=$consul5->fetch_array(MYSQL_ASSOC)) {
					$datoskit.=$ren5['cve_kit']."$".$ren5["nombre_kit"]."$".$ren5['status_kit']."$|";
				$d++;
				}

	break;
	default:
		$salida="Adios mundo cruel";
	break;
}


if($salida=="ERROR"){
	//header("Location:http://192.168.0.13/Unidad3Dario/proyectoVacaciones/login.php");
	header("Location:login.php");
}else{
	//header("Location:http://192.168.0.13/Unidad3Dario/proyectoVacaciones/menuprincipal.php?opc=".$opc."&resultado=".$salida."&usuario=".$usuario);
	if($usuario!=""){
		header("Location:menuprincipal.php?datosProductos=".$datosProductos."&datosClientes=".$datosClientes."&datosProveedor=".$datosProveedor."&datosUsuarios=".$datosUsuarios."&datoskit=".$datoskit."&tienda=1&usuario=".$usuario);
	}else{
		header("Location:login.php");
	}
	
}

?>