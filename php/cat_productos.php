<?php
require_once '../clases/Productos.php';
require_once '../clases/UtilDB.php';
session_start();

if (!isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}

$clasf = new Productos();
$count = NULL;
$msg = "";

if (isset($_POST['txtCveProducto'])) {
    if ($_POST['txtCveProducto'] != 0) {
        $clasf = new Productos($_POST['txtCveProducto']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {

        $fn = strtotime(str_replace('/', '-', ($_POST['txtFechaNovedad'] . " " . "00:00:00")));
        $fo = strtotime(str_replace('/', '-', ($_POST['txtFechaOferta'] . " " . "00:00:00")));


        $fNovedad = date('Y-m-d H:i:s', $fn);
        $fOferta = date('Y-m-d H:i:s', $fo);

        $clasf->setCveRito($_POST['cmbCveRito']);
        $clasf->setCveClasificacion($_POST['ajaxCmb']);
        $clasf->setCveGrado($_POST['cmbGrado']);
        $clasf->setCveClasProducto($_POST['cmbClasProducto']);
        $clasf->setNombre($_POST['txtNombre']);
        $clasf->setDescripcion($_POST['txtDescripcion']);
        $clasf->setPrecio($_POST['txtPrecio']);
        $clasf->setPrecioOferta($_POST['txtPrecioOferta']);
        $clasf->setFechaNovedad($fNovedad);
        $clasf->setFechaOferta($fOferta);
        $clasf->setExistencias($_POST['txtExistencias']);
        $clasf->setNovedad(isset($_POST['cbxNovedad']) ? "1" : "0");
        $clasf->setOferta(isset($_POST['cbxOferta']) ? "1" : "0");
        $clasf->setActivo(isset($_POST['cbxActivo']) ? "1" : "0");

        $count = $clasf->grabar();
        if ($count != 0) {
            $msg = "Producto grabado con exito!";
        } else {
            $msg = "[ERROR] Producto  no grabado";
        }
    }
    if ($_POST['xAccion'] == 'logout') {
        unset($_SESSION['cve_usuario']);
        header('Location:login.php');
        return;
    }
}

if (isset($_POST['xAccion2'])) {
    if ($_POST["xAccion2"] == "upload") {

        $cve_producto = isset($_POST['xCveProducto']) ? $_POST['xCveProducto'] : 0;
        $num_imagen = isset($_POST["xNumImagen"]) ? $_POST["xNumImagen"] : 0;
        $target_dir = "../img/productos/";

        /* RENOMBRADO DEL ARCHIVO CON LA CVE_PRODUCTO */
        $name_file = basename($_FILES["fileToUpload"]["name"]);
        $extension = substr($name_file, strpos($name_file, "."), strlen($name_file));
        $new_name_file = $cve_producto ."_".$num_imagen. $extension;
        $target_file = $target_dir . $new_name_file;
        /* RENOMBRADO DEL ARCHIVO CON LA CVE_PRODUCTO */

        //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $msg.= "El archivo es una imagen - " . $check["mime"] . ".\n";
            $exito = true;
        } else {
            $msg.= "El archivo no es una imagen.\n";
            $exito = false;
        }

        if (file_exists($target_file)) {
            //$msg.= "Sorry, file already exists.\n";
            //$uploadOk = 0;
            unlink($target_file);
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $msg.= "Lo sentimos, su archivo es demasiado grande.\n";
            $exito = false;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $msg.= "Lo sentimos, solo archivos JPG, JPEG, PNG y GIF son permitidos.\n";
            $exito = false;
        }
        if ($uploadOk == 0) {
            $msg.= "Lo sentimos, su archivos no fue cargado al servidor.\n";
            $exito = false;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $msg.= "El archivo " . basename($_FILES["fileToUpload"]["name"]) . " ha sido cargado al servidor.\n";
                $sql = "UPDATE productos SET ruta_imagen" . $num_imagen . " = '" . (substr($target_file, 3, strlen($target_file))) . "' WHERE cve_producto = $cve_producto";
                $count = UtilDB::ejecutaSQL($sql);
                ;

                if ($count != 0) {
                    $msg.= "[OK] SQL UPDATE\n";
                    $exito = true;
                } else {
                    $msg.= "Lo sentimos, hubo un error SQL UPDATE.\n";
                    $exito = false;
                }
            } else {
                $msg.= "Lo sentimo, ha ocurrido un error al cargar su archivo al servidor.\n";
                $exito = false;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>MSF Store Admin| Catálogo de Productos</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.css" rel="stylesheet"/>
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
                <a class="navbar-brand" href="index.html">MSF Store Admin</a>
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
                            <a href="cat_productos.php"  class="active"><i class="fa fa-truck"></i> Productos</a>
                            <a href="cat_reaton.php"><i class="fa fa-users"></i> Usuarios y contraseñas</a>
                             <a href="lista_prospectos.php"><i class="fa fa-truck"></i> Lista de clientes</a>
                            <a href="javascript:void(0);" onclick="logout();"><i class="fa fa-sign-out"></i> CERRAR SESIÓN</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Catálogo de Productos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row" >
                <div class="col-sm-4">&nbsp;</div>
                <div class="col-sm-4">
                    <form role="form" name="frmProductos" id="frmProductos" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveProducto" name="txtCveProducto" placeholder="ID Grado" value="<?php echo($clasf->getCveProducto()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="cmbCveRito">* Rito:</label>
                            <select name="cmbCveRito" id="cmbCveRito" class="form-control" placeholder="Rito">
                                <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
<?php
$sql2 = "SELECT * FROM ritos ORDER BY cve_rito";
$rst2 = UtilDB::ejecutaConsulta($sql2);
foreach ($rst2 as $row) {
    echo("<option value='" . $row['cve_rito'] . "' " . ($clasf->getCveRito() != 0 ? ($clasf->getCveRito() == $row['cve_rito'] ? "selected" : "") : "") . ">" . $row['descripcion'] . "</option>");
}
$rst2->closeCursor();
?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ajaxCmb">* Clasificacion:</label>
                            <select name="ajaxCmb" id="ajaxCmb" class="form-control" placeholder="Clasificacion" disabled>
                                <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>


                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cmbGrado">* Grado:</label>
                            <select name="cmbGrado" id="cmbGrado" class="form-control" placeholder="Grado" disabled>
                                <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>


                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cmbClasProducto">* Clasificación del Producto:</label>
                            <select name="cmbClasProducto" id="cmbClasProducto" class="form-control" placeholder="Clasificacion del Producto" disabled>
                                <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>


                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">* Producto:</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" 
                                   placeholder="Nombre" value="<?php echo($clasf->getNombre()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">* Descripción del Producto:</label>
                            <textarea class="form-control" rows="4" cols="50" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción del Producto"><?php echo($clasf->getDescripcion()); ?></textarea>                         
                        </div>
                        <div class="form-group">
                            <label for="txtPrecio">* Precio:</label>
                            <input type="text" class="form-control" id="txtPrecio" name="txtPrecio" 
                                   placeholder="0.0" value="<?php echo($clasf->getPrecio()); ?>">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="cbxNovedad" name="cbxNovedad" value="1" checked="<?php echo($clasf->getCveProducto() != 0 ? ($clasf->getNovedad() == 1 ? "checked" : "") : "checked"); ?>"> ¿Es novedad?
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="date-form">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label for="txtFechaNovedad">Fecha límite como novedad:</label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <input id="txtFechaNovedad" name="txtFechaNovedad" type="text" class="date-picker form-control"  value="<?php echo(substr(str_replace('-', '/', $clasf->getFechaNovedad()), 0, 10)); ?>"/>
                                                <label for="txtFechaNovedad" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="cbxOferta" name="cbxOferta" value="1" checked="<?php echo($clasf->getCveProducto() != 0 ? ($clasf->getOferta() == 1 ? "checked" : "") : "checked"); ?>"> ¿Lo establecerá como oferta?
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="txtPrecioOferta">Precio de oferta</label>
                            <input type="text" class="form-control" id="txtPrecioOferta" name="txtPrecioOferta" 
                                   placeholder="0.0" value="<?php echo($clasf->getPrecioOferta()); ?>">
                        </div>
                        <div class="form-group">
                            <div class="date-form">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label for="txtFechaOferta">Fecha límite de la oferta:</label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <input id="txtFechaOferta" name="txtFechaOferta" type="text" class="date-picker form-control"  value="<?php echo(substr(str_replace('-', '/', $clasf->getFechaOferta()), 0, 10)); ?>"/>
                                                <label for="txtFechaOferta" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtExistencias">Existencias</label>
                            <input type="text" class="form-control" id="txtExistencias" name="txtExistencias" 
                                   placeholder="0" value="<?php echo($clasf->getExistencias()); ?>">
                            <label for="txtExistencias">* Campos Obligatorios</label>  
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="cbxActivo" name="cbxActivo" value="1" checked="<?php echo($clasf->getCveProducto() != 0 ? ($clasf->getActivo() == 1 ? "checked" : "") : "checked"); ?>"> Activo
                            </label>
                        </div>
                        <button type="button" class="btn btn-default" id="btnLimpiar" name="btnLimpiar" onclick="limpiar();">Limpiar</button>
                        <button type="button" class="btn btn-default" id="btnGrabar" name="btnGrabar" onclick="grabar();">Enviar</button>
                    </form>
                    <br/>
                    <br/>
                    <div class="<?php echo($count != 0 ? "alert alert-success" : "alert alert-danger"); ?>" style="<?php echo($count == NULL ? "display:none;" : "display:block;"); ?>"><?php echo($msg); ?></div>
                    <br/>
                    <br/>
                </div>
                <div class="col-sm-4">&nbsp;</div>
            </div>
            <div class="row" >
                <!-- Aqui se cargan los datos vía AJAX-->
                <div class="col-sm-12" id="ajax">&nbsp;</div>
                <div class="col-sm-12">
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Subir imagen</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="te">
                                        <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" id="frmUpload" name="frmUpload">
                                            <div class="form-group">
                                                <input type="hidden" id="xCveProducto" name="xCveProducto" value="0" />
                                                <input type="hidden" id="xNumImagen" name="xNumImagen" value="0" />
                                                <input type="hidden" id="xAccion2" name="xAccion2" value="0" />
                                                <label for="fileToUpload">Seleccione imagen para subir:</label>
                                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" placeholder="Seleccione una imagen">
                                            </div>
                                            <button type="button" class="btn btn-default" id="btnGrabar" name="btnGrabar" onclick="subir();">Subir</button>
                                        </form>
                                        <br/>
                                        <br/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.js"></script>
    <script src="../js/jQuery/jquery-ui-1.11.3/jquery.ui.datepicker-es-MX.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/dist/js/sb-admin-2.js"></script>
    <script>
        $(document).ready(function () {

            $(".date-picker").datepicker();
            $.datepicker.setDefaults($.datepicker.regional[ "es-MX" ]);



            $("#cmbCveRito").change(function () {
                var cveRito = 0;
                cveRito = this.value;
                cargarCombo(cveRito);

            });

            $("#ajaxCmb").change(function () {
                //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                cargarComboGrado($("#cmbCveRito").val(), this.value);

            });
            $("#cmbGrado").change(function () {
                //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                cargarComboClasProducto($("#cmbCveRito").val(), $("#ajaxCmb").val(), this.value);

            });
            $("#cmbClasProducto").change(function () {
                //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                cargarMuestra($("#cmbCveRito").val(), $("#ajaxCmb").val(), $("#cmbGrado").val(), this.value);

            });

            var Rito = $("#cmbCveRito").val();
            if (Rito !== 0)
            {
                cargarCombo2(Rito,<?php echo($clasf->getCveClasificacion() ) ?>,<?php echo($clasf->getCveGrado() ) ?>,<?php echo($clasf->getCveClasProducto() ) ?>);
            }


        });

        function logout()
        {
            $("#xAccion").val("logout");
            $("#frmProductos").submit();
        }


        function cargarMuestra(cveRito, cveClasificacion, cveGrado, cveClasProducto)
        {   //En el div con id 'ajax' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

            $("#ajax").load("cat_productos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion, "cveGrado": cveGrado, "cveClasProducto": cveClasProducto}, function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success")
                {
                    $('[data-toggle="popover"]').popover({placement: 'top', html: true, trigger: 'click hover'});
                }
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
            });
        }

        function cargarCombo(cveRito)
        {   //En el div con id 'ajaxCmb' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

            $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php", {"cveRito": cveRito}, function (responseTxt, statusTxt, xhr) {
                $("#ajaxCmb").attr({'disabled': false});
            });
            cargarCombo2($("#cmbCveRito").val(), $("#ajaxCmb").val(), 0, 0);
        }
        function cargarCombo2(cveRito, cveClasificacion, cveGrado, cveClasProducto)
        {   //En el div con id 'ajaxCmb' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

            $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                $("#ajaxCmb").attr({'disabled': false});
                cargarComboGrado2(cveRito, cveClasificacion, cveGrado, cveClasProducto);
            });
        }

        function cargarComboGrado2(cveRito, cveClasificacion, cveGrado, cveClasProducto)
        {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

            $("#cmbGrado").load("cat_grados_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion, "cveGrado": cveGrado}, function (responseTxt, statusTxt, xhr) {
                $("#cmbGrado").attr({'disabled': false});
                cargarComboClasProducto2(cveRito, cveClasificacion, cveGrado, cveClasProducto)
            });
        }

        function cargarComboGrado(cveRito, cveClasificacion)
        {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

            $("#cmbGrado").load("cat_grados_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                $("#cmbGrado").attr({'disabled': false});
            });
            cargarComboClasProducto(cveRito, cveClasificacion, 0)
        }

        function cargarComboClasProducto(cveRito, cveClasificacion, cveGrado)
        {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

            $("#cmbClasProducto").load("cat_clasificacion_productos_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion, "cveGrado": cveGrado}, function (responseTxt, statusTxt, xhr) {
                $("#cmbClasProducto").attr({'disabled': false});
                cargarMuestra($("#cmbCveRito").val(), $("#ajaxCmb").val(), $("#cmbGrado").val(), $("#cmbClasProducto").val());
            });
        }
        function cargarComboClasProducto2(cveRito, cveClasificacion, cveGrado, cveClasProducto)
        {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

            $("#cmbClasProducto").load("cat_clasificacion_productos_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion, "cveGrado": cveGrado, "cveClasProducto": cveClasProducto}, function (responseTxt, statusTxt, xhr) {
                $("#cmbClasProducto").attr({'disabled': false});
                cargarMuestra($("#cmbCveRito").val(), $("#ajaxCmb").val(), $("#cmbGrado").val(), $("#cmbClasProducto").val());
            });
        }

        function limpiar()
        {
            $("#xAccion").val("0");
            $("#txtCveProducto").val("0");
            $("#frmProductos").submit();
        }

        function grabar()
        {
            if ($("#cmbCveRito").val() > 0 && $("#ajaxCmb").val() > 0 && $("#cmbGrado").val() > 0 && $("#cmbClasProducto").val() > 0 && $("#txtNombre").val() != "" && $("#txtDescripcion").val() != "" && $("#txtPrecio").val() > 0)
            {
                $("#xAccion").val("grabar");
                $("#frmProductos").submit();
            }
            else
            {
                alert("Es necesario capturar los campos indicados como obligatorios");
            }

        }

        function recargar()
        {
            $("#xAccion").val("recargar");
            $("#frmProductos").submit();

        }

        function subir()
        {
            if ($("#fileToUpload").val() !== "")
            {
                $("#xAccion2").val("upload");
                $("#frmUpload").submit();
            }
        }

    </script>
</body>
</html>