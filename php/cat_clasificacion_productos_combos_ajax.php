<?php require_once '../clases/UtilDB.php'; 
session_start();

if (!isset($_SESSION['cve_usuario'])) 
{
    header('Location:login.php');
    return;
}
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) && isset($_POST['cveGrado'])&& isset($_POST['cveClasProducto']) )

{ $cveRito =  $_POST['cveRito'];
  $cveClasificacion =  $_POST['cveClasificacion'];
  $cveGrado =  $_POST['cveGrado'];
  $cveClasProducto =  $_POST['cveClasProducto'];
?>
    <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                            <?php
                            $sql2 = "SELECT * FROM clasificaciones_productos where cve_rito=$cveRito and cve_clasificacion=$cveClasificacion and cve_grado=$cveGrado  ORDER BY descripcion";
                        
                            $rst2 = UtilDB::ejecutaConsulta($sql2);
                            foreach ($rst2 as $row) {
                                  echo("<option value='" . $row['cve_clas_producto'] . "' " . ($cveClasProducto== $row['cve_clas_producto']  ? "selected" : "")  . ">" . $row['descripcion'] . "</option>");
                               
                            }
                            $rst2->closeCursor();
                            ?> 

<?php
return;}
if(isset($_POST['cveRito']) && isset($_POST['cveClasificacion'])&& isset($_POST['cveGrado']) )
{ $cveRito =  $_POST['cveRito'];
 $cveClasificacion =  $_POST['cveClasificacion'];
 $cveGrado =  $_POST['cveGrado'];
?>

     <option value="0">--------- SELECCIONE UNA OPCIÓN ---------</option>
                            <?php
                               $sql2 = "SELECT * FROM clasificaciones_productos where cve_rito=$cveRito and cve_clasificacion=$cveClasificacion  and cve_grado=$cveGrado"
                                       . " ORDER BY descripcion";
                            $rst2 = UtilDB::ejecutaConsulta($sql2);
                            foreach ($rst2 as $row) {
                               echo("<option value='" . $row['cve_clas_producto'] . "' " . ">" . $row['descripcion'] . "</option>");
                              
                            }
                            $rst2->closeCursor();
                            ?> 
<?php
return;}


?>
