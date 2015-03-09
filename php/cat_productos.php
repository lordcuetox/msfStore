<?php
require_once '../clases/Productos.php';
require_once '../clases/UtilDB.php';

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
}

if (isset($_POST['xAccion2'])) {
    if ($_POST["xAccion2"] == "upload") {

        $cve_producto = isset($_POST['xCveProducto']) ? $_POST['xCveProducto'] : 0;
        $num_imagen = isset($_POST["xNumImagen"]) ? $_POST["xNumImagen"] : 0;
        $target_dir = "../img/productos/";

        /* RENOMBRADO DEL ARCHIVO CON LA CVE_PRODUCTO */
        $name_file = basename($_FILES["fileToUpload"]["name"]);
        $extension = substr($name_file, strpos($name_file, "."), strlen($name_file));
        $new_name_file = $cve_producto . $extension;
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
                $sql = "UPDATE productos SET ruta_imagen" . $num_imagen . " = '".(substr($target_file,3, strlen($target_file)))."' WHERE cve_producto = $cve_producto";
                $count = UtilDB::ejecutaSQL($sql);;

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
        <title>MSF Store | Catálogo de Productos</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../twbs/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.css" rel="stylesheet"/>
    </head>
    <div class="container">
        <div class="row" >
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">
                <h3>Catálogo de Productos</h3>
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
                            <div class="modal-body"><div class="te"></div></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <script src="../js/jQuery/jquery-1.11.2.min.js"></script>
    <script src="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.js"></script>
    <script src="../js/jQuery/jquery-ui-1.11.3/jquery.ui.datepicker-es-MX.js"></script>
    <script src="../twbs/bootstrap-3.3.2/js/bootstrap.min.js"></script>
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