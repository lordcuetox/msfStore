<!--
/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
-->

<?php
require_once 'clases/UtilDB.php';
require_once 'clases/ShoppingCart.php';
require_once 'clases/Prospectos.php';
require_once 'clases/Productos.php';
require_once 'clases/Pedidos.php';
require_once 'clases/DetallePedido.php';
session_start();
define("MIN_SLIDES_OFERTA", 3);
define("GASTOS_ENVIO", 180);
$pedido_guardado = false;
$prospecto = NULL;
$cart = NULL;
$pedido = NULL;
$pedido2 = NULL;
$detalle_pedido = NULL;
$item = NULL;
$subto = 0.0;
$suma = 0.0;

if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'logout') {
        unset($_SESSION['habilitado']);
        unset($_SESSION['nombre_completo']);
        unset($_SESSION['carro']);
    }
}

if (isset($_POST['xAccionPedido'])) {
    if ($_POST['xAccionPedido'] == 'finalizarPedido') {

        if (isset($_SESSION['carro'])) {
            $cart = unserialize($_SESSION['carro']);
            if (!$cart->isEmpty()) {
                $pedido = new Pedidos();
                $prospecto = new Prospectos();
                $prospecto->cargar2($_SESSION['habilitado']);
                $pedido->setCveCliente($prospecto->getCveCliente());
                $pedido->setDireccionEnvio(htmlspecialchars($_POST['txtDireccionEnvio']));
                $pedido->setStatus(1);
                $pedido->setMontoTotal(0.0);
                $pedido->grabar();


                foreach ($cart as $arr) {
                    $item = $arr['item'];
                    $subto = $arr['qty'] * $item->getPrecio();
                    $suma = $suma + $subto;

                    $detalle_pedido = new DetallePedido();
                    $detalle_pedido->setCve_cliente($pedido->getCveCliente());
                    $detalle_pedido->setCve_pedido($pedido->getCvePedido());
                    $detalle_pedido->setCve_rito($item->getCveRito());
                    $detalle_pedido->setCve_clasificacion($item->getCveClasificacion());
                    $detalle_pedido->setCve_grado($item->getCveGrado());
                    $detalle_pedido->setCve_clas_producto($item->getCveClasProducto());
                    $detalle_pedido->setCve_producto($item->getCveProducto());
                    $detalle_pedido->setEtiqueta_producto($item->getNombre());
                    $detalle_pedido->setCantidad((int) $arr['qty']);
                    $detalle_pedido->setPrecio_unitario($item->getPrecioUnitario());
                    $detalle_pedido->setDescuento($item->getOferta());
                    $detalle_pedido->setPrecio_unitario_desc($item->getPrecioOferta());
                    $detalle_pedido->setMonto_total_pagar($subto);
                    $detalle_pedido->grabar();
                }
                $suma = $suma + GASTOS_ENVIO;

                $pedido2 = new Pedidos($pedido->getCvePedido());
                $pedido2->setMontoTotal($suma);
                $pedido2->setReferencia(str_replace("-", "", substr($pedido2->getFecha(), 0, 10)) . "_000" . $pedido->getCvePedido());
                $pedido2->grabar();
                unset($_SESSION['carro']);
                $pedido_guardado = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>MSF Store | Todo para el Mason, Todo para su logia</title>
        <meta charset="utf-8">
        <meta name="author" content="WEBXICO and Cuetox">
        <meta name="description" content="Masoneria Sin Fronteras Store, Todo para el Mason, Todo para su logia.">
        <meta name="keywords" content="arreos, masoneria, mason, store, tienda">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="twbs/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="js/jQuery/plugins/jquery.bxslider/jquery.bxslider.css" rel="stylesheet"/>
        <link href="css/msfstore.css" rel="stylesheet"/>
        <style>
            span.glyphicon-shopping-cart {
                font-size: 1.2em;
            }
        </style>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->
        <script src="js/jQuery/jquery-1.11.2.min.js"></script>
        <script src="twbs/bootstrap-3.3.2/js/bootstrap.min.js"></script>
        <script src="js/jQuery/plugins/jquery.bxslider/jquery.bxslider.min.js"></script>
        <script src="js/index.js"></script>
        <script>
            var mDetalleProducto = false;
            var mResumenCarritoCompras = false;
            var mFinalizarPedido = false;
            var mMessage = false;

            $(document).ready(function () {
                $.ajaxSetup({"cache": false});

                $('div#ofertas ul.bxslider').bxSlider({
                    mode: "vertical",
                    adaptiveHeight: true,
                    pager: false,
                    controls: false,
                    auto: true,
                    minSlides: <?php echo(MIN_SLIDES_OFERTA); ?>,
                    autoHover: true,
                    speed: 5000,
                    slideMargin: 15,
                    moveSlides: <?php echo(MIN_SLIDES_OFERTA); ?>});

                $('body').on('hidden.bs.modal', '.modal', function () {
                    $(this).removeData('bs.modal');
                });
                
                $('#mDetalleProducto').on('shown.bs.modal', function (e) {
                    mDetalleProducto  = true;
                    console.log('#mDetalleProducto');
                });

                $('#mResumenCarritoCompras').on('shown.bs.modal', function (e) {
                    mResumenCarritoCompras = true;
                    console.log('#mResumenCarritoCompras');
                    if(mDetalleProducto)
                    { $('#mDetalleProducto').modal('hide'); }
                });

                $('#mFinalizarPedido').on('shown.bs.modal', function (e) {
                    FinalizarPedido = true;
                    console.log('#mFinalizarPedido');
                    if(mResumenCarritoCompras)
                    { $('#mResumenCarritoCompras').modal('hide'); }
                });
                
                $('#mMessage').on('shown.bs.modal', function (e) {
                    mMessage = true;
                });
                
                $('#mDetalleProducto').on('hidden.bs.modal', function (e) {
                    mDetalleProducto  = false;
                });

                $('#mResumenCarritoCompras').on('hidden.bs.modal', function (e) {
                    mResumenCarritoCompras = false;
                });

                $('#mFinalizarPedido').on('hidden.bs.modal', function (e) {
                    FinalizarPedido = false;
                });
                
                $('#mMessage').on('hidden.bs.modal', function (e) {
                    mMessage = false;
                });

<?php
if ($pedido_guardado) {
    ?>
                    //window.open('php/recibo.php?P=<?php echo($pedido2->getCvePedido()); ?>', '_blank');
                    $('#mMessage').modal("show");
    <?php
}
?>
            });

        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-right" id="iconos_redes_sociales">
                    <a href="https://www.facebook.com/MSFStore" target="_blank"><img src="img/Facebook-icon.png" class="img-responsive " alt="Facebook"/></a>
                    <a href="https://twitter.com/masinfronteras" target="_blank"><img src="img/Twitter-icon.png" class="img-responsive" alt="Twitter"/></a>
                    <a href="mailto:msf_store@hotmail.com"><img src="img/Email-icon.png" class="img-responsive" alt="Email"/></a>
                </div>
                <div class="col-md-12" id="logo">
                    <img src="img/encabezado3.png" alt="Logo MSF Store" class="img-responsive"/>
                </div>
                <div class="col-md-12 text-right" id="enlaces">
                    <?php
                    if (!isset($_SESSION['habilitado']) && !isset($_SESSION['nombre_completo'])) {
                        ?>
                        <span class="glyphicon glyphicon-log-in"></span>&nbsp;<a href="php/login_cliente.php" target="_self">Iniciar sesión</a>
                        <span class="glyphicon glyphicon-user"></span>&nbsp;<a href="php/cat_prospectos.php" target="_self">Registro</a>
                        <?php
                    } else {
                        ?>
                        <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;<a href="javascript:void(0);" data-toggle="modal" data-remote="php/viewShoppingCart.php" data-target="#mResumenCarritoCompras">Carrito de compras</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="glyphicon glyphicon-user"></span>&nbsp;<a href="php/mis_pedidos.php" target="_blank"><?php echo($_SESSION['nombre_completo']); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="glyphicon glyphicon-log-out"></span>&nbsp;<a href="javascript:void(0);" onclick="logout();">Cerrar Sesión</a>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="index.php">MSF Store</a>
                            </div>
                            <div>
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="index.php">Inicio</a></li>
                                    <?php
                                    $sql = "SELECT * FROM ritos WHERE activo = 1 ORDER BY descripcion";
                                    $rst = UtilDB::ejecutaConsulta($sql);
                                    foreach ($rst as $row) {
                                        $sql2 = "SELECT * FROM clasificaciones WHERE cve_rito =" . $row['cve_rito'] . " AND activo = 1";
                                        $rst2 = UtilDB::ejecutaConsulta($sql2);

                                        if ($rst2->rowCount() > 0) {
                                            $tmp = "<li class=\"dropdown\">";
                                            $tmp .= "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">" . $row['descripcion'] . "<span class=\"caret\"></span></a>";
                                            $tmp .= "<ul class=\"dropdown-menu\">";
                                            foreach ($rst2 as $row2) {
                                                $tmp .="<li><a href=\"javascript:void(0);\" onclick=\"getGrados(" . $row2['cve_rito'] . "," . $row2['cve_clasificacion'] . ",'" . ($row['descripcion'] . " / " . $row2['descripcion']) . "');\">" . $row2['descripcion'] . "</a></li>";
                                            }
                                            $rst2->closeCursor();
                                            $tmp .= "</ul>";
                                            $tmp .= "</li>";
                                            echo($tmp);
                                        } else {
                                            echo("<li><a href=\"#\">" . $row['descripcion'] . "</a></li>");
                                        }
                                    }
                                    $rst->closeCursor();
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-9" id="novedades">
                    <h1>LOS MÁS VENDIDOS</h1>
                    <div class="row">
                        <?php
                        $sql2 = "SELECT * FROM productos WHERE novedad = 1 AND ruta_imagen1 IS NOT NULL AND fecha_novedad >= NOW() AND activo = 1 LIMIT 6";
                        $rst2 = UtilDB::ejecutaConsulta($sql2);
                        $tmp2 = "";
                        $count1 = 0;

                        if ($rst2->rowCount() > 0) {
                            foreach ($rst2 as $row2) {
                                $tmp2 .= "<div class=\"col-md-4\">";
                                $tmp2 .= "<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-remote=\"php/productos_id.php?id=" . $row2['cve_producto'] . "&from=novedad\" data-target=\"#mDetalleProducto\">";
                                $tmp2 .= "<img src=\"" . $row2['ruta_imagen1'] . "\" class=\"img-responsive\" alt=\"" . $row2['nombre'] . "\"/>";
                                $tmp2 .= "</a>";
                                $tmp2 .= "<h4>" . $row2['nombre'] . "</h4>";
                                $tmp2 .= "</div>";
                                $count1++;
                                if ($count1 % 3 == 0) {
                                    $tmp2.="<div class=\"clearfix visible-sm\"></div>";
                                    $tmp2.="<div class=\"clearfix visible-md\"></div>";
                                    $tmp2.="<div class=\"clearfix visible-lg\"></div>";
                                }
                            }
                        } else {
                            $tmp2 .= "<div class=\"col-md-12 text-center\">Lo sentimos, en este momento no hay productos en novedad.</div>";
                        }
                        $rst2->closeCursor();
                        echo($tmp2);
                        ?>
                    </div>
                </div>
                <div class="col-md-3" id="grados" style="display: none;">&nbsp;</div>
                <div class="col-md-6" id="productos" style="display: none;">&nbsp;</div>
                <div class="col-md-3 text-center" id="ofertas">
                    <h1>¡OFERTAS!</h1>
                    <?php
                    $sql3 = "SELECT * FROM productos WHERE oferta = 1 AND ruta_imagen1 IS NOT NULL AND fecha_oferta >= NOW() AND activo = 1";
                    $rst3 = UtilDB::ejecutaConsulta($sql3);
                    $rowCount = $rst3->rowCount();
                    $tmp3 = "";

                    if ($rowCount > 0) {
                        if ($rowCount > MIN_SLIDES_OFERTA) {
                            $tmp3 .= "<ul class=\"bxslider\">";
                            foreach ($rst3 as $row3) {
                                $tmp3 .= "<li>";
                                $tmp3 .= "<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-remote=\"php/productos_id.php?id=" . $row3['cve_producto'] . "&from=ofertas\" data-target=\"#mDetalleProducto\">";
                                $tmp3 .= "<img src=\"" . $row3['ruta_imagen1'] . "\" class=\"img-responsive\" title =\"" . $row3['nombre'] . "\" alt=\"" . $row3['nombre'] . "\"/>";
                                $tmp3 .= "</a>";
                                $tmp3 .= "<h4 style=\"text-align:center\">" . $row3['nombre'] . "</h4>";
                                $tmp3 .= "</li>";
                            }
                            $tmp3 .= "</ul>";
                        } else {
                            foreach ($rst3 as $row3) {
                                $tmp3 .= "<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-remote=\"php/productos_id.php?id=" . $row3['cve_producto'] . "&from=ofertas\" data-target=\"#mDetalleProducto\">";
                                $tmp3 .= "<img src=\"" . $row3['ruta_imagen1'] . "\" class=\"img-responsive\" title =\"" . $row3['nombre'] . "\" alt=\"" . $row3['nombre'] . "\"/>";
                                $tmp3 .= "</a>";
                                $tmp3 .= "<h4 style=\"text-align:center\">" . $row3['nombre'] . "</h4>";
                            }
                        }
                    } else {
                        $tmp3 .= "<p>Lo sentimos, en este momento no hay productos en oferta.<p/>";
                    }
                    $rst3->closeCursor();
                    echo($tmp3);
                    ?>
                </div>
                <div class="col-md-12" id="ventana_modal">
                    <div class="modal fade" id="mDetalleProducto" tabindex="-1" role="dialog" aria-labelledby="mDetalleProductoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="ventana_modal2">
                    <div class="modal fade" id="mResumenCarritoCompras" tabindex="-1" role="dialog" aria-labelledby="mDetalleProductoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="ventana_modal3">
                    <div class="modal fade" id="mFinalizarPedido" tabindex="-1" role="dialog" aria-labelledby="mDetalleProductoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="ventana_modal4">
                    <div class="modal fade" id="mMessage" tabindex="-1" role="dialog" aria-labelledby="mDetalleProductoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Recibo de MSF Store</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="te">
                                        <div class="alert alert-success" role="alert">
                                            <strong>Pedido registrado con exito, puede acceder a su recibo de MSF Store desde <a href="php/recibo.php?P=<?php echo($pedido2 != NULL ? $pedido2->getCvePedido() : 0); ?>" target="_blank">aqui</a>.</strong> <span class="glyphicon glyphicon-ok"></span><span class="glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <p class="text-center">Calle 2 de Abril Nº. 233, Col. Nueva Villahermosa, Villahermosa, Tabasco <!--| Tel. 312 67 00, 312 67 01--> | Cel. 9932772575</p>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <form action="<?php echo($_SERVER['PHP_SELF']) ?>" name="frmLogOut" id="frmLogOut" method="post"><input type="hidden" name="xAccion" id="xAccion"value="0" /></form> 
                <p class="text-muted text-center">Copyright <?php echo date("Y"); ?>| Masoneria Sin Fronteras Store| Powered By WEBXICO & Cuetox</p>
            </div>
        </footer>
    </body>
</html>