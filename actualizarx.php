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

$cnn=conectar();
$datosProductos="";
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


	header("Location:menuprincipal.php?datosProductos=".$datosProductos);

?>