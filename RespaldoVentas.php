<?php

  $noCliente="";
  session_start();
  if(isset($_GET['destruir'])){
    session_destroy();
  }
    if(isset($_GET['opcionVentas'])){//Si ha presionado el boton Buscar Producto
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
                  <input type="text" class="form-control" placeholder="#" aria-describedby="basic-addon1" name="cve_prod" required=""/>
                  <span class="input-group-addon " id="basic-addon1"><input type="submit" name="opcionVentas" value="Buscar Producto" /></span>
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
                        $msgprod="";
                       if(isset($_GET['opcionVentas'])){//Si ha presionado el botón Buscar Producto

                        $nuevaCookie="";
                        if($noCliente==""){//Si el cliente si existió
                        $bandera=0;
                                if(isset($_SESSION['renglonesVenta'])){
                                    //echo "si hay renglones";
                                }else{
                                    $_SESSION["renglonesVenta"]="";
                                }


                                $i=0;
                                $posicion=-1;
                                $elementos="";
                                while( ($i<$_COOKIE['cookietamanio3']) && ($posicion==-1) ) {//ciclo para buscar algun producto
                                    $elementos=explode("$", $_COOKIE['cookieProductos'.$i]);
                                    if(($elementos[0]==$_GET['cve_prod']) && ($elementos[5]==1)){
                                        $posicion=$i;
                                        $i=$_COOKIE['cookietamanio3'];
                                    }
                                    $i++;
                                }
                                if($posicion!=-1){//Si sí enconctro el producto
                                    if($_SESSION['renglonesVenta']!=""){//Si los renglonesVentas ya tienen almenos algun producto agregado
                                        
                                        $claves=explode("$",$_SESSION['renglonesVenta']);
                                        $cont=count($claves);
                                        $i=0;
                                        while(($i<$cont) && ($bandera==0)){//Busca que la clave no este en la lista de claves
                                            $claves2=explode("#",$claves[$i]);
                                            if($_GET['cve_prod']==$claves2[0]){//Sí la clave si está cambio una bandera para indicar que ya no debo agregar esa clave a los renglones
                                                $bandera=1;
                                                $msgprod="<label style='color: red;'>*El producto que desea agregar, ya fue incluído previamente.</label>";

                                            }
                                            $i++;
                                        }
                                        if($bandera==0){//Si no se encontró esa clave agregada
                                            $_SESSION["renglonesVenta"].=$elementos[0]."#0#$";
                                        }
                                    }else{
                                        $_SESSION["renglonesVenta"]=$elementos[0]."#0#$";//Se le fija el primer elemento a los renglones
                                    }
                                }else{
                                    $msgprod="<label style='color: red;'>*El producto que busca no fue encontrado.</label>";
                                }

                                if($_SESSION['renglonesVenta']!=""){
                                    $claves=explode("$", $_SESSION['renglonesVenta']);
                                    $tamanio=count($claves);
                                    $cveAndCant="";
                                    $cont=0;
                                    $total=0;
                                    $importe=0;
                                    while($cont<$tamanio){
                                        $cont2=0;
                                        while($cont2<$_COOKIE['cookietamanio3']){
                                            $productos=explode("$", $_COOKIE['cookieProductos'.$cont2]);
                                            $cveAndCant=explode("#",$claves[$cont]);
                                            //Si existe algun input con el name='cant_prod'con la misma clave que la que se está comparando, entonces:
                                            //la cadena de cookierenglonesVenta en su parte de cantidad(cve_prod#cant_prod#$) debe de reasignarse la cantidad que 
                                            //se digitó en el input, para esto se utilizara una cadena auxiliar que irá retomando los valores y al final se
                                            //sutituira todo lo de la cadena original con lo de la nueva cadena.
                                            //Los input quedaran como de solo lectura. 
                                            
                                            if($cveAndCant[0]==$productos[0]){//Sí la clave de producto es igual a alguno de los productos que tengo en las cookies
                                                $nuevaCookie.=$cveAndCant[0]."#".$_GET['cant_prod'.$cveAndCant[0]]."#$";                                               
                                                ?>
                                                <tr>
                                                <td><?php echo $productos[0]; ?></td>
                                                <td><?php echo $productos[1]; ?></td>
                                                <td><input type="text" <?php  echo "name='cant_prod".$cveAndCant[0]."'";?> <?php "value='".$cveAndCant[1]."'";?> <?php if(isset($_GET['cant_prod'.$cveAndCant[0]])){echo "readonly='readonly' value='".$_GET['cant_prod'.$cveAndCant[0]]."'";} ?>  ></td>
                                                <td>$<?php echo $productos[2]; ?></td>
                                                <?php 
                                                $importe=$_GET['cant_prod'.$cveAndCant[0]]*$productos[2];
                                                $total=$total+$importe;
                                                ?> 
                                                <td><input type="text"  readonly="readonly" <?php echo "value='$".$importe."'";?>  /></td>

                                                </form>

                                                <form method="GET" action="#">
                                                <td>
                                                <input type='hidden' name='renglon'  <?php echo "value='".$productos[0]."'"?> />
                                                <input type='submit' name='btnElimiarRenVenta' class='btn btn-sm btn-warning' value='Modificar'/>
                                                <input type='submit' name='btnElimiarRenVenta' class='btn btn-sm btn-danger' value='Eliminar'/> </form></td>
                                                </tr>
                            <?php 

                                            }
                                            $cont2++;
                                        }
                                        $cont++;
                                    }
                                   // setcookie('cookienueva',$nuevaCookie,time()+3600);
                                    //setcookie("cookieaux",$nuevaCookie,time()+3600);
                                    $_SESSION['renglonesVenta']=$nuevaCookie;
                                    ?>
                                    <tr style="background: gray;">
                                        <td colspan="4"><label>Total:</label></td>
                                        <td colspan="2"><label >$<?php echo $total; ?></label></td>
                                    </tr>
                                    <?php

                                    if($msgprod!=""){//Si msgProd tiene algo  para imprimir
                                        echo $msgprod;
                                    }


                                } 

                            }
                        }else{
                            //Eliminara la cookie y dira que el producto no existe
                        }
                        
                    ?>      

                </table>
                <form method="GET" method="#">
                    <input type="submit" name="destruir" value="Destruir" class="btn -btn-danger" />
                </form>
            </div>
    
<?php

?>
