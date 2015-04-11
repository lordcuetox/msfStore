<?php
require_once '../clases/Prospectos.php';
require_once '../clases/ComunicacionesClientes.php';
require_once '../clases/UtilDB.php';
session_start();
$clasf = new Prospectos();
$correo = new ComunicacionesClientes();
$telefono = new ComunicacionesClientes();
$count = NULL;
$count2 = NULL;
$count3 = NULL;
$msg = "";
$total=0;

if (isset($_POST['txtCveCliente'])) {
    if ($_POST['txtCveCliente'] != 0) {
        $clasf = new Prospectos($_POST['txtCveCliente']);
          $telefono= new ComunicacionesClientes($clasf->getCveCliente(),1);
        $correo= new ComunicacionesClientes($clasf->getCveCliente(),2);
    }
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
        $clasf->setHabilitado($_POST['txtUsuario']);
        $clasf->setFresita($_POST['txtPass']);
        $clasf->setActivo("1");

          $username = $_POST['txtUsuario'];
             // $sql = "SELECT * from prospectos where habilitado='".($_POST['txtUsuario'])."'";
              $sql = sprintf("SELECT * FROM prospectos WHERE habilitado = '%s';",$username);
             $rst = UtilDB::ejecutaConsulta($sql);
    if($rst->rowCount()>0)
    {
        $total=$rst->rowCount();
         $msg = "No es posible asignar el usuario, elija otro.";
    }
 else {
           
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
        
        if ($count != 0&&$count2 != 0&&$count3 != 0) {
              $_SESSION['habilitado'] = $clasf->getHabilitado();
              $_SESSION['nombre_completo'] =  $clasf->getNombre().' '.$clasf->getApellidoPat().' '.$clasf->getApellidoMat();
                  header('Location:../index.php');
                   return;
            $msg = "Sus datos han sido grabado con éxito!";
            
        } else {    
            $msg = "[ERROR] Sus datos no se han grabado";
        }
    }
    $rst->closeCursor();
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
        <link href="../twbs/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
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




            function cargarMuestra(cveRito, cveClasificacion, cveGrado)
            {   //En el div con id 'ajax' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#ajax").load("cat_clasificacion_productos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion, "cveGrado": cveGrado}, function (responseTxt, statusTxt, xhr) {
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

                $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php", {"cveRito": cveRito}, function (responseTxt, statusTxt, xhr) {
                    $("#ajaxCmb").attr({'disabled': false});
                    cargarCombo2($("#cmbCveRito").val(), $("#ajaxCmb").val(), 0);
                });
            }
            function cargarCombo2(cveRito, cveClasificacion, cveGrado)
            {   //En el div con id 'ajaxCmb' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#ajaxCmb").load("cat_clasificaciones_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                    $("#ajaxCmb").attr({'disabled': false});
                    cargarComboGrado2(cveRito, cveClasificacion, cveGrado);
                });
            }

            function cargarComboGrado2(cveRito, cveClasificacion, cveGrado)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#cmbGrado").load("cat_grados_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion, "cveGrado": cveGrado}, function (responseTxt, statusTxt, xhr) {
                    $("#cmbGrado").attr({'disabled': false});
                    cargarMuestra(cveRito, cveClasificacion, cveGrado);
                });
            }

            function cargarComboGrado(cveRito, cveClasificacion)
            {   //En el div con id 'cmbGrado' se cargara lo que devuelva el ajax, esta petición  es realizada como POST

                $("#cmbGrado").load("cat_grados_combos_ajax.php", {"cveRito": cveRito, "cveClasificacion": cveClasificacion}, function (responseTxt, statusTxt, xhr) {
                    $("#cmbGrado").attr({'disabled': false});

                });
            }

            function limpiar()
            {
                $("#xAccion").val("0");
                $("#txtCveCliente").val("0");
                $("#frmProspectos").submit();
            }

            function grabar()
            {
                if ($("#txtNombre").val() !="" && $("#txtApellidoPat").val() !="" && $("#txtFechaNacimiento").val() != "" && $("#txtUsuario").val() != ""&& $("#txtPass").val() != ""&& $("#txtPass2").val() != ""&& $("#txtCorreo").val() != "")
                {
                     if(valEmail($("#txtCorreo").val()))
                      {
                        if($("#txtPass").val()==$("#txtPass2").val())
                          {
                             if($("#txtPass").val()!="12345678")
                             {
                                    $("#xAccion").val("grabar");
                                    $("#frmProspectos").submit();
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



        </script>
    </head>
    <div class="container">
        <div class="row" >
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">

                <form role="form" name="frmProspectos" id="frmProspectos" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                    <?php
                    if($clasf->getCveCliente()==0)
                    {
                    ?>
                     <h3>BIENVENIDO A  MSF STORE</h3>
                     <h4>Ingrese los siguientes datos para crear su cuenta:</h4>
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
                    <div class="form-group" >
                        <label for="txtUsuario" class="<?php echo(($total>0?"alert alert-danger":"")) ?>" >*Usuario:</label>
                         <label class="<?php echo(($total>0?"alert alert-danger":"")) ?>"  style="<?php echo($total >0 ? "display:block;" : "display:none;"); ?>"><?php echo($msg); ?></label>
                        <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" 
                               placeholder="Usuario"  value="<?php echo($clasf->getHabilitado()); ?>">
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
                    <?php } else
                    {
                       
?>
                            <div class="form-group">
                                <label for="mensa">¡Gracias por registrarse en arreosMSF!,para continuar presione<a href="../index.php"> aquí</a>.</label>
                       </div>
                    <?php } ?>
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
