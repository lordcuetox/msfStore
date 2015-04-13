<?php require_once '../clases/UtilDB.php'; 
session_start();

if (!isset($_SESSION['cve_usuario'])) 
{
    header('Location:login.php');
    return;
}
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) )
{ $cveRito =  $_POST['cveRito'];
  $cveClasificacion =  $_POST['cveClasificacion'];
    $sql = "SELECT * from grados where cve_rito=$cveRito and cve_clasificacion=$cveClasificacion order by cve_rito,cve_clasificacion";
     $rst = UtilDB::ejecutaConsulta($sql);
     if($rst->rowCount()>0)
     {
?>
<table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th>ID Grado</th>
            <th>Grado</th>
            <th>Activo</th>
            <th>Desactivar</th>
        </tr>
    </thead>
    <tbody>
        <?php
      
       
        foreach ($rst as $row) {
            ?>
            <tr>
                <th><a href="javascript:void(0);" onclick="$('#txtCveGrado').val(<?php echo($row['cve_grado']); ?>);
                                            recargar();"><?php echo($row['cve_grado']); ?></a></th>
                <th><?php echo($row['descripcion']); ?></th>
                <th><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></th>
                 <th><a href="javascript:void();" onclick="eliminar(<?PHP echo $row['cve_grado'];?>);"> <i class="fa fa-trash-o"></i> </a></th>
            </tr>
        <?php } $rst->closeCursor(); ?>
    </tbody>
</table>
<?php
     }
}
?>
