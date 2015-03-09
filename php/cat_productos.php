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

        $clasf->setCveRito($_POST['cmbCveRito']);
        $clasf->setCveClasificacion($_POST['ajaxCmb']);
        $clasf->setCveGrado($_POST['cmbGrado']);
        $clasf->setCveClasProducto($_POST['cmbClasProducto']);
        $clasf->setNombre($_POST['txtNombre']);
        $clasf->setDescripcion($_POST['txtDescripcion']);
        $clasf->setPrecio($_POST['txtPrecio']);
        $clasf->setPrecioOferta($_POST['txtPrecioOferta']);
        $clasf->setFechaNovedad($_POST['txtFechaNovedad']);
        $clasf->setFechaOferta($_POST['txtFechaOferta']);
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
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../twbs/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="../js/jQuery/jquery-1.11.2.min.js"></script>
        <script src="../twbs/bootstrap-3.3.2/js/bootstrap.min.js"></script>
        <title>Catálogo de clasificaciónes</title>
        <script>
            
            $(document).ready(function () {
                $("#cmbCveRito").change(function () {
                    var cveRito=0;
                    cveRito=this.value;
                    cargarCombo(cveRito);

                });
                
                     $("#ajaxCmb").change(function () {
                 //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                    cargarComboGrado($("#cmbCveRito").val(),this.value);

                });
                       $("#cmbGrado").change(function () {
                 //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                    cargarComboClasProducto($("#cmbCveRito").val(),$("#ajaxCmb").val(),this.value);

                });
                        $("#cmbClasProducto").change(function () {
                 //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                      cargarMuestra($("#cmbCveRito").val(),$("#ajaxCmb").val(),$("#cmbGrado").val(),this.value);

                });
                      

            });




            function cargarMuestra(cveRito,cveClasificacion,cveGrado,cveClasProducto)
            {   //En el div con id 'ajax' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                  $("#ajax").load("cat_productos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion,"cveGrado":cveGrado,"cveClasProducto":cveClasProducto}, function (responseTxt, statusTxt, xhr) {
                    if (statusTxt == "success")
                    {
                       //  $("#txtCveGrado").val("0");
                        //$("#txtDescripcion").val("");
                        //alert("External content loaded successfully!");
                    }
                    if (statusTxt == "error")
                        alert("Error: " + xhr.status + ": " + xhr.statusText);
                });
            }
            
              function cargarCombo(cveRito)
            {   //En el div con id 'ajaxCmb' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php",{"cveRito":cveRito}, function (responseTxt, statusTxt, xhr) {
                   $("#ajaxCmb").attr({'disabled':false});
                });
                  cargarCombo2($("#cmbCveRito").val(),$("#ajaxCmb").val(),0,0);
            }
                    function cargarCombo2(cveRito,cveClasificacion,cveGrado,cveClasProducto)
            {   //En el div con id 'ajaxCmb' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                   $("#ajaxCmb").attr({'disabled':false});
                 cargarComboGrado2(cveRito,cveClasificacion,cveGrado,cveClasProducto);
                });
            }
            
                  function cargarComboGrado2(cveRito,cveClasificacion,cveGrado,cveClasProducto)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#cmbGrado").load("cat_grados_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion,"cveGrado":cveGrado}, function (responseTxt, statusTxt, xhr) {
                   $("#cmbGrado").attr({'disabled':false});
                  cargarComboClasProducto2(cveRito,cveClasificacion,cveGrado,cveClasProducto)
                });
            }

      function cargarComboGrado(cveRito,cveClasificacion)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#cmbGrado").load("cat_grados_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                   $("#cmbGrado").attr({'disabled':false});
                 });
                  cargarComboClasProducto(cveRito,cveClasificacion,0)
            }
            
           function cargarComboClasProducto(cveRito,cveClasificacion,cveGrado)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#cmbClasProducto").load("cat_clasificacion_productos_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion,"cveGrado":cveGrado}, function (responseTxt, statusTxt, xhr) {
                   $("#cmbClasProducto").attr({'disabled':false});
                     cargarMuestra($("#cmbCveRito").val(),$("#ajaxCmb").val(),$("#cmbGrado").val(),$("#cmbClasProducto").val());
                });
            }
                   function cargarComboClasProducto2(cveRito,cveClasificacion,cveGrado,cveClasProducto)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST
             
                $("#cmbClasProducto").load("cat_clasificacion_productos_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion,"cveGrado":cveGrado,"cveClasProducto":cveClasProducto}, function (responseTxt, statusTxt, xhr) {
                   $("#cmbClasProducto").attr({'disabled':false});
                     cargarMuestra($("#cmbCveRito").val(),$("#ajaxCmb").val(),$("#cmbGrado").val(),$("#cmbClasProducto").val());
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
                if ($("#cmbCveRito").val()>0&&$("#ajaxCmb").val()>0&&$("#cmbGrado").val()>0&&$("#cmbClasProducto").val()>0&&$("#txtNombre").val()!=""&&$("#txtDescripcion").val()!=""&&$("#txtPrecio").val()>0)
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

        </script>
    </head>
    <div class="container">
        <div class="row" >
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">
                <h3>Catálogo de Grados</h3>
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
                                 <label for="txtFechaNovedad">Fecha límite como novedad:</label>
                                 <input type="text" class="form-control" id="txtFechaNovedad" name="txtFechaNovedad" 
                                        placeholder="12/12/2025" value="<?php echo($clasf->getFechaNovedad()); ?>">
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
                                 <label for="txtFechaOferta">Fecha límite de la oferta:</label>
                                 <input type="text" class="form-control" id="txtFechaOferta" name="txtFechaOferta" 
                                        placeholder="12/12/2025" value="<?php echo($clasf->getFechaOferta()); ?>">
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
                <!-- Aqui se cargan los datos vía AJAX-->
                <div id="ajax"></div>
            </div>
            <div class="col-sm-4">&nbsp;</div>
        </div>
    </div>
    <script>
  
       var Rito=$("#cmbCveRito").val();
       if (Rito!=0)
       {
           cargarCombo2(Rito,<?php echo($clasf->getCveClasificacion() ) ?>,<?php echo($clasf->getCveGrado() ) ?>,<?php echo($clasf->getCveClasProducto() ) ?>);
       }
   
   
    </script>
</body>
</html>
