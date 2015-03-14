<?php

require_once 'clases/UtilDB.php';
if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == "getGrados") {
        if (isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) && isset($_POST['nombreClasificacion'])) {
            $cveRito = $_POST['cveRito'];
            $cveClasificacion = $_POST['cveClasificacion'];
            $nombreClasificacion = $_POST['nombreClasificacion'];

            $sql = "SELECT * FROM grados WHERE cve_rito = $cveRito AND cve_clasificacion = $cveClasificacion";
            $rst = UtilDB::ejecutaConsulta($sql);
            $tmp = "<div id=\"menu\">";
            $tmp .= "<div class=\"panel list-group\">";
            $tmp .= "<a href=\"#\" class=\"list-group-item active\">$nombreClasificacion</a>";
            $tmp .= "<a href=\"#\" class=\"list-group-item\">&nbsp;</a>";

            foreach ($rst as $row) {
                //$tmp .= "<a href=\"javascript:void(0);\" class=\"list-group-item\" onclick=\"getClasificacionesProductos($cveRito,$cveClasificacion," . $row['cve_grado'] . ",'" . $row['descripcion'] . "');\">" . $row['descripcion'] . "</a>";
                $tmp .= "<a href=\"javascript:void(0);\" class=\"list-group-item\" data-toggle=\"collapse\" data-target=\"#sm".$row['cve_grado']."\" data-parent=\"#menu\">" . $row['descripcion'] . "</a>";
                $sql3 = "SELECT * FROM clasificaciones_productos WHERE cve_grado=".$row['cve_grado'];
                $rst3 = UtilDB::ejecutaConsulta($sql3);
                if($rst3->rowCount() > 0)
                {
                    $tmp .= "<div id=\"sm".$row['cve_grado']."\" class=\"sublinks collapse\">";
                    foreach ($rst3 as $row3)
                    { 
                      $tmp .= "<a class=\"list-group-item small\"><span class=\"glyphicon glyphicon-chevron-right\"></span>".$row3['descripcion']."</a>";
                    
                    }

                    $tmp .= "</div>";
                }
            }
            $rst->closeCursor();
            $tmp .= "</div>";
            $tmp .= "</div>";
            $tmp .= "<br/>";
            $tmp .= "<img src=\"img/contacto.png\" class=\"img-responsive\" alt=\"Contacto\"/>";
            echo($tmp);
        }
    }

    if ($_POST['xAccion'] == "getClasificacionProductos") {
        if (isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) && isset($_POST['cveGrado']) && isset($_POST['nombreGrado'])) {
            $cveRito2 = $_POST['cveRito'];
            $cveClasificacion2 = $_POST['cveClasificacion'];
            $cveGrado2 = $_POST['cveGrado'];
            $nombreGrado2 = $_POST['nombreGrado'];
            $tmp2 = "<div class=\"row\"><div class=\"col-md-12\"><h1>$nombreGrado2</h1></div></div>";

            $sql2 = "SELECT * FROM clasificaciones_productos WHERE cve_rito = $cveRito2 AND cve_clasificacion= $cveClasificacion2 AND cve_grado=$cveGrado2";
            $rst2 = UtilDB::ejecutaConsulta($sql2);
            foreach ($rst2 as $row2) {
                $tmp2 .="<div class=\"row\"><div class=\"col-md-12\"><h2>" . $row2['descripcion'] . "</h2></div></div>";
            }
            $rst2->closeCursor();
            echo($tmp2);
        }
    }
}
?>