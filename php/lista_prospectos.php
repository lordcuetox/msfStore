<?php
require_once '../clases/ComunicacionesClientes.php';
require_once '../clases/UtilDB.php';
session_start();

if (!isset($_SESSION['cve_usuario'])) 
{
    header('Location:login.php');
    return;
}
else
{
    $idPrincipal=isset($_SESSION['cve_usuario']);
}

$correo = new ComunicacionesClientes();
$telefono = new ComunicacionesClientes();

if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {

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
                                <a href="cat_clasificacion_productos.php"><i class="fa fa-tags"></i> Clasificación productos</a>
                                <a href="cat_productos.php"><i class="fa fa-truck"></i> Productos</a>
                                 <a href="pedidos_entrantes.php"><i class="fa fa-truck"></i> Nuevo Pedidos</a>
                                  <a href="pedidos_enviados.php"><i class="fa fa-truck"></i> Pedidos Enviados</a>
                                   <a href="pedidos_entregados.php"><i class="fa fa-truck"></i> Historial de Pedidos</a>
                                 <a href="lista_prospectos.php"><i class="fa fa-truck"></i> Lista de clientes</a>
                                 <a href="cat_reaton.php" class="active"><i class="fa fa-users"></i> Usuarios y contraseñas</a>
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
                        <h1 class="page-header">Catálogo de Clientes</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
     <table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Sexo</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Activo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * from prospectos p order by p.cve_cliente,p.nombre,p.apellido_pat,p.apellido_mat";
        $rst = UtilDB::ejecutaConsulta($sql);
        foreach ($rst as $row) {
              $telefono= new ComunicacionesClientes($row['cve_cliente'],1);
              $correo= new ComunicacionesClientes($row['cve_cliente'],2);
            ?>
            <tr>
                <td><?php echo($row['cve_cliente']); ?></td>
                <td><?php echo($row['nombre']); ?></td>
                <td><?php echo($row['apellido_pat']); ?></td>
                <td><?php echo($row['apellido_mat']); ?></td>
                <td><?php echo($row['sexo']==1?"Hombre":"Mujer"); ?></td>
                <td><?php echo($telefono->getDato());  ?></td>  
                <td><?php  echo($correo->getDato()); ?></td>  
                <td><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></td>
            </tr>
        <?php } $rst->closeCursor(); ?>
            <tr>
                <td colspan="8"><a href="reporteExcel.php"> Haz clic para descargar el reporte</a></td>
            </tr>
    </tbody>
</table>
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

