<?php require_once '../clases/UtilDB.php'; 
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion'])&& isset($_POST['cveGrado'])&& isset($_POST['cveClasProducto']) )
{ $cveRito =  $_POST['cveRito'];
  $cveClasificacion =  $_POST['cveClasificacion'];
  $cveGrado =  $_POST['cveGrado'];
  $cveClasProducto =  $_POST['cveClasProducto'];
    $sql = "SELECT * from productos where cve_rito=$cveRito and cve_clasificacion=$cveClasificacion and cve_grado=$cveGrado and cve_clas_producto=$cveClasProducto order by cve_rito,cve_clasificacion";
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
                <td><a href="javascript:void(0);" onclick="$('#txtCveProducto').val(<?php echo($row['cve_producto']); ?>);
                                            recargar();"><?php echo($row['cve_producto']); ?></a></td>
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
