<script language="javascript">
	setTimeout('document.location.reload()', 10*1000);
</script>
<?php
	session_start();
	if($_SESSION['tiendaxyz']==1){
		echo "tienda1";
		header("Location:actualizarx.php?");
		
	}
	if($_SESSION['tiendaxyz']==2){
		header("Location:actualizary.php?");
	}else{
		echo "No entra a ni vergas";
	}
?>