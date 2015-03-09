<?php
require_once '../clases/Rito.php';
require_once '../clases/UtilDB.php';

$sql = "SELECT * FROM ritos ORDER BY cve_rito";
$rst = UtilDB::ejecutaConsulta($sql);

$rito = new Rito();
$count = NULL;

if (isset($_POST['txtIdRito'])) {
    if ($_POST['txtIdRito'] != 0) {
        $rito = new Rito($_POST['txtIdRito']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $rito->setDescripcion($_POST['txtDescripcion']);
        $rito->setActivo(isset($_POST['cbxActivo']) ? "1" : "0");
        $count = $rito->grabar();
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
        <title>Catálogo de ritos</title>
        <script>
            function msg(opcion)
            {
                switch (opcion)
                {
                    case 0:
                        alert("[ERROR] Rito no grabado");
                        break;
                    case 1:
                        alert("Rito grabado con exito!");
                        break;
                    default:
                        break;

                }

            }

            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtIdRito").val("0");
                $("#frmRitos").submit();
            }

            function grabar()
            {
                $("#xAccion").val("grabar");
                $("#frmRitos").submit();

            }


            function abrirVentana() {
                var w = 400;
                var h = 400;
                var left = (screen.width / 2) - (w / 2);
                var top = (screen.height / 2) - (h / 2);
                var action = "muestra_ritos.php";
                window.open(action, 'MuestraRitos', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
            }

            function recargar()
            {
                $("#xAccion").val("recargar");
                $("#frmRitos").submit();

            }

        </script>
    </head>
    <body>

        <div class="container">
            <div class="row" >
                <div class="col-sm-4">&nbsp;</div>
                <div class="col-sm-4">
                    <h3>Catálogo de Ritos</h3>
                    <form role="form" name="frmRitos" id="frmRitos" action="cat_ritos.php" method="POST">
                        <div class="form-group">
                            <label for="txtIdRito"><input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" /></label>
                            <input type="hidden" class="form-control" id="txtIdRito" name="txtIdRito"
                                   placeholder="ID Rito" value="<?php echo($rito->getCve_rito()); ?>">
                                                   </div>
                        <div class="form-group">
                            <label for="txtDescripcion">Descripción</label>
                            <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" 
                                   placeholder="Descripción" value="<?php echo($rito->getDescripcion()); ?>">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="cbxActivo" name="cbxActivo" value="1" checked="<?php echo($rito->getCve_rito() != 0 ? ($rito->getActivo() == 1 ? "checked" : "") : "checked"); ?>"> Activo
                            </label>
                        </div>
                        <button type="button" class="btn btn-default" id="btnLimpiar" name="btnLimpiar" onclick="limpiar();">Limpiar</button>
                        <button type="button" class="btn btn-default" id="btnGrabar" name="btnGrabar" onclick="grabar();">Enviar</button>
                    </form>
                    <br/>
                    <br/>
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>ID Rito</th>
                                <th>Descripción</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rst as $row) { ?>
                                <tr>
                                    <td><a href="javascript:void(0);" onclick="$('#txtIdRito').val(<?php echo($row['cve_rito']); ?>);
                                            recargar();"><?php echo($row['cve_rito']); ?></a></td>
                                    <td><?php echo($row['descripcion']); ?></td>
                                    <td><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">&nbsp;</div>
            </div>
        </div>
        <script>
            msg(<?php echo($count) ?>);
        </script>
    </body>
</html>
