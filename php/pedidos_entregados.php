<?php

require_once '../clases/Prospectos.php';
require_once '../clases/Productos.php';
require_once '../clases/Pedidos.php';
require_once '../clases/UtilDB.php';

session_start();
setlocale(LC_ALL, 'es_MX');
//unset($_SESSION['cve_cliente']);
if (!isset( $_SESSION['cve_usuario'])) 
{
    header('Location:login.php');
    return;
}
else
{
     $idPrincipal=mysql_real_escape_string($_SESSION['cve_usuario']);
}

$clasf = new Prospectos();
$clasf2 = new Productos();
$clasf3 = new Pedidos();
$msg = "";
$count = NULL;

if (isset($_POST['xAccion'])) {
       
            if ($_POST['xAccion'] == 'logout')
    {   
        unset($_SESSION['cve_usuario']);
        header('Location:../index.php');
        return;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>MSF Store | Mis pedidos</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
               <!-- Bootstrap Core CSS -->
        <link href="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- MetisMenu CSS -->
        <link href="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"/>
        <!-- Custom CSS -->
        <link href="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/dist/css/sb-admin-2.css" rel="stylesheet"/>
        <!-- Custom Fonts -->
        <link href="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.css" rel="stylesheet"/>
        <link href="../css/modal.css" rel="stylesheet"/>
        <title>Mis Pedidos</title>
        <script src="../js/jQuery/jquery-1.11.2.min.js"></script>
        <script src="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.js"></script>
        <script src="../js/jQuery/jquery-ui-1.11.3/jquery.ui.datepicker-es-MX.js"></script>
        <script>

            $(document).ready(function () {

                $(".date-picker").datepicker();
                $.datepicker.setDefaults($.datepicker.regional[ "es-MX" ]);
                
                
                $("#cmbCveRito").change(function () {
                var cveRito = 0;
                cveRito = this.value;
                cargarCombo(cveRito);

            });



            });


            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtCveCliente").val("0");
                $("#pedidosEntrantes").submit();
            }



            function recargar()
            {
                $("#xAccion").val("recargar");
                $("#pedidosEntrantes").submit();

            }
            
             function valEmail(valor){
                  re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
                     if(!re.exec(valor))    {
                       return false;
                     }else{
                    return true;
                }
              }
      
    function logout()
        {
            $("#xAccion").val("logout");
            $("#pedidosEntrantes").submit();
        }
         
           function grabar( valor,paquete,guia)
            {
                if ($(paquete).val() !="" && $(guia).val() !="" )
                {
                 
                  $("#xAccion").val("grabar");
                  $("#guia").val($(guia).val());
                     $("#paqueteria").val($(paquete).val());
                    $("#xPedido").val(valor);
                   $("#pedidosEntrantes").submit();
                 }
                 else
                 {
                    alert("Es necesario que ingrese la paquetería y la guía de envío"); 
                 }
             }


        </script>
        
        
    </head>
    
    <div id="wrapper">
        
         <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Mis Pedidos</a>
                </div>
                <!-- /.navbar-header -->


                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                         <li>
                                <a href="cat_ritos.php" ><i class="fa fa-university"></i> Ritos</a>
                                 <a href="cat_clasificaciones.php" ><i class="fa fa-leaf"></i> Clasificaciones</a>
                                <a href="cat_grados.php"><i class="fa fa-crop"></i> Grados</a>
                                <a href="cat_clasificacion_productos.php"><i class="fa fa-tags"></i> Clasificación productos</a>
                                <a href="cat_productos.php"><i class="fa fa-truck"></i> Productos</a>
                                 <a href="pedidos_entrantes.php"><i class="fa fa-truck"></i> Nuevo Pedidos</a>
                                  <a href="pedidos_enviados.php"><i class="fa fa-truck"></i> Pedidos Enviados</a>
                                   <a href="pedidos_entregados.php"><i class="fa fa-truck"></i> Historial de Pedidos</a>
                                 <a href="lista_prospectos.php"><i class="fa fa-truck"></i> Lista de clientes</a>
                                 <a href="cat_reaton.php" class="active"><i class="fa fa-users"></i> Usuarios y contraseñas</a>
                                <a href="javascript:void(0);" onclick="logout();"><i class="fa fa-sign-out"></i> CERRAR SESIÓN</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper">
           <form role="form" name="pedidosEntrantes" id="pedidosEntrantes" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                          <input type="hidden" class="form-control" name="xPedido" id="xPedido" value="0" />
                          <input type="hidden" class="form-control" name="guia" id="guia" value="0" />
                          <input type="hidden" class="form-control" name="paqueteria" id="paqueteria" value="0" />
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Historial de Pedidos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
     <table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Pedido</th> 
            <th>Cliente</th>
             <th>Total</th>
              <th>Dirección Envío</th>
                 <th>Estatus</th>
              <th>Última Fecha de Actualización</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * from pedidos where status in (3)  order by fecha ";
        $rst = UtilDB::ejecutaConsulta($sql);
        if($rst->rowCount()>0)
        {
        foreach ($rst as $row) {
            $clasf = new Prospectos($row['cve_cliente']);

            ?>
            <tr>
                <th><?php echo( substr($row['fecha'],0,10));  ?></th>
                <th><?php echo($row['referencia']); ?></th>
                <th><?php echo($clasf->getNombre().' '.$clasf->getApellidoPat().' '.$clasf->getApellidoMat()); ?></th>
                <th><?php echo('$ '.number_format($row['monto_total'],  2 , '.' , ',' )); ?></th>
                <th><?php echo($row['direccion_envio']); ?></th>
                 <th>Entregado</th>
                <th><?php echo( substr($row['fecha_actualizacion'],0,10));  ?></th>
                <th><a href="#modal<?PHP echo $row['cve_pedido'];?>">Ver</a></th>
            </tr>
            <!-- ventana modal de envio-->

                
            <!--- fin de ventana modal de envío-->
            <!--ventana modal del elemento-->
            <div id="modal<?PHP echo($row['cve_pedido']); ?>" class="modalmask">
                <div class="modalbox resize">
                    <a href="#close" title="Close" class="close">X</a>
                    <h3 id="TituloModal">Detalle del Pedido</h3>
                    <div class="CeldaEncabezado" >
                       
                        <div class="CeldaEncabezadoModal1">Producto</div>
                        <div class="CeldaEncabezadoModal">Precio U.</div>
                        <div class="CeldaEncabezadoModal">Cantidad</div> 
                        <div class="CeldaEncabezadoModal">Total</div>
                       
                    </div>
                     <?php
        $sql2 = "SELECT * from detalle_pedido where cve_pedido=".$row['cve_pedido']." and cve_cliente=".$clasf->getCveCliente();
        $rst2 = UtilDB::ejecutaConsulta($sql2);
       
        if($rst2->rowCount()>0)
        {
        foreach ($rst2 as $row2) {
          $clasf2 = new Productos($row2['cve_producto']);
            ?>
                        <div id="LineaDetalle">
                            <div class="CeldaDetalleModal1"> <?php echo($clasf2->getNombre()); ?></div>
                            <div class="CeldaDetalleModal"><?php echo($row2['descuento']==0?('$ '.number_format($row2['precio_unitario'],  2 , '.' , ',' )):('$ '.number_format($row2['precio_unitario_desc'],  2 , '.' , ',' ))); ?> </div>
                            <div class="CeldaDetalleModal"><?php echo($row2['cantidad']); ?></div>
                            <div class="CeldaDetalleModal"><?php echo('$ '.number_format($row2['monto_total_pagar'],  2 , '.' , ',' )); ?></div>    
                    </div>
                     <?php }
        
        }
        else
        {
            ?>
                    <div>Aqui no hay datos</div>
                          <?php
            
        }
        $rst2->closeCursor(); ?>
                </div>

            
            </div>
    <!-- fin de ventana modal del elemento-->
        <?php }
        
        }
        else
        {
            ?>
             <tr>
                 <td colspan="7">No hay pedidos</td>
            </tr>
            <?php
            
        }
        $rst->closeCursor(); ?>

    </tbody>
</table>
               </form>
            </div>

    </div>
    <!---ventana Modal-->




<!--- fin de ventana modal-->
</body>
</html>
