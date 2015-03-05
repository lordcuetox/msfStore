<?php require_once '../clases/UtilDB.php'; 
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) )
{ $cveRito =  $_POST['cveRito'];
  $cveClasificacion =  $_POST['cveClasificacion'];
?>
    <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                            <?php
                            $sql2 = "SELECT * FROM clasificaciones where cve_rito=$cveRito ORDER BY cve_clasificacion";
                            $rst2 = UtilDB::ejecutaConsulta($sql2);
                            foreach ($rst2 as $row) {
                                echo("<option value='" . $row['cve_clasificacion'] . "' " . ($cveClasificacion== $row['cve_clasificacion']  ? "selected" : "")  . ">" . $row['descripcion'] . "</option>");
                            }
                            $rst2->closeCursor();
                            ?> 

<?php
return;}
if(isset($_POST['cveRito']))
{ $cveRito =  $_POST['cveRito'];
?>

     <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                            <?php
                            $sql2 = "SELECT * FROM clasificaciones where cve_rito=$cveRito ORDER BY cve_clasificacion";
                            $rst2 = UtilDB::ejecutaConsulta($sql2);
                            foreach ($rst2 as $row) {
                                echo("<option value='" . $row['cve_clasificacion'] . "'> " . $row['descripcion'] . "</option>");
                            }
                            $rst2->closeCursor();
                            ?> 
<?php
return;}


?>
