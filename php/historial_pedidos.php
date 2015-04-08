<?php

require_once '../clases/Prospectos.php';
require_once '../clases/UtilDB.php';

session_start();
setlocale(LC_ALL, 'es_MX');
//unset($_SESSION['cve_cliente']);
if (!isset( $_SESSION['habilitado'])) 
{
    header('Location:login_cliente.php');
    return;
}
else
{
    $idPrincipal=mysql_real_escape_string($_SESSION['habilitado']);
}

$clasf = new Prospectos();
$msg = "";

if (isset($_SESSION['habilitado'])) {
   
        $clasf->cargar2($idPrincipal);
    
}
if (isset($_POST['xAccion'])) {
            if ($_POST['xAccion'] == 'logout')
    {   
        unset($_SESSION['habilitado']);
        header('Location:../index.php');
        return;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>MSF Store | Historial de Pedidos</title>
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
        <link href="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.css" rel="stylesheet"/>
        <title>Mis Pedidos</title>
        <script src="../js/jQuery/jquery-1.11.2.min.js"></script>
        <script src="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.js"></script>
        <script src="../js/jQuery/jquery-ui-1.11.3/jquery.ui.datepicker-es-MX.js"></script>
        <script>

            $(document).ready(function () {

                $(".date-picker").datepicker();
                $.datepicker.setDefaults($.datepicker.regional[ "es-MX" ]);

                $("#cmbCveRito").change(function () {
                    var cveRito = 0;
                    //   var optionSelected = $("option:selected", this);
                    //    var valueSelected = this.value;
                    cveRito = this.value;
                    cargarCombo(cveRito);

                });



            });


            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtCveCliente").val("0");
                $("#frmProspectos").submit();
            }

            function grabar()
            {
                if ($("#txtNombre").val() !="" && $("#txtApellidoPat").val() !="" && $("#txtFechaNacimiento").val() != "" && $("#txtPass").val() != ""&& $("#txtPass2").val() != ""&& $("#txtCorreo").val() != "")
                {
                     if(valEmail($("#txtCorreo").val()))
                      {
                        if($("#txtPass").val()==$("#txtPass2").val())
                          {
                             if($("#txtPass").val()!="12345678")
                             {
                                    $("#xAccion").val("grabar");
                                    $("#frmProspectos2").submit();
                                }
                                else
                                {
                                    alert("La contraseña debe incluir letras y números. Verifique por favor");  
                                }
                          }
                        else
                          {
                           alert("Las contraseñas no coinciden. Verifique por favor"); 
                          }
                      }
                      else
                      {
                           alert("El formato del correo electrónico es incorrecto. Verifique por favor"); 
                      }
                }
                else
                {
                    alert("Es necesario que ingrese los campos obligatorios");
                }

            }


            function recargar()
            {
                $("#xAccion").val("recargar");
                $("#frmProspectos").submit();

            }
            
             function valEmail(valor){
                  re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
                     if(!re.exec(valor))    {
                       return false;
                     }else{
                    return true;
                }
              }
      
    function logout()
        {
            $("#xAccion").val("logout");
            alert('entrando');
            $("#mispedidos1").submit();
        }
         



        </script>
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
                    <a class="navbar-brand" href="index.html">Histórico de Pedidos</a>
                </div>
                <!-- /.navbar-header -->


                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="cat_prospectos2.php" ><i class="fa fa-user"></i> Mi Datos Personales</a>
                                <a href="mis_pedidos.php" ><i class="fa fa-list-alt"></i> Pedidos Pendientes</a>
                                <a href="historial_pedidos.php" ><i class="fa fa-archive"></i> Histórico de Pedidos</a>
                                <a href="javascript:void(0);" onclick="logout();"><i class="fa fa-sign-out"></i> CERRAR SESIÓN</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper">
           <form role="form" name="mispedidos1" id="mispedidos1" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Histórico de Pedidos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
     <table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th>Fecha</th>
            <th># Pedido</th>
            <th>Total</th>
            <th>Estado</th>
            <th># de Guía</th>
            <th>Descrición</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * from pedidos where status in (3) and cve_cliente=".$clasf->getCveCliente()."  order by fecha ";
        $rst = UtilDB::ejecutaConsulta($sql);
        if($rst->rowCount()>0)
        {
        foreach ($rst as $row) {

            ?>
            <tr>
                <th><?php echo( substr($row['fecha'],0,10));  ?></th>
                <th><?php echo($row['referencia']); ?></th>
                <th><?php echo('$ '.number_format($row['monto_total'],  2 , '.' , ',' )); ?></th>
                <th><?php echo($row['status']==3?'Entregado':''); ?></th>
                <th><?php echo($row['status']==3?$row['numero_guia']:''); ?></th>
                <th><?php echo($row['status']==3?$row['descripcion_guia']:''); ?></th>
                <th><a href=""> Ver</a></th>
            </tr>
        <?php }
        
        }
        else
        {
            ?>
             <tr>
                 <td colspan="7">No hay pedidos</td>
            </tr>
            <?php
            
        }
        $rst->closeCursor(); ?>

    </tbody>
</table>
               </form>
            </div>

    </div>

</body>
</html>
