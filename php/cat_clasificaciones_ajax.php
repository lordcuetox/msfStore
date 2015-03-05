<?php require_once '../clases/UtilDB.php'; 
if(isset($_POST['cveRito']))
{ $cveRito =  $_POST['cveRito'];
?>
<table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th>ID Clasificación</th>
            <th>Rito</th>
            <th>Descripción</th>
            <th>Activo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT C.cve_clasificacion,R.descripcion AS rito,C.descripcion,C.activo  FROM clasificaciones AS C INNER JOIN ritos AS R  ON C.cve_rito = R.cve_rito  WHERE C.cve_rito = $cveRito ORDER BY C.cve_clasificacion";
        $rst = UtilDB::ejecutaConsulta($sql);
        foreach ($rst as $row) {
            ?>
            <tr>
                <td><a href="javascript:void(0);" onclick="$('#txtCveClasificacion').val(<?php echo($row['cve_clasificacion']); ?>);
                                            recargar();"><?php echo($row['cve_clasificacion']); ?></a></td>
                <td><?php echo($row['rito']); ?></td>
                <td><?php echo($row['descripcion']); ?></td>
                <td><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></td>
            </tr>
        <?php } $rst->closeCursor(); ?>
    </tbody>
</table>
<?php
}
?>
