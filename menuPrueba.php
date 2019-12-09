<?php
function conectar(){
$host="localhost";
$user="root";
$pwd="12345";
$db="tienday";
$cnn=new mysqli($host,$user,$pwd,$db);
if ($cnn->connect_error) {
    echo $cnn->connect_error;
    exit();
}
    return $cnn;
}
//include ('clase.php');

//if($_POST['close']=='ok'){
  //  session_destroy();  
   // header('Location:login.html');
/*}

if (isset($_POST['login'])) {
    if($_POST['usuario']=='raunel' && $_POST['contra']=='1234'
    || $_POST['usuario']=='alfredo' && $_POST['contra']=='1111'){

        $_SESSION['usuario']['nombre']=$_POST['usuario'];
        $_SESSION['usuario']['contra']=$_POST['contra'];
        $usuarioActivo=$_POST['usuario'];
    }else{
        echo "Usuario o contraseña incorrecto";
        echo "<a href='login.php?close=ok'><input class='btn btn-danger' style='margin-left:1000px; margin-top: 50px' value='Regresar'></a> ";
        $displayC="style='display:none'";
    }
    }else{
        echo "Usuario no registrado";
}

if (isset($_SESSION['usuario'])) {
    $displayC = "";

}else{
    $displayC="style='display:none'";
}*/
?>
<html>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <form method="POST" action="menuPrueba.php" style="margin-top: 0px;">
    <div <?php //echo $displayC;?> >
    <nav class="navbar navbar-dark bg-dark"></nav>
    <div class="container">
        <div class="row" >
        <div class="col-sm-12" ><a href='login.php?close=ok'><input class="btn btn-danger" style="margin-left:90px; float:right;" value="cerrar sesion"></a> 
        </div>
        </div><br>
        <div class="row col-sm-12">
            <input type="submit" name="opcion" value="Clientes" class="btn btn-primary" style="border-radius: 100px; width:19%;"  >
             <input type="submit" name="opcion" value="Productos" class="btn btn-primary" style="border-radius: 100px; width:19%;"  >
             <input type="submit" name="opcion" value="Resurtir" class="btn btn-primary" style="border-radius: 100px; width:19%;"  >
            <input type="submit" name="opcion" value="Proveedores" class="btn btn-primary" style="border-radius: 100px; width:19%;">
              <input type="submit" name="opcion" value="Ventas" class="btn btn-primary" style="border-radius: 100px; width:19%;" >
        </div>
        <br/>         
    </div>
    </div>
    </form>

        <form method="POST" <?php echo "action='".$_GET['opc']."'"; ?> >
            <input type="hidden" name="opcionmenu"  <?php echo "value='".$_GET['opc']."'"; ?> >
           <div align="center" >
                <?php
                    if(isset($_GET['resultado'])){
                            echo $_GET['resultado'];
                        }
                ?>
            </div> 
    </form>

<?php
    if (isset($_POST['opcion'])) {
        switch ($_POST['opcion']) {
            case 'Clientes':
                echo "<br/>";
                echo "<form action='Clientes.php' method='POST'>";
                echo "<input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Nuevo' />
                    <input type='hidden' value='Clientes.php'></form>";
                echo "<br>";
                $cnn=conectar();
                $qry="SELECT * FROM cliente";
                $consul=$cnn->query($qry);
                $i=0;
                while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
                $i++;
                setcookie("cookieCliente".$i,$i."#".$ren['cve_cli']."#".$ren["nombre_cli"]."#".$ren['paterno_cli']."#".$ren['materno_cli']."#".$ren['rfc_cli']."#".$ren['mail_cli']."#".$ren['direccion_cli']."#".$ren['tel_cli']."#".$ren['status_cli'],time()+3600);
                }
                echo "<table border='1' align='center'>";
                echo "<tr>";
               echo  "<td>ID</td>";
                echo "<td>Nombre</td>";
                echo "<td>Rfc</td>";
                echo "<td>Mail</td>";
                echo "<td>direccion</td>";
                echo "<td>Telefono</td>";
                echo "<td>Acciones</td>";
                echo "</tr>";
                ?>
                <?php
                for ($j=1; $j <=$i ; $j++) { 
                $dato=explode("#", $_COOKIE['cookieCliente'.$j]);
                ?>

                <tr>
                <td> <?php echo $dato[1]?></td>
                <td><?php echo $dato[2]?> <?php echo $dato[3]?> <?php echo $dato[4]?></td>
                <td><?php echo $dato[5]?></td>
                <td><?php echo $dato[6]?></td>
                <td><?php echo $dato[7]?></td>
                <td><?php echo $dato[8]?></td>
                            <td>
                             <form method="POST" action="Clientes.php">
                              <input type="hidden" name="renglon" <?php echo "value='".$dato[1]."'"; ?> />
                            <input type="submit" name="opcion" class="btn btn-sm btn-success"  value="Detalles" />
                            <input type="submit" name="opcion" class="btn btn-sm btn-warning"  value="Modificar" />
                            <input type="submit" name="opcion" class="btn btn-sm btn-danger"  value="Eliminar" />
                            <input type='hidden' value='Clientes.php'> </form></td></tr>

                            <?php } ?>
                </table>

                <?php
            break;
            case 'Productos':
              echo "<br/>";
                echo "<form action='Productos.php' method='POST'>";
                echo "<input type='submit' name='opcion' class='btn btn-sm btn-success form-control' value='Nuevo' />
                    <input type='hidden' value='Clientes.php'></form>";
                echo "<br>";
                $cnn=conectar();
                $qry="select producto.cve_prod,desc_prod,pu_prod,umed_prod,existencia_renkar from producto join kardex  on producto.cve_prod=kardex.cve_prod join renglonkardex on kardex.cve_kar=renglonkardex.cve_kar where kardex.cve_tie=1";
                $consul=$cnn->query($qry);
                $i=0;
                while ($ren=$consul->fetch_array(MYSQL_ASSOC)) {
                $i++;
                setcookie("cookieProducto".$i,$i."#".$ren['cve_prod']."#".$ren["desc_prod"]."#".$ren['pu_prod']."#".$ren['umed_prod']."#".$ren['existencia_renkar']."#",time()+3600);
                }
                echo "<table border='1' align='center'>";
                echo "<tr>";
                echo "<td>ID</td>";
                echo "<td>Nombre</td>";
               echo  "<td>Precio</td>";
                echo "<td>U medida</td>";
                echo "<td>Existencia</td>";
                echo "<td>Acciones</td>";
                echo "</tr>";
                ?>
                <?php
                for ($j=1; $j <=$i ; $j++) { 
                $dato=explode("#", $_COOKIE['cookieProducto'.$j]);
                ?>

                <tr>
                <td> <?php echo $dato[1]?></td>
                <td><?php echo $dato[2]?></td>
                <td><?php echo $dato[3]?></td>
                <td><?php echo $dato[4]?></td>
                <td><?php echo $dato[5]?></td>
                            <td>
                             <form method="POST" action="Productos.php">
                              <input type="hidden" name="renglon" <?php echo "value='".$dato[1]."'"; ?> />
                            <input type="submit" name="opcion" class="btn btn-sm btn-success"  value="Detalles" />
                            <input type="submit" name="opcion" class="btn btn-sm btn-warning"  value="Modificar" />
                            <input type="submit" name="opcion" class="btn btn-sm btn-danger"  value="Eliminar" />
                            <input type='hidden' value='Clientes.php'> </form></td></tr>

                            <?php } ?>
                </table>
                <?php
                break;
        }
    }
    ?>
</body>
</html>