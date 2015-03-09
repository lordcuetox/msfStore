<?php
require_once '../clases/ElReaton.php';
require_once '../clases/UtilDB.php';

$reata = new ElReaton(1);
$count = NULL;

if (isset($_POST['txtIdReata'])) {
    if ($_POST['txtIdReata'] != 0) {
        $reata = new ElReaton($_POST['txtIdReata']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $reata->setHabilitado($_POST['txtHabilitado']);
        $reata->setFresita($_POST['txtFresita']);
        $count = $reata->grabar();
        if ($count != 0) {
            $msg = "¡Usuario y contraseña actualizado!";
        } else {
            $msg = "[ERROR] Usuario y contraseña no actualizado";
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
        <title>Usuario Administrador</title>
        <script>


            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtIdReata").val("0");
                $("#frmReata").submit();
            }

            function grabar()
            {
                
                   if ($("#txtFresita").val()!=""&&$("#txtHabilitado").val()!="")
                {
                $("#xAccion").val("grabar");
                $("#frmReata").submit();
                }
                else
                {
                    alert("Es necesario escribir el usuario y el password");
                }
                

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
                    <h3>Ususario Administrador</h3>
                    <form role="form" name="frmReata" id="frmReata" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="txtIdReata">ID Rito<input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" /></label>
                            <input type="text" class="form-control" id="txtIdReata" name="txtIdReata"
                                   placeholder="Clave usuario" value="<?php echo($reata->getCveReata()); ?>">
                            <a href="javascript:void(0);"  onclick="abrirVentana();"><img src="../img/busqueda.gif" width="18" height="18" alt="busqueda"/></a>
                        </div>
                        <div class="form-group">
                            <label for="txtHabilitado">Usuario:</label>
                            <input type="text" class="form-control" id="txtHabilitado" name="txtHabilitado" 
                                   placeholder="Usuario" value="<?php echo($reata->getHabilitado()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtFresita">Contraseña:</label>
                            <input type="password" class="form-control" id="txtFresita" name="txtFresita" 
                                   placeholder="Contraseña" value="<?php echo($reata->getFresita()); ?>">
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
                 </div>
             </div>


    </body>
</html>
