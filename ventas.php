<?php

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


  $noCliente="";
  session_start();

   if(isset($_GET['destruir'])){
    unset($_SESSION['rfc_cli']);
    unset($_SESSION['renglonesVenta']);
  }

 
    if(isset($_GET['buscarProducto'])){//Si ha presionado el boton Buscar Producto
        if(isset($_SESSION['rfc_cli'])){////Si ya se agrego el RFC de algun cliente
           
        }else{
            $tamanio=$_COOKIE["cookietamanio"];
            $i=0;
            $bandera=0;
            $elementos="";
            while ($i<$tamanio){
                $elementos=explode("$",$_COOKIE['cookieClientes'.$i]);
                if($elementos[4]==$_GET['rfc_cli']){
                    $i=$tamanio;
                    $bandera=1;
                }
                $i++;
            }
                if($bandera>0){//Si sí enconctro al cliente
                    $_SESSION['rfc_cli']=$_GET['rfc_cli'];
                }else{
                    $noCliente="<label style='color: red;'>*No se ha encontrado al Cliente</label>";
                }
           
        }
        
    }

    
    date_default_timezone_set('America/Mexico_City'); 
    $fecha=$fecha=date("d")."/".date("m")."/".date("Y");
    $msgProducto="";
    $msgRenProd="";
    
    ?>

    <br/>
    <form method="GET" action="#" >
        <div class="row col-sm-offset-5 col-sm-4 " >
            <h4><label style="text-align: center;">VENTAS</label></h4>
        </div>

        
            <div class="row col-sm-offset-3 col-sm-6 " style="margin-bottom: 20px; ">
                <div class="col-sm-8">
                    Cliente:<input type='text'  name='rfc_cli' class='form-control' placeholder="RFC"  required=""  <?php if($_SESSION['rfc_cli']!=""){ echo "value='".$_SESSION['rfc_cli']."' readonly='readonly' ";  }; ?>/>

                    <?php if($noCliente!=""){ echo $noCliente;}; ?>

                </div>
                <div class="col-sm-4">
                    Fecha:<input type='text' readonly='readonly' name='fecha' class='form-control' <?php echo "value='".$fecha."'" ?> />
                 </div>
            </div>

            <div class="row col-sm-offset-5 col-sm-4 ">
                <div><label style='align: center;'>DETALLES DE LA VENTA</label></div>
            </div>
        
            <div class="row col-sm-offset-4 col-sm-4 " >
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="#" aria-describedby="basic-addon1" name="cve_prod" />
                  <span class="input-group-addon " id="basic-addon1"><input type="submit" name="buscarProducto" value="Buscar Producto" /></span>
                </div>
            </div>

            <div class="col-sm-offset-1 col-sm-10" style="margin-top: 5px; overflow: auto; height: 300px;">
                <table class='table table-bordered' style='width: 100%;'>                            
                    <tr style="background: #D65A31;">
                        <td><label>Cod.Bar</label></td>
                        <td><label>Producto</label></td>
                        <td><label>Cantidad</label></td>
                        <td><label>PU</label></td>
                        <td><label>Subtotal</label></td>
                        <td><label colspan='2' >Opciones</label></td>
                    </tr>
                    
            <?php
                if(isset($_SESSION['renglonesVenta'])){//Si la variable de session, ya existe si no pues la crea
                    //
                }else{
                    $_SESSION['renglonesVenta']="";
                }

                if($_SESSION['rfc_cli']!=""){//Si desde un inicio no hay un cliente asignado, pues no se pueden agregar productos a un cliente desconocido
                    if(isset($_GET['buscarProducto'])){//El producto va a ser buscado en la cookie de producto y agregado a la variable de session['renglonesVenta'] con status=0;
                        $i=0;
                        $posicion=-1;//La variable de la posicion me servira para posteriormente buscar el producto en la variable de session
                        while($i<$_COOKIE['cookietamanio3']){
                            
                            $elementosProducto=explode("$",$_COOKIE['cookieProductos'.$i]);
                            if(($elementosProducto[0]==$_GET['cve_prod']) && ($elementosProducto[5]==1)){//Si encuentra el producto y que ademas esté activo
                                
                                $posicion=$i;
                                $i=$_COOKIE['cookietamanio3'];
                            }
                            $i++;
                        }
                        if($posicion>-1){//Si si encontro el producto
                            if($_SESSION['renglonesVenta']!=""){//Sí la variable de session es diferente de vacio, despues que ya sepa que si tiene algo, entonces debo buscar que no exista el producto en la variable de session.
                                $elementosProducto=explode("$",$_COOKIE['cookieProductos'.$posicion]);
                                $i=0;
                                $elementosProdSession=explode("|",$_SESSION['renglonesVenta']);
                                $tamanioElementos=count($elementosProdSession);
                                while($i<$tamanioElementos){
                                    $subElementos=explode("$",$elementosProdSession[$i]);
                                    if($subElementos[0]==$elementosProducto[0]){//Si se cumple esta comparacion quiere decir que el producto ya existe en la variable de session por ende no es necesario volver a meterla
                                        $msgProducto="<label style='color: red;'>El producto ya ha sido agregado previamente!!</label>";
                                    }
                                    $i++;
                                }
                                if($msgProducto==""){//En este if se compara que el msgProducto siga siendo "" si no esta vacio es porque debe mostrar el mensaje
                                     $_SESSION['renglonesVenta'].=$_COOKIE['cookieProductos'.$posicion]."0$0$0$|";
                                }
                                     
                            }else{//la variable si esta vacia, entonces se le va a agregar su primer elemento
                                $_SESSION['renglonesVenta'].=$_COOKIE['cookieProductos'.$posicion]."0$0$0$|";//se le agrega la cantidad default 0,el importe 0, el status 0, es decir que no ah sido agregado a la venta
                            }
                        }else{
                            $msgProducto="<label style='color: red;'>El producto que busca no ha sido encontrado :(</label>";
                        }   
                        
                    }
                }






                /////////////////////////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //ESTA SECCION ESTA RESERVADA PARA LA OPCION DE ASIGNAR, PARA ASIGNAR EL RENGLON//////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(isset($_GET['btnAdd'])){
                    $auxiliar="";
                    $clave=$_GET['cveAction'];
                    $i=0;
                    $elementosProdSession=explode("|",$_SESSION['renglonesVenta']);
                    $cantidad=count($elementosProdSession)-1;
                    while($i<$cantidad){
                        $subElementos=explode("$",$elementosProdSession[$i]);
                        if($clave==$subElementos[0]){
                            if($_GET['cant_prod']<=$subElementos[4]){//Si la cantidad de productos que se desean asignar es menor o igual a las que hay en existencia
                                $subtotal=$_GET['cant_prod']*$subElementos[2];
                                $auxiliar.=$subElementos[0]."$".$subElementos[1]."$".$subElementos[2]."$".$subElementos[3]."$".$subElementos[4]."$".$subElementos[5]."$".$subElementos[6]."$".$_GET['cant_prod']."$".$subtotal."$1$|";
                            }else{
                                 $auxiliar.=$elementosProdSession[$i]."|";
                                 $msgRenProd="<label style='color: red;'>La cantidad de ".$subElementos[1]." que desea vender es mayor a la existencia, la cantidad actual es: ".$subElementos[4]."</label>";
                            }
                        }else{
                            $auxiliar.=$elementosProdSession[$i]."|";
                        }
                        $i++;
                    }
                    $_SESSION['renglonesVenta']=$auxiliar;
                }



                 /////////////////////////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////ESTA SECCION ESTA RESERVADA PARA LA OPCION DE MODIFICAR AL RENGLON//////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(isset($_GET['btnModif'])){
                    $auxiliar="";
                    $clave=$_GET['cveAction'];
                    $i=0;
                    $elementosProdSession=explode("|",$_SESSION['renglonesVenta']);
                    $cantidad=count($elementosProdSession)-1;
                    while($i<$cantidad){
                        $subElementos=explode("$",$elementosProdSession[$i]);
                        if($clave==$subElementos[0]){
                                $subtotal=$_GET['cant_prod']*$subElementos[2];
                                $auxiliar.=$subElementos[0]."$".$subElementos[1]."$".$subElementos[2]."$".$subElementos[3]."$".$subElementos[4]."$".$subElementos[5]."$".$subElementos[6]."$".$_GET['cant_prod']."$".$subtotal."$0$|";
                        }else{
                            $auxiliar.=$elementosProdSession[$i]."|";
                        }
                        $i++;
                    }
                    $_SESSION['renglonesVenta']=$auxiliar;
                }





                /////////////////////////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////ESTA SECCION ESTA RESERVADA PARA LA OPCION DE ELIMINAR AL RENGLON//////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(isset($_GET['btnEliminar'])){
                    $auxiliar="";
                    $clave=$_GET['cveAction'];
                    $i=0;
                    $elementosProdSession=explode("|",$_SESSION['renglonesVenta']);
                    $cantidad=count($elementosProdSession)-1;
                    while($i<$cantidad){
                        $subElementos=explode("$",$elementosProdSession[$i]);
                        if($clave==$subElementos[0]){
                            //Si la encuentra, se elimina por omision
                        }else{
                            $auxiliar.=$elementosProdSession[$i]."|";
                        }
                        $i++;
                    }
                    $_SESSION['renglonesVenta']=$auxiliar;
                }





                ////////////////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////////////
                //DE AQUI HACIA ABAJO, COMIENZA LA CONSTRUCCION DE LOS RENGLONES DE VENTAS EN BASE A LA SESSION//
                ///////////////////////////////////////////////////////////////////////////////////////////////
                //Esto siempre se va a ejecutar, va a ser lo ultimo que se ejecute, lo anterior solo va a modificar este resultado
                
                $total=0;
                $renglonesProdSession=explode("|",$_SESSION['renglonesVenta']);
                $tamanio=count($renglonesProdSession)-1;
                $i=0;

                //echo "Tamanio: ".$tamanio." renglonesVenta: ".$_SESSION['renglonesVenta'];
                while($i<$tamanio){
                    $elementosProdSession=explode("$",$renglonesProdSession[$i]);
                    $total+=$elementosProdSession[8];
                    ?>
                    <tr>
                    <form method="GET" action="#">
                        <input type="hidden" name="cveAction"  <?php echo "value='".$elementosProdSession[0]."'";?>/>
                        <td><?php echo $elementosProdSession[0]; ?></td>
                        <td><?php echo $elementosProdSession[1]; ?></td>
                        <td><input type="text" required="" name="cant_prod" <?php if($elementosProdSession[9]==1){ echo "readonly='readonly' value='".$elementosProdSession[7]."'" ;} ?>  <?php if(($elementosProdSession[3]=="kg") |($elementosProdSession[3]=="lts") ){ echo "pattern='[0-9]+([.])?([0-9]+)?'" ;} else{echo "pattern='[0-9]+'" ;} ?> /></td> <!--La condicion de este TD es que si el status de la variable de session es 1, quiere decir que debe estar de solo lectura y que su value es igual a la antepenultima posicion que es donde se le va a agregar el valor, el subtotal es la penúltima. -->
                        <td><?php echo $elementosProdSession['2'];?></td>
                        <td><input type="text" readonly="readonly" placeholder="$0.00"  name="subtotal" <?php if($elementosProdSession[9]==1){ echo "value='$".$elementosProdSession[8]."'" ;} ?> /></td>
                        <td><?php if($elementosProdSession[9]==0){ ?> <input type="submit" name="btnAdd" class="btn btn-success" value="Enviar" /> <?php }else{ ?> <input type="submit" name="btnModif" class="btn btn-warning" value="Modificar"/> <input type="submit" name="btnEliminar" class="btn btn-danger" value="Eliminar"/> <?php } ?> </td>
                    </form>
                    <tr>
                    <?php
                    $i++;
                }
            ?>
            <tr style="background: gray;">
                <td colspan="4">
                    <label>Total:</label>
                </td>
                <td colspan="2">
                    <label>$<?php echo $total; ?></label>
                </td>
            </tr>
        </table>
        <?php if($msgProducto!=""){ echo $msgProducto;}?>
        <?php if($msgRenProd!=""){ echo $msgRenProd;}?>
 <form method="GET" method="#">
    <input type="submit" name="destruir" value="Cancelar Venta" class="btn btn-danger" />
    <input type="submit" name="Guardar" value="Guardar Venta" class="btn btn-info" />
</form>


    <?php
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //////////ESTE APARTADO ES PARA GUARDAR LAS VENTAS EN LA BASE DE DATOS//////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if(isset($_GET['Guardar'])){
            $cnn=conectar();
            $renglonesProdSession=explode("|",$_SESSION['renglonesVenta']);
            $cantidad=count($renglonesProdSession);
            if($cantidad>1){
                $cve_cli=0;
                $cveKar=0;
                $i=0;
                $total=0;
                while($i<$cantidad){
                    $subElementos=explode("$",$renglonesProdSession[$i]);
                    if($subElementos[9]==1){
                        $total+=$subElementos[8];
                    }
                    $i++;
                }
                $rfc=$_SESSION['rfc_cli'];
                $qryx="select cve_cli from cliente where rfc_cli='$rfc';";
                $consulx=$cnn->query($qryx);
                while($renx=$consulx->fetch_array(MYSQL_ASSOC)){
                    $cve_cli=$renx['cve_cli'];
                }

                $qry1="insert into venta values(null,curdate(), $total, $cve_cli);";
                
                $cnn->query($qry1);
                $cve_venta=$cnn->insert_id;


                ///////////////////////////////////////////////////////////////////
                ////////insertar los renglones de la venta/////////////////////
                $j=0;
                while($j<$cantidad){
                    $subElementos=explode("$",$renglonesProdSession[$j]);
                    if($subElementos[9]==1){
                        $nomProd=$subElementos[1];
                        $cantProd=$subElementos[7];
                        $pu=$subElementos[2];
                        $cveProd=$subElementos[0];

                        ////////////////////busca el kardex
                        $qrykardex="select cve_kar from kardex where cve_prod='$cveProd';";
                        $consulkardex=$cnn->query($qrykardex);
                        while($renkar=$consulkardex->fetch_array(MYSQL_ASSOC)){
                            $cveKar=$renkar['cve_kar'];
                        }

                        ///////////RESTA DE RENGLONKARDEX
                        
                        $nuevaExistencia=$subElementos[4]-$cantProd;
                        $qryrenkar="insert into renglonkardex values(null,'V',now(), $cantProd, $nuevaExistencia, $cveKar);";
                        $cnn->query($qryrenkar);

                        $qryxz="insert into renglonventa values(null,'$nomProd', $cantProd, $pu, '$cveProd' , $cve_venta);";
                        
                        $cnn->query($qryxz);
                    }
                    $j++;
                }
                unset($_SESSION['rfc_cli']);
                unset($_SESSION['renglonesVenta']);
                echo "<label style='color: red;' >Venta almacenada con éxito :) !!!</label>";
            }else{
                echo "<label style='color: red;' >No ha insertado datos aún</label>";
            }
        }

        
    ?>

