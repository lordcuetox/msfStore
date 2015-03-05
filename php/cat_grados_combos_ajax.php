<?php require_once '../clases/UtilDB.php'; 
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) && isset($_POST['cveGrado']) )

{ $cveRito =  $_POST['cveRito'];
  $cveClasificacion =  $_POST['cveClasificacion'];
  $cveGrado =  $_POST['cveGrado'];
?>
    <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                            <?php
                            $sql2 = "SELECT * FROM grados where cve_rito=$cveRito and cve_clasificacion=$cveClasificacion  ORDER BY cve_clasificacion";
                        
                            $rst2 = UtilDB::ejecutaConsulta($sql2);
                            foreach ($rst2 as $row) {
                                  echo("<option value='" . $row['cve_grado'] . "' " . ($cveGrado== $row['cve_grado']  ? "selected" : "")  . ">" . $row['descripcion'] . "</option>");
                               
                            }
                            $rst2->closeCursor();
                            ?> 

<?php
return;}
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) )
{ $cveRito =  $_POST['cveRito'];
 $cveClasificacion =  $_POST['cveClasificacion'];
?>

     <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                            <?php
                               $sql2 = "SELECT * FROM grados where cve_rito=$cveRito and cve_clasificacion=$cveClasificacion ORDER BY cve_grado";
                            $rst2 = UtilDB::ejecutaConsulta($sql2);
                            foreach ($rst2 as $row) {
                               echo("<option value='" . $row['cve_grado'] . "' " . ">" . $row['descripcion'] . "</option>");
                              
                            }
                            $rst2->closeCursor();
                            ?> 
<?php
return;}


?>
