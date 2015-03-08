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
            <th>Nombre</th>
             <th>Descripción</th>
             <th>Precio</th>
             <th>¿Es Novedad?</th>
             <th>Fecha límite como novedad</th>
             <th>¿Esta en oferta?</th>
             <th>Fecha límite de la oferta</th>
             <th>Precio de oferta</th>
             <th>Existencias</th>
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
                <td><?php echo($row['nombre']); ?></td>
                <td><?php echo($row['descripcion']); ?></td>
                <td><?php echo($row['precio']); ?></td>
                <td><?php echo($row['novedad'] == 1 ? "Si" : "No"); ?></td>
                <td><?php echo($row['fecha_novedad']); ?></td>
                <td><?php echo($row['oferta'] == 1 ? "Si" : "No"); ?></td>
                <td><?php echo($row['fecha_oferta']); ?></td>
                <td><?php echo($row['precio_oferta']); ?></td>
                <td><?php echo($row['existencias']); ?></td>
                <td><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></td>
            </tr>
        <?php } $rst->closeCursor(); ?>
    </tbody>
</table>
<?php
     }
}
?>
