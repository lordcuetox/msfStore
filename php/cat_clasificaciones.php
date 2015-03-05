<?php
require_once '../clases/Clasificacion.php';
require_once '../clases/Rito.php';
require_once '../clases/UtilDB.php';

$clasf = new Clasificacion();
$count = NULL;
$msg = "";

if (isset($_POST['txtCveClasificacion'])) {
    if ($_POST['txtCveClasificacion'] != 0) {
        $clasf = new Clasificacion($_POST['txtCveClasificacion']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $clasf->setCve_rito(new Rito($_POST['cmbCveRito']));
        $clasf->setDescripcion($_POST['txtDescripcion']);
        $clasf->setActivo(isset($_POST['cbxActivo']) ? "1" : "0");
        $count = $clasf->grabar();
        if ($count != 0) {
            $msg = "Clasificaciòn grabada con exito!";
        } else {
            $msg = "[ERROR] Clasificaciòn no grabado";
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <title>Catálogo de clasificaciónes</title>
        <script>
            $(document).ready(function () {
                $("#cmbCveRito").change(function () {
                //    var optionSelected = $("option:selected", this);
                    //var valueSelected = this.value;
                    cargarMuestra(this.value);

                });

                /*$('#cmbCveRito').on('change', function (e) {
                 var optionSelected = $("option:selected", this);
                 var valueSelected = this.value;
                 alert(this.value);
                 });*/

            });

            function cargarMuestra(cveRito)
            {   //En el div con id 'ajax' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#ajax").load("cat_clasificaciones_ajax.php",{"cveRito":cveRito}, function (responseTxt, statusTxt, xhr) {
                    if (statusTxt == "success")
                        //alert("External content loaded successfully!");
                    if (statusTxt == "error")
                        alert("Error: " + xhr.status + ": " + xhr.statusText);
                });
            }

            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtCveClasificacion").val("0");
                $("#frmClasificacion").submit();
            }

            function grabar()
            {
                $("#xAccion").val("grabar");
                $("#frmClasificacion").submit();

            }


            function recargar()
            {
                $("#xAccion").val("recargar");
                $("#frmClasificacion").submit();

            }

        </script>
    </head>
    <div class="container">
        <div class="row" >
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">
                <h3>Catálogo de clasificaciónes</h3>
                <form role="form" name="frmClasificacion" id="frmClasificacion" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label for="txtCveClasificacion">ID Clasificación<input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" /></label>
                        <input type="text" class="form-control" id="txtCveClasificacion" name="txtCveClasificacion" placeholder="ID Clasificacion" value="<?php echo($clasf->getCve_clasificacion()); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cmbCveRito">Rito:</label>
                        <select name="cmbCveRito" id="cmbCveRito" class="form-control" placeholder="Rito">
                            <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                            <?php
                            $sql2 = "SELECT * FROM ritos ORDER BY cve_rito";
                            $rst2 = UtilDB::ejecutaConsulta($sql2);
                            foreach ($rst2 as $row) {
                                echo("<option value='" . $row['cve_rito'] . "' " . ($clasf->getCve_clasificacion() != 0 ? ($clasf->getCve_rito()->getCve_rito() == $row['cve_rito'] ? "selected" : "") : "") . ">" . $row['descripcion'] . "</option>");
                            }
                            $rst2->closeCursor();
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripcion</label>
                        <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" 
                               placeholder="Descripcion" value="<?php echo($clasf->getDescripcion()); ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="cbxActivo" name="cbxActivo" value="1" checked="<?php echo($clasf->getCve_clasificacion() != 0 ? ($clasf->getActivo() == 1 ? "checked" : "") : "checked"); ?>"> Activo
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
</body>
</html>
