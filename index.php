<!--
/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
-->

<?php
require_once './clases/UtilDB.php';
session_start();
define("MIN_SLIDES_OFERTA", 4);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="twbs/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="js/jQuery/plugins/jquery.bxslider/jquery.bxslider.css" rel="stylesheet"/>
        <link href="css/msfstore.css" rel="stylesheet"/>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->
        <script src="js/jQuery/jquery-1.11.2.min.js"></script>
        <script src="twbs/bootstrap-3.3.2/js/bootstrap.min.js"></script>
        <script src="js/jQuery/plugins/jquery.bxslider/jquery.bxslider.min.js"></script>
        <script>
            $(document).ready(function () {
                $.ajaxSetup({"cache": false});

                $('div#ofertas ul.bxslider').bxSlider({
                    mode: "vertical",
                    pager: false,
                    auto: true,
                    minSlides: <?php echo(MIN_SLIDES_OFERTA);?>,
                    autoHover: true,
                    speed: 3000,
                    slideMargin: 15,
                    moveSlides: <?php echo(MIN_SLIDES_OFERTA);?>});

                $('body').on('hidden.bs.modal', '.modal', function () {
                    $(this).removeData('bs.modal');
                });

                $('#myModal').on('shown.bs.modal', function (e) {
                    $('div.te ul.bxslider').bxSlider({adaptiveHeight: true});
                });


            });

            function getGrados(cveRito, cveClasificacion, nombreClasificacion)
            {
                $("#grados").load("index_ajax.php", {"xAccion": "getGrados", "cveRito": cveRito, "cveClasificacion": cveClasificacion, "nombreClasificacion": nombreClasificacion}, function (responseTxt, statusTxt, xhr) {
                    $("#novedades").css("display", "none");
                    //$("#ventana_modal").css("display", "none");
                    $("#grados").css("display", "block");
                    $("#productos").css("display", "block");

                });
            }

            function getProductos(cveRito, cveClasificacion, cveGrado, cveClasProducto, nombreClasProducto)
            {
                $("#productos").load("index_ajax.php", {"xAccion": "getProductos", "cveRito": cveRito, "cveClasificacion": cveClasificacion, "cveGrado": cveGrado, "cveClasProducto": cveClasProducto, "nombreClasProducto": nombreClasProducto}, function (responseTxt, statusTxt, xhr) {

                    $('body').on('hidden.bs.modal', '.modal', function () {
                        $(this).removeData('bs.modal');
                    });

                });
            }

            function addToShoppingCart(cve_producto)
            {
                $("#ajax_msg").load("php/agregacar.php", {"xCveProducto": cve_producto});
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12">
                    <header>
                        <div class="row">
                            <div class="col-md-8"><img src="img/encabezado.jpg" alt="MSF Store" class="img-responsive"/></div>
                            <div class="col-md-4 text-right">
                                <a href="https://www.facebook.com/MSFStore" target="_blank"><img src="img/facebook.png" class="img-responsive " alt="Facebook" style="display: inline; margin-right: 25px;"/></a>
                                <a href="https://twitter.com/masinfronteras" target="_blank"><img src="img/twitter.png" class="img-responsive" alt="Twitter" style="display: inline; margin-right: 25px;"/></a>
                                <a href="mailto:msf_store@hotmail.com"><img src="img/email.png" class="img-responsive" alt="Email" style="display: inline; margin-right: 25px;"/></a>
                            </div>
                            <div class="clearfix visible-md"></div>
                            <div class="col-md-offset-8"></div>
                            <div class="col-md-4 bottom text-right"><a href="javascript:void(0);" data-toggle="modal" data-remote="php/viewShoppingCart.php" data-target="#myModal"><img src="img/vercarrito.gif" alt="Ver carrito de compras"/> Carrito de compras</a></div>
                            <div class="clearfix visible-md"></div>
                        </div>
                    </header>
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
                                    $sql = "SELECT * FROM ritos ORDER BY descripcion";
                                    $rst = UtilDB::ejecutaConsulta($sql);
                                    foreach ($rst as $row) {
                                        $sql2 = "SELECT * FROM clasificaciones WHERE cve_rito =" . $row['cve_rito'];
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
                    <h1>Novedades</h1>
                    <div class="row">
                        <?php
                        $sql2 = "SELECT * FROM productos WHERE novedad = 1 AND ruta_imagen1 IS NOT NULL AND fecha_novedad >= NOW()";
                        $rst2 = UtilDB::ejecutaConsulta($sql2);
                        $tmp2 = "";
                        $count1 = 0;

                        if ($rst2->rowCount() > 0) {
                            foreach ($rst2 as $row2) {
                                $tmp2 .= "<div class=\"col-md-4\">";
                                $tmp2 .= "<img src=\"" . $row2['ruta_imagen1'] . "\" class=\"img-responsive\" alt=\"" . $row2['nombre'] . "\"/>";
                                $tmp2 .= "<h4>" . $row2['nombre'] . "</h4>";
                                $tmp2 .= "<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-remote=\"php/productos_id.php?id=" . $row2['cve_producto'] . "&from=novedad\" data-target=\"#myModal\" class=\"btn btn-custom\">Ver descripción</a>";
                                $tmp2 .= "</div>";
                                $count1++;
                                if ($count1 % 3 == 0) {
                                    $tmp2.="<div class=\"clearfix visible-sm\"></div>";
                                    $tmp2.="<div class=\"clearfix visible-md\"></div>";
                                    $tmp2.="<div class=\"clearfix visible-lg\"></div>";
                                }
                            }
                        } else {
                            $tmp2 .= "<div class=\"col-md-12\">Lo sentimos, en este momento no hay productos en novedad.</div>";
                        }
                        $rst2->closeCursor();
                        echo($tmp2);
                        ?>
                    </div>
                </div>
                <div class="col-md-3" id="grados" style="display: none;">&nbsp;</div>
                <div class="col-md-6" id="productos" style="display: none;">&nbsp;</div>
                <div class="col-md-3" id="ofertas">
                    <h1 class="text-center">Ofertas</h1>
                    <?php
                    $sql3 = "SELECT * FROM productos WHERE oferta = 1 AND ruta_imagen1 IS NOT NULL AND fecha_oferta >= NOW()";
                    $rst3 = UtilDB::ejecutaConsulta($sql3);
                    $rowCount = $rst3->rowCount();
                    $tmp3 = "";

                    if ($rowCount > 0) {
                        if ($rowCount > MIN_SLIDES_OFERTA) {
                            $tmp3 .= "<ul class=\"bxslider\">";
                            foreach ($rst3 as $row3) {
                                $tmp3 .= "<li>";
                                $tmp3 .= "<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-remote=\"php/productos_id.php?id=" . $row3['cve_producto'] . "&from=ofertas\" data-target=\"#myModal\">";
                                $tmp3 .= "<img src=\"" . $row3['ruta_imagen1'] . "\" class=\"img-responsive\" title =\"" . $row3['nombre'] . "\" alt=\"" . $row3['nombre'] . "\"/>";
                                $tmp3 .= "</a>";
                                $tmp3 .= "<h4 style=\"text-align:center\">" . $row3['nombre'] . "</h4>";
                                $tmp3 .= "</li>";
                            }
                            $tmp3 .= "</ul>";
                        } else {
                            foreach ($rst3 as $row3) {
                                $tmp3 .= "<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-remote=\"php/productos_id.php?id=" . $row3['cve_producto'] . "&from=ofertas\" data-target=\"#myModal\">";
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
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <p class="text-center">Calle 2 de Abril Nº. 233 Villahermosa, Tab. <!--| Tel. 312 67 00, 312 67 01--> | Cel. 9932772575</p>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted text-center">Copyright 2015| Masoneria Sin Fronteras Store| Powered By WEBXICO & Cuetox</p>
            </div>
        </footer>
    </body>
</html>