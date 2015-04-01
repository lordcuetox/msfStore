<?php
require_once '../clases/Clasificacion.php';
require_once '../clases/Rito.php';
require_once '../clases/UtilDB.php';
session_start();

if (!isset($_SESSION['cve_usuario'])) 
{
    header('Location:login.php');
    return;
}

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
    if ($_POST['xAccion'] == 'logout')
    {   
        unset($_SESSION['cve_usuario']);
        header('Location:login.php');
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>MSF Store Admin| Catálogo de clasificaciónes</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                            <a href="cat_clasificaciones.php" class="active"><i class="fa fa-leaf"></i> Clasificaciones</a>
                            <a href="cat_grados.php"><i class="fa fa-crop"></i> Grados</a>
                            <a href="cat_clasificacion_productos.php"><i class="fa fa-tags"></i> Clasificación productos</a>
                            <a href="cat_productos.php"><i class="fa fa-truck"></i> Productos</a>
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
                    <h1 class="page-header">Catálogo de Clasificación Ritos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row" >
                <div class="col-sm-4">&nbsp;</div>
                <div class="col-sm-4">
                    <form role="form" name="frmClasificacion" id="frmClasificacion" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="txtCveClasificacion"><input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" /></label>
                            <input type="hidden" class="form-control" id="txtCveClasificacion" name="txtCveClasificacion" placeholder="ID Clasificacion" value="<?php echo($clasf->getCve_clasificacion()); ?>">
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
                            <label for="txtDescripcion">Descripción</label>
                            <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" 
                                   placeholder="Descripción" value="<?php echo($clasf->getDescripcion()); ?>">
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
    </div>
    <!-- jQuery -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../twbs/plugins/startbootstrap-sb-admin-2-1.0.5/dist/js/sb-admin-2.js"></script>
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
    
    function logout()
    {
        $("#xAccion").val("logout");
        $("#frmClasificacion").submit();
    }

    function cargarMuestra(cveRito)
    {   //En el div con id 'ajax' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

        $("#ajax").load("cat_clasificaciones_ajax.php", {"cveRito": cveRito}, function (responseTxt, statusTxt, xhr) {
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
</body>
</html>
