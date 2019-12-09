
   
<?php
    
     session_start();
    
    if (isset($_GET['usuario'])) {
        $datosUsuario=explode("$",$_GET['usuario']);
        $nombre=$datosUsuario[0];
        $password=$datosUsuario[1];
        $tipoUsu=$datosUsuario[2];
        $_SESSION['tipousu']=$tipoUsu;
        $_SESSION['usuario']=$nombre;
        $_SESSION['opcionMenu']="";
        $_SESSION['loop']=0;
    }
    if(isset($_GET['tienda'])){
        $_SESSION['tiendaxyz']=$_GET['tienda'];
    } 





    if( (isset($_GET['datosClientes']))){


             

            ////////////////////////////////////////////////////////////////////////////
            /////////CARGANDO A CLIENTE
            $datosClientes=explode("|",$_GET['datosClientes']);
            $tamanio=count($datosClientes)-1;
            setcookie("cookietamanio", $tamanio ,time()+3600);
            $i=0;
            while ($i <=$tamanio ) {
                setcookie("cookieClientes".$i, $datosClientes[$i] ,time()+3600);
                $i++;
            }

            ////////////////////////////////////////////////////////////////////////////
            /////////CARGANDO A PROVEEDOR
            $datosProv=explode("|",$_GET['datosProveedor']);
            $tamanio2=count($datosProv)-1;
            setcookie("cookietamanio2", $tamanio2 ,time()+3600);
            $j=0;
            while ($j <=$tamanio2 ) {
                setcookie("cookieProveedor".$j, $datosProv[$j] ,time()+3600);
                $j++;
            }
            
          ////////////////////////////////////////////////////////////////////////////
            /////////CARGANDO A USUARIO
            $datosUsu=explode("|",$_GET['datosUsuarios']);
            $tamanio4=count($datosUsu)-1;
            setcookie("cookietamanio4", $tamanio4 ,time()+3600);
            $b=0;
            while ($b <=$tamanio4 ) {
                setcookie("cookieUsuario".$b, $datosUsu[$b] ,time()+3600);
                $b++;
            }

            ////////////////////////////////////////////////////////////////////////////
            /////////CARGANDO KIT

            $datoskit=explode("|",$_GET['datoskit']);
            $tamanio5=count($datoskit)-1;
            setcookie("cookietamanio5", $tamanio5 ,time()+3600);
            $d=0;
            while ($d <=$tamanio5 ) {
                setcookie("cookieKit".$d, $datoskit[$d] ,time()+3600);
                $d++;
            }

}


if(isset($_GET['datosProductos'])){
     ////////////////////////////////////////////////////////////////////////////
            /////////CARGANDO A PRODUCTOS
    
            $datosProd=explode("|",$_GET['datosProductos']);
            $tamanio3=count($datosProd)-1;
            setcookie("cookietamanio3", $tamanio3 ,time()+3600);
            $a=0;
            while ($a <=$tamanio3 ) {
                setcookie("cookieProductos".$a, $datosProd[$a] ,time()+3600);
                $a++;
            }
}

?>
<html>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">  
</head>
<body style="background: #eeeeee;">
    
       
    <!--<form method="GET" action="http://192.168.0.12/Unidad3Dario/proyectoVacaciones/datos.php" style="margin-top: 0px;">-->
    <form method="GET" action="#" style="padding: 30px; background: #222831">
    <div class="container">
        <div class="row col-sm-10">
            <?php if($_SESSION['tipousu']==1){
                ?>
            <input type="submit" name="opcionMenu" value="Usuarios" class="btn btn-primary" style="width:13%; background: #393e46; padding: 10px; color: white;"  />
            <?php } ?>
            <input type="submit" name="opcionMenu" value="Clientes" class="btn btn-primary" style="width:13%; background: #393e46; padding: 10px; color: white;"  />
             <input type="submit" name="opcionMenu" value="Productos" class="btn btn-primary" style="width:13%; background: #393e46; padding: 10px; color: white;"  />
             <input type="submit" name="opcionMenu" value="Resurtir" class="btn btn-primary" style="width:13%; background: #393e46; padding: 10px; color: white;" />
            <input type="submit" name="opcionMenu" value="Proveedores" class="btn btn-primary" style="width:13%; background: #393e46; padding: 10px; color: white;" />
              <input type="submit" name="opcionMenu" value="Ventas" class="btn btn-primary" style="width:13%; background: #393e46; padding: 10px; color: white;" />
              <input type="submit" name="opcionMenu" value="Kits" class="btn btn-primary" style="width:13%; background: #393e46; padding: 10px; color: white;" />
            
             
              
        </div>
        <div class="row col-sm-2">
            <div class="row col-sm-4"><h4 style="color: white;"><?php echo $_SESSION['usuario']; ?></h4></div>
            <div class="row col-sm-offset-1 col-sm-7">
                <input type="submit" name="salir" value="Salir" class="btn btn-danger" style="width:100%; background: #393e46; padding: 5px; color: white;" />
            </div>
            
            
        </div>

    </div>


    </form>

                <?

                    if(isset($_GET['salir'])){
                        echo "Entro a salir";
                        session_destroy();
                        header("Location:login.php");
                        
                    }
                    
                    if(isset($_GET['opcionMenu'])){
                        $_SESSION['opcionMenu']=$_GET['opcionMenu'];
                    }

                            switch ($_SESSION['opcionMenu']) {
                                     case "Usuarios":
                                    ?>
                                        <h2 align="center">USUARIOS</h2>
                                 <form method="GET" action="Usuarios.php">
                                        <input type="submit" name="opcion" value="Nuevo" class='btn btn-sm btn-success' style="margin-left: 5%;" >
                                    </form>
                                    <?php
                                    $tamanio=$_COOKIE['cookietamanio4'];
                                    
                                   
                                    ?>
                                    <div style="overflow: auto; width: 95%; height: 220px;" >
                                    <table class='table table-striped' style='width: 90%; margin-left: 5%; '>
                                     <tr style="background: gray;">
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Rfc</td>
                                    <td>Mail</td>
                                    <td>direccion</td>
                                    <td>Telefono</td>
                                    <td>Login</td>
                                    <td>Password</td>
                                    <td>Status</td>
                                    <td>Acciones</td>
                                    </tr>
                                    <?php
                                    $dato="";
                                    for ($j=0; $j<$tamanio ; $j++) { 
                                    $dato=explode("$", $_COOKIE['cookieUsuario'.$j]);
                                    if($dato[10]==0){
                                        $css="style='background:#FC4B3E;'";
                                    ?>
                                    <tr <?=$css?> >
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]." ".$dato[2]." ".$dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><?php echo $dato[6]; ?></td>
                                    <td><?php echo $dato[7]; ?></td>
                                    <td><?php echo $dato[8]; ?></td>
                                    <td><?php echo $dato[9]; ?></td>
                                    <td><?php echo $dato[10]; ?></td>
                                    <td>
                             <form method="GET" action="Usuarios.php" >
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'";?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-info' value='Activar'/> </form></td>
                                    </tr>
                <?php }else{?> 
                            <tr> 
                         <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]." ".$dato[2]." ".$dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><?php echo $dato[6]; ?></td>
                                    <td><?php echo $dato[7]; ?></td>
                                    <td><?php echo $dato[8]; ?></td>
                                    <td><?php echo $dato[9]; ?></td>
                                    <td><?php echo $dato[10]; ?></td>
                                    <td>
                             <form method="GET" action="Usuarios.php" >
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'";?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-danger' value='Eliminar'/> </form></td>
                                    </tr>

                <?php } } ?>
                            </table> </div>
                <?php

break;
                                case "Clientes":
                                    ?>
                                    <!--<form method="GET" <?php// echo "action='http://192.168.0.12/Unidad3Dario/proyectoVacaciones/".$_GET['opc']."'"; ?>>-->
                                        <h2 align="center">CLIENTES</h2>
                  <form method="GET" action="Clientes.php">
                                        <input type="submit" name="opcion" value="Nuevo" class='btn btn-sm btn-success' style="margin-left: 5%;" >
                                    </form>
                                    <?php
                                    
                                    $tamanio=$_COOKIE['cookietamanio'];
                                    $i=0;
                                    ?>
                                    <div style="overflow: auto; width: 95%; height: 220px;" >
                                    <table class='table table-striped' style='width: 90%; margin-left: 5%;'>
                                     <tr style="background: gray;">
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Rfc</td>
                                    <td>Mail</td>
                                    <td>direccion</td>
                                    <td>Telefono</td>
                                    <td>Status</td>
                                    <td>Acciones</td>
                                    </tr>
                                    <?php
                                    $dato="";
                                    for ($j=0; $j<$tamanio ; $j++) {
                                    $dato=explode("$", $_COOKIE['cookieClientes'.$j]);
                                    if($dato[8]==0){
                                        $css="style='background:#FC4B3E;'";
                                    ?>
                                    <tr <?= $css ?>>
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]." ".$dato[2]." ".$dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><?php echo $dato[6]; ?></td>
                                    <td><?php echo $dato[7]; ?></td>
                                    <td><?php echo $dato[8]; ?></td>
                                    <td><form method="GET" action="Clientes.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-info' value='Activar'/> </form></td>
                                    </tr>
                <?php }else{ ?>  
                             <tr>
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]." ".$dato[2]." ".$dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><?php echo $dato[6]; ?></td>
                                    <td><?php echo $dato[7]; ?></td>
                                    <td><?php echo $dato[8]; ?></td>
                                    <td><form method="GET" action="Clientes.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-danger' value='Eliminar'/> </form></td>
                                    </tr>
                    <?php } } ?>
                                    </table></div>
                <?php
                                    break;
                                
                                case "Proveedores":
                                    ?>
                                    <!--<form method="GET" <?php// echo "action='http://192.168.0.12/Unidad3Dario/proyectoVacaciones/".$_GET['opc']."'"; ?>>-->
                                        <h2 align="center">PROVEEDORES</h2>
                                <form method="GET" action="Proveedores.php">
                                        <input type="submit" name="opcion" value="Nuevo" class='btn btn-sm btn-success' style="margin-left: 5%;" >
                                    </form>
                                    <?php
                                    $tamanio=$_COOKIE['cookietamanio2'];
                                
                                    ?>
                                    <div style="overflow: auto; width: 95%; height: 220px;" >
                                    <table class='table table-striped' style='width: 90%; margin-left: 5%; '>
                                     <tr style="background: gray;">
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Rfc</td>
                                    <td>Mail</td>
                                    <td>direccion</td>
                                    <td>Telefono</td>
                                    <td>Status</td>
                                    <td>Acciones</td>
                                    </tr>
                                    <?php
                                    $dato="";
                                    for ($j=0; $j<$tamanio ; $j++) {
                                    $dato=explode("$", $_COOKIE['cookieProveedor'.$j]);
                                      if($dato[8]==0){
                                        $css="style='background:#FC4B3E;'";
                                    ?>
                                    <tr <?= $css ?>>
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]." ".$dato[2]." ".$dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><?php echo $dato[6]; ?></td>
                                    <td><?php echo $dato[7]; ?></td>
                                    <td><?php echo $dato[8]; ?></td>
                                    <td><form method="GET" action="Proveedores.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-info' value='Activar'/> </form></td>
                                    </tr>
                                    <?php }else{ ?> 
                                    <tr>
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]." ".$dato[2]." ".$dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><?php echo $dato[6]; ?></td>
                                    <td><?php echo $dato[7]; ?></td>
                                    <td><?php echo $dato[8]; ?></td>
                                    <td><form method="GET" action="Proveedores.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-danger' value='Eliminar'/> </form></td>
                                    </tr>
                                        <?php } } ?>
                                    </table></div>
                                    <?php
                          break;

                            case "Productos":
                                    ?>
                                  <!--  <form method="GET" <?php// echo "action='http://192.168.0.12/Unidad3Dario/proyectoVacaciones/".$_GET['opc']."'"; ?>>-->
                                    <h2 align="center">PRODUCTOS</h2>
                                    <form method="GET" action="Productos.php">
                                        <input type="submit" name="opcion" value="Nuevo" class='btn btn-sm btn-success' style="margin-left: 5%;" >
                                    </form>
                                    <?php
                                    $tamanio=$_COOKIE['cookietamanio3'];
                                
                                   
                                    ?>
                                    <div style="overflow: auto; width: 95%; height: 220px;" >
                                    <table class='table table-striped' style='width: 95%; margin-left: 5%; '>
                                     <tr style="background: gray;">
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Precio</td>
                                    <td>U Medida</td>
                                    <td>Existencia</td>
                                    <td>Status</td>
                                    <td>Acciones</td>
                                    </tr>
                                    <?php
                                    $dato="";
                                    for ($j=0; $j<$tamanio ; $j++) {
                                    $dato=explode("$", $_COOKIE['cookieProductos'.$j]);
                                      if($dato[5]==0){
                                        $css="style='background:#FC4B3E;'";
                                    ?>
                                    <tr <?= $css ?>>
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]; ?></td>
                                    <td><?php echo $dato[2]; ?></td>
                                    <td><?php echo $dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><form method="GET" action="Productos.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-info' value='Activar'/> </form></td>
                                    </tr>
                <?php }else{ ?>
                         <tr >
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]; ?></td>
                                    <td><?php echo $dato[2]; ?></td>
                                    <td><?php echo $dato[3]; ?></td>
                                    <td><?php echo $dato[4]; ?></td>
                                    <td><?php echo $dato[5]; ?></td>
                                    <td><form method="GET" action="Productos.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-warning'  value='Modificar' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-danger' value='Eliminar'/> </form></td>
                                    </tr>
               <?php  } } ?>
                                    </table></div>
                <?php
                                    break;

                        case 'Kits':
                                    ?>
                                      <h2 align="center">Kits</h2>
                                    <form method="GET" action="Kits.php">
                                        <input type="submit" name="opcion" value="Nuevo" class='btn btn-sm btn-success' style="margin-left: 7%;" >
                                    </form>
                                    <?php
                                    $tamanio=$_COOKIE['cookietamanio5'];
                                    ?>

                                    <div style="overflow: auto; width: 65%; height: 220px;" >
                                    <table class='table table-striped' style='width: 90%; margin-left: 10%; '>
                                     <tr style="background: gray;">
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Status</td>
                                    <td>Acciones</td>
                                    </tr>
                                    <?php
                                    $dato="";
                                    for ($j=0; $j<$tamanio ; $j++) {
                                    $dato=explode("$", $_COOKIE['cookieKit'.$j]);
                                     if($dato[2]==0){
                                        $css="style='background:#FC4B3E;'";
                                    ?>
                                    <tr <?= $css ?> >
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]; ?></td>
                                    <td><?php echo $dato[2]; ?></td>
                                    <td>
                        <form method="GET" action="Kits.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-info'  value='Activar' /></form></td>
                                    </tr>
                <?php }else{ ?>
                         <tr>
                                    <td><?php echo $dato[0]; ?></td>
                                    <td><?php echo $dato[1]; ?></td>
                                    <td><?php echo $dato[2]; ?></td>
                                    <td>
                                     <form method="GET" action="Kits.php">
                                    <input type='hidden' name='renglon'  <?php echo "value='".$dato[0]."'"?> /> 
                                    <input type='submit' name='opcion' class='btn btn-sm btn-success'  value='Detalles' />
                                    <input type='submit' name='opcion' class='btn btn-sm btn-danger' value='Eliminar1'/> </form></td>
                                    </tr>
               <?php  } } ?>
                                    </table></div>
                                    <?
                                    break;
                                case "Ventas":
                                        require_once('ventas.php');
                                    break;
                                 case "Resurtir":
                                        require_once('resurtir.php');
                                    break;
                            }
                        
                     if (isset($_GET['resultadoClientes'])) {
                        ?>
                       <!-- <form method="GET"  <?php //echo "action='http://192.168.0.12/Unidad3Dario/proyectoVacaciones/Clientes.php'"; ?>>--><form method="GET" action="Clientes.php">
                        <?php
                        echo $_GET['resultadoClientes'];
                        ?>
                        </form>

                        <?php
                    }
                ?>
                <?php
                 if (isset($_GET['resultadoProveedores'])) {
                        ?>
                       <!-- <form method="GET"  <?php // echo "action='http://192.168.0.12/Unidad3Dario/proyectoVacaciones/Proveedores.php'"; ?>>-->
                        <form method="GET" action="Proveedores.php">
                        <?php
                        echo $_GET['resultadoProveedores'];
                        ?>
                        </form>

                        <?php
                    }
                ?>

                      <?php
                 if (isset($_GET['resultadoProductos'])) {
                        ?>9
                            <form method="GET" action="Productos.php">
                        <?php
                        echo $_GET['resultadoProductos'];
                        ?>
                        </form>

                        <?php
                    }
                ?>
                    <?php
                 if (isset($_GET['resultadoUsuarios'])) {
                        ?>
                            <form method="GET" action="Usuarios.php">
                        <?php
                        echo $_GET['resultadoUsuarios'];
                        ?>
                        </form>

                        <?php
                    }
                ?>
               


                  <?php
                 if (isset($_GET['resultadoKits'])) {
                        ?>
                            <form method="GET" action="Kits.php">
                        <?php
                        echo $_GET['resultadoKits'];
                        ?>
                        </form>
                        <?php
                    }
                ?>


</body>
</html>