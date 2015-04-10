<?php

require_once '../clases/Prospectos.php';
require_once '../clases/ComunicacionesClientes.php';
require_once '../clases/UtilDB.php';

session_start();
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
$correo = new ComunicacionesClientes();
$telefono = new ComunicacionesClientes();
$count = NULL;
$count2 = NULL;
$count3 = NULL;
$msg = "";

if (isset($_SESSION['habilitado'])) {
   
        $clasf->cargar2($idPrincipal);
          $telefono= new ComunicacionesClientes($clasf->getCveCliente(),1);
        $correo= new ComunicacionesClientes($clasf->getCveCliente(),2);
    
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        
        
        $fn = strtotime(str_replace('/', '-', ($_POST['txtFechaNacimiento'] . " " . "00:00:00")));
        $fecha = strtotime(str_replace('/', '-', (date("d/m/Y h:i"))));
        $fNacimiento = date('Y-m-d H:i:s', $fn);
        $fRegistro = date('Y-m-d H:i:s', $fecha);
        $sexo = '1';


    if (isset($_POST['optSexo'])) {
         $selected_radio = $_POST['optSexo'];

         if ($selected_radio == '1') {
                $sexo = '1';
          }else if ($selected_radio == '0') {
                $sexo = '0';
          }
    }
        

        $clasf->setNombre($_POST['txtNombre']);
        $clasf->setApellidoPat($_POST['txtApellidoPat']);
        $clasf->setApellidoMat($_POST['txtApellidoMat']);
        $clasf->setSexo($sexo);
        $clasf->setFechaNac($fNacimiento);
        $clasf->setFechaRegistro($fRegistro);
        $clasf->setFresita($_POST['txtPass']);
        $clasf->setActivo("1");

        $count = $clasf->grabar();
        $telefono->setCveCliente($clasf->getCveCliente());
        $telefono->setCveComunicacion(1);    
        $telefono->setDato($_POST['txtTelefono']);
        $telefono->setActivo("1");
        $count2 = $telefono->grabar();
        $correo->setCveCliente($clasf->getCveCliente());
        $correo->setCveComunicacion(2);      
        $correo->setDato($_POST['txtCorreo']);
         $correo->setActivo("1");
        $count3 = $correo->grabar();
        
        if ($count != 0||$count2 != 0||$count3 != 0) {
            $msg = "Sus datos han sido grabado con éxito!";
        } 
       
    }
        if ($_POST['xAccion'] == 'logout')
    {   
        unset($_SESSION['habilitado']);
         unset($_SESSION['nombre_completo']);
        header('Location:../index.php');
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>MSF Store | Catálogo de clientes</title>
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
        <title>Catálogo de clientes<</title>
        <script src="../js/jQuery/jquery-1.11.2.min.js"></script>
        <script src="../js/jQuery/jquery-ui-1.11.3/jquery-ui.min.js"></script>
        <script src="../js/jQuery/jquery-ui-1.11.3/jquery.ui.datepicker-es-MX.js"></script>
        <script>

            $(document).ready(function () {

            $(".date-picker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
             });
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
            $("#frmProspectos2").submit();
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
                    <a class="navbar-brand" href="index.html">Mi Cuenta</a>
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
        <div class="row" >
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">

                <form role="form" name="frmProspectos2" id="frmProspectos2" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">

                     <h3>Datos Personales:</h3>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                        <input type="hidden" class="form-control" id="txtCveCliente" name="txtCveCliente" placeholder="ID Grado" value="<?php echo($clasf->getCveCliente()); ?>">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre">*Nombre:</label>
                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" 
                               placeholder="Nombre" value="<?php echo($clasf->getNombre()); ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtApellidoPat">*Apellido Paterno:</label>
                        <input type="text" class="form-control" id="txtApellidoPat" name="txtApellidoPat" 
                               placeholder="Primer Apellido" value="<?php echo($clasf->getApellidoPat()); ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtApellidoMat">Apellido Materno:</label>
                        <input type="text" class="form-control" id="txtApellidoMat" name="txtApellidoMat" 
                               placeholder="Segundo Apellido" value="<?php echo($clasf->getApellidoMat()); ?>">
                    </div>
                    <div class="form-group">
                        <label for="optSexo">*Sexo:</label>
                        <input type="radio" id="optSexo" name="optSexo" value="0" <?php echo($clasf->getCveCliente() != 0 ? ($clasf->getSexo() == 0 ? "checked" : "") : ""); ?>>&nbsp;Femenino&nbsp;&nbsp;
                        <input type="radio" id="optSexo" name="optSexo" value="1" <?php echo($clasf->getCveCliente() != 0 ? ($clasf->getSexo() == 1 ? "checked" : "") : "checked"); ?>>&nbsp;Masculino
                    </div>
                    <div class="form-group">
                        <div class="date-form">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <label for="txtFechaNacimiento">*Fecha de nacimiento:</label>
                                    <div class="controls">
                                        <div class="input-group">
                                            <input id="txtFechaNacimiento" name="txtFechaNacimiento" type="text" class="date-picker form-control"  value="<?php echo(substr(str_replace('-', '/', $clasf->getFechaNac()), 0, 10)); ?>"/>
                                            <label for="txtFechaNacimiento" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="txtPass">*Contraseña:</label>
                        <input type="password" class="form-control" id="txtPass" name="txtPass" 
                               placeholder="Password" value="<?php echo($clasf->getFresita()); ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtPass">*Repita la contraseña:</label>
                        <input type="password" class="form-control" id="txtPass2" name="txtPass2" 
                               placeholder="Password" value="<?php echo($clasf->getFresita()); ?>">
                    </div>
                           <div class="form-group">
                        <label for="txtTelefono">Telefono:</label>
                        <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" 
                               placeholder="(000)-00-0-0-00" value="<?php echo($telefono->getDato()); ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtCorreo">*Correo:</label>
                        <input type="text" class="form-control" id="txtCorreo" name="txtCorreo" 
                               placeholder="correo@dominio" value="<?php echo($correo->getDato()); ?>">
                    </div>
                    <button type="button" class="btn btn-default" id="btnLimpiar" name="btnLimpiar" onclick="limpiar();">Limpiar</button>
                    <button type="button" class="btn btn-default" id="btnGrabar" name="btnGrabar" onclick="grabar();">Enviar</button>
                          <div class="form-group">
                    <label for="mensa">* Campos obligatorios</label>
                       </div>
                 
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
