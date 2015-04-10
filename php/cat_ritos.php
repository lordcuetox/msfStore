<?php
require_once '../clases/Rito.php';
require_once '../clases/UtilDB.php';
session_start();

if (!isset($_SESSION['cve_usuario'])) 
{
    header('Location:login.php');
    return;
}


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
        <title>MSF Store Admin | Catálogo de ritos</title>
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
    <body>
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
                                <a href="cat_clasificacion_productos.php"><i class="fa fa-tags"></i> Clasificación Productos</a>
                                <a href="cat_productos.php"><i class="fa fa-truck"></i> Productos</a>
                                 <a href="pedidos_entrantes.php"><i class="fa fa-truck"></i> Nuevo Pedidos</a>
                                  <a href="pedidos_enviados.php"><i class="fa fa-truck"></i> Pedidos Enviados</a>
                                   <a href="pedidos_entregados.php"><i class="fa fa-truck"></i> Historial de Pedidos</a>
                                 <a href="lista_prospectos.php"><i class="fa fa-truck"></i> Lista de Clientes</a>
                                 <a href="cat_reaton.php" class="active"><i class="fa fa-users"></i> Usuario y Contraseña</a>
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
                        <h1 class="page-header">Catálogo de Ritos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" >
                    <div class="col-sm-4">&nbsp;</div>
                    <div class="col-sm-4">
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
        function logout()
        {
            $("#xAccion").val("logout");
            $("#frmRitos").submit();
        }
            
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


        msg(<?php echo($count) ?>);
        </script>
    </body>
</html>

