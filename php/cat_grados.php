<?php

require_once '../clases/Grados.php';
require_once '../clases/UtilDB.php';

$clasf = new Grados();
$count = NULL;
$msg = "";

if (isset($_POST['txtCveGrado'])) {
    if ($_POST['txtCveGrado'] != 0) {
        $clasf = new Grados($_POST['txtCveGrado']);
     
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        
         $clasf->setCveRito($_POST['cmbCveRito']);
        $clasf->setCveClasificacion($_POST['ajaxCmb']);
        $clasf->setDescripcion($_POST['txtDescripcion']);
        $clasf->setActivo(isset($_POST['cbxActivo']) ? "1" : "0");
        $count = $clasf->grabar();
        if ($count != 0) {
            $msg = "Grado grabado con exito!";
        } else {
            $msg = "[ERROR] Grado no grabado";
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
                
                     $("#ajaxCmb").change(function () {
                 //   var optionSelected = $("option:selected", this);
                //    var valueSelected = this.value;
                    cargarMuestra($("#cmbCveRito").val(),this.value);

                });
                
                      

            });

            function cargarMuestra(cveRito,cveClasificacion)
            {   //En el div con id 'ajax' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                  $("#ajax").load("cat_grados_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion}, function (responseTxt, statusTxt, xhr) {
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
                   cargarCombo2($("#cmbCveRito").val(),$("#ajaxCmb").val());
                });
            }
                  function cargarCombo2(cveRito,cveClasificacion)
            {   //En el div con id 'ajaxCmb' se cargara lo que devuelva el ajax, esta petición  es realizada como POST
                   // $("#ajaxCmb").html("");
                $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php",{"cveRito":cveRito,"cveClasificacion":cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                   $("#ajaxCmb").attr({'disabled':false});
                    cargarMuestra(cveRito,cveClasificacion);
                });
            }



            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtCveGrado").val("0");
                $("#frmGrados").submit();
            }

            function grabar()
            {
                if ($("#cmbCveRito").val()>0&&$("#ajaxCmb").val()>0&&$("#txtDescripcion").val()!="")
                {
                $("#xAccion").val("grabar");
                $("#frmGrados").submit();
                }
                else
                {
                    alert("Es necesario elegir el Rito, la Clasificación y agregar el Grado");
                }

            }


            function recargar()
            {
                $("#xAccion").val("recargar");
                $("#frmGrados").submit();

            }

        </script>
    </head>
    <div class="container">
        <div class="row" >
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">
                <h3>Catálogo de grados</h3>
                <form role="form" name="frmGrados" id="frmGrados" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label for="txtCveGrado"><input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" /></label>
                        <input type="hidden" class="form-control" id="txtCveGrado" name="txtCveGrado" placeholder="ID Grado" value="<?php echo($clasf->getCveGrado()); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cmbCveRito">Rito:</label>
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
                        <label for="ajaxCmb">Clasificación:</label>
                        <select name="ajaxCmb" id="ajaxCmb" class="form-control" placeholder="clasificación" disabled>
                            <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                    

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Grado</label>
                        <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" 
                               placeholder="Grado" value="<?php echo($clasf->getDescripcion()); ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="cbxActivo" name="cbxActivo" value="1" checked="<?php echo($clasf->getCveClasificacion() != 0 ? ($clasf->getActivo() == 1 ? "checked" : "") : "checked"); ?>"> Activo
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
           cargarCombo2(Rito,<?php echo($clasf->getCveClasificacion() ) ?>);
       }
   
    </script>
</body>
</html>
