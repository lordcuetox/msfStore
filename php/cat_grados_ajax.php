<?php require_once '../clases/UtilDB.php'; 
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
        </tr>
    </thead>
    <tbody>
        <?php
      
       
        foreach ($rst as $row) {
            ?>
            <tr>
                <td><a href="javascript:void(0);" onclick="$('#txtCveGrado').val(<?php echo($row['cve_grado']); ?>);
                                            recargar();"><?php echo($row['cve_grado']); ?></a></td>
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
