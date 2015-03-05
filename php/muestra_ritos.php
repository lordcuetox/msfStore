<?php
require_once '../clases/UtilDB.php';
$sql = "SELECT * FROM ritos ORDER BY cve_rito";
$rst = UtilDB::ejecutaConsulta($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Muestra ritos</title>
    </head>
    <body><table>
            <thead>
                <tr>
                    <th>ID Rito</th>
                    <th>Descripción</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rst as $row) { ?>
                <tr>
                    <td><a href="javascript:void(0);" onclick="window.opener.document.frmRitos.txtIdRito.value='<?php echo($row['cve_rito']); ?>';window.opener.recargar();window.close();"><?php echo($row['cve_rito']); ?></a></td>
                    <td><?php echo($row['descripcion']); ?></td>
                    <td><?php echo($row['activo'] == 1? "Si":"No"); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </body>
</html>
