<?php require_once '../clases/UtilDB.php'; 
session_start();

if (!isset($_SESSION['cve_usuario'])) 
{
    header('Location:login.php');
    return;
}
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion'])&& isset($_POST['cveGrado']) )
{ $cveRito =  $_POST['cveRito'];
  $cveClasificacion =  $_POST['cveClasificacion'];
  $cveGrado =  $_POST['cveGrado'];
    $sql = "SELECT * from clasificaciones_productos where cve_rito=$cveRito and cve_clasificacion=$cveClasificacion and cve_grado=$cveGrado order by cve_rito,cve_clasificacion";
    $rst = UtilDB::ejecutaConsulta($sql);
     if($rst->rowCount()>0)
     {
?>
<table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th>ID Clas. Prod.</th>
            <th>Descripción</th>
            <th>Activo</th>
        </tr>
    </thead>
    <tbody>
        <?php
      
       
        foreach ($rst as $row) {
            ?>
            <tr>
                <td><a href="javascript:void(0);" onclick="$('#txtCveClasProducto').val(<?php echo($row['cve_clas_producto']); ?>);
                                            recargar();"><?php echo($row['cve_clas_producto']); ?></a></td>
                <td><?php echo($row['descripcion']); ?></td>
                <td><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></td>
            </tr>
        <?php } $rst->closeCursor(); ?>
    </tbody>
</table>
<?php
     }
}
?>
