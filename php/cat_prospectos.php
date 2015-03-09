<?php

require_once '../clases/Prospectos.php';
require_once '../clases/UtilDB.php';

$clasf = new Prospectos();
$count = NULL;
$msg = "";

if (isset($_POST['txtCveCliente'])) {
    if ($_POST['txtCveCliente'] != 0) {
        $clasf = new Prospectos($_POST['txtCveCliente']);
     
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {

        $clasf->setNombre($_POST['txtNombre']);
        $clasf->setApellidoPat($_POST['txtApellidoPat']);
        $clasf->setApellidoMat($_POST['txtApellidoMat']);
        $clasf->setSexo(isset($_POST['cbxSexo']) ? "1" : "0");
        $clasf->setFechaNac($_POST['txtFechaNac']);
        $clasf->setFechaRegistro($_POST['txtFechaRegistro']);
        $clasf->setHabilitado($_POST['txtHabilitado']);
        $clasf->setHabilitado($_POST['txtFresita']);
        $clasf->setActivo(isset($_POST['cbxActivo']) ? "1" : "0");
        $count = $clasf->grabar();
        if ($count != 0) {
            $msg = "Sus datos han sido grabado con éxito!";
        } else {
            $msg = "[ERROR] Sus datos no se han grabado";
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
                 //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                    cveRito=this.value;
                    cargarCombo(cveRito);

                });

                      

            });




            function cargarMuestra(cveRito,cveClasificacion,cveGrado)
            {   //En el div con id 'ajax' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                  $("#ajax").load("cat_clasificacion_productos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion,"cveGrado":cveGrado}, function (responseTxt, statusTxt, xhr) {
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
                 cargarCombo2($("#cmbCveRito").val(),$("#ajaxCmb").val(),0);
                });
            }
                    function cargarCombo2(cveRito,cveClasificacion,cveGrado)
            {   //En el div con id 'ajaxCmb' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                   $("#ajaxCmb").attr({'disabled':false});
                 cargarComboGrado2(cveRito,cveClasificacion,cveGrado);
                });
            }
            
                  function cargarComboGrado2(cveRito,cveClasificacion,cveGrado)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#cmbGrado").load("cat_grados_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion,"cveGrado":cveGrado}, function (responseTxt, statusTxt, xhr) {
                   $("#cmbGrado").attr({'disabled':false});
                   cargarMuestra(cveRito,cveClasificacion,cveGrado);
                });
            }

      function cargarComboGrado(cveRito,cveClasificacion)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#cmbGrado").load("cat_grados_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                   $("#cmbGrado").attr({'disabled':false});
 
                });
            }

            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtCveClasProducto").val("0");
                $("#frmClasificacionProductos").submit();
            }

            function grabar()
            {
                if ($("#cmbCveRito").val()>0&&$("#ajaxCmb").val()>0&&$("#cmbGrado").val()>0&&$("#txtDescripcion").val()!="")
                {
                $("#xAccion").val("grabar");
                $("#frmClasificacionProductos").submit();
                }
                else
                {
                    alert("Es necesario elegir el Rito, la Clasificación, el grado y agregar la clasificación del producto");
                }

            }


            function recargar()
            {
                $("#xAccion").val("recargar");
                $("#frmClasificacionProductos").submit();

            }

        </script>
    </head>
    <div class="container">
        <div class="row" >
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">
                <h3>BIENVENIDO A  MSF STORE</h3>
                <h4>Ingrese los siguientes datos para crear su cuenta:</h4>
                <form role="form" name="frmProspectos" id="frmProspectos" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                      <input type="text" class="form-control" id="txtCveCliente" name="txtCveCliente" placeholder="ID Grado" value="<?php echo($clasf->getCveCliente()); ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" 
                               placeholder="Nombre" value="<?php echo($clasf->getNombre()); ?>">
                    </div>
                      <div class="form-group">
                        <label for="txtApellidoPat">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="txtApellidoPat" name="txtApellidoPat" 
                               placeholder="Primer Apellido" value="<?php echo($clasf->getApellidoPat()); ?>">
                    </div>
                         <div class="form-group">
                        <label for="txtApellidoMat">Apellido Materno:</label>
                        <input type="text" class="form-control" id="txtApellidoMat" name="txtApellidoMat" 
                               placeholder="Segundo Apellido" value="<?php echo($clasf->getApellidoMat()); ?>">
                    </div>
                          <div class="form-group">
                        <label for="txtFechaNacimiento">Fecha Nacimiento:</label>
                        <input type="text" class="form-control" id="txtFechaNacimiento" name="txtFechaNacimiento" 
                               placeholder="12/12/2015" value="<?php echo($clasf->getFechaNac()); ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="cbxActivo" name="cbxActivo" value="1" checked="<?php echo($clasf->getCveCliente() != 0 ? ($clasf->getActivo() == 1 ? "checked" : "") : "checked"); ?>"> Activo
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
           cargarCombo2(Rito,<?php echo($clasf->getCveClasificacion() ) ?>,<?php echo($clasf->getCveGrado() ) ?>);
       }
   
   
    </script>
</body>
</html>
