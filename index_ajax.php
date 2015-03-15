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
                $tmp .= "<a href=\"javascript:void(0);\" class=\"list-group-item\" data-toggle=\"collapse\" data-target=\"#sm" . $row['cve_grado'] . "\" data-parent=\"#menu\">" . $row['descripcion'] . "</a>";
                $sql3 = "SELECT * FROM clasificaciones_productos WHERE cve_grado=" . $row['cve_grado'];
                $rst3 = UtilDB::ejecutaConsulta($sql3);
                if ($rst3->rowCount() > 0) {
                    $tmp .= "<div id=\"sm" . $row['cve_grado'] . "\" class=\"sublinks collapse\">";
                    foreach ($rst3 as $row3) {
                        $tmp .= "<a href=\"javascript:void(0);\" onclick=\"getProductos($cveRito,$cveClasificacion," . $row['cve_grado'] . "," . $row3['cve_clas_producto'] . ",'" . $row3['descripcion'] . "');\" class=\"list-group-item small\"><span class=\"glyphicon glyphicon-chevron-right\"></span>" . $row3['descripcion'] . "</a>";
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

    /* if ($_POST['xAccion'] == "getClasificacionProductos") {
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
      } */
    if ($_POST['xAccion'] == "getProductos") {
        if (isset($_POST['cveRito']) && isset($_POST['cveClasificacion']) && isset($_POST['cveGrado']) && isset($_POST['cveClasProducto']) && isset($_POST['nombreClasProducto'])) {
            $cveRito2 = $_POST['cveRito'];
            $cveClasificacion2 = $_POST['cveClasificacion'];
            $cveGrado2 = $_POST['cveGrado'];
            $cveClasProducto2 = $_POST['cveClasProducto'];
            $nombreClasProducto2 = $_POST['nombreClasProducto'];
            $count = 0;
            $tmp2 = "<div class=\"row\"><div class=\"col-md-12\"><h1>$nombreClasProducto2</h1></div></div>";

            $sql2 = "SELECT * FROM productos WHERE cve_rito = $cveRito2 AND cve_clasificacion= $cveClasificacion2 AND cve_grado=$cveGrado2 AND cve_clas_producto= $cveClasProducto2";
            $rst2 = UtilDB::ejecutaConsulta($sql2);

            if ($rst2->rowCount() > 0) {
                $tmp2 .= "<div class=\"row\">";
                foreach ($rst2 as $row2) {
                    //$tmp2 .="<div class=\"row\"><div class=\"col-md-12\"><h2>" . $row2['descripcion'] . "</h2></div></div>";
                    $count ++;
                    $tmp2 .= "<div class=\"col-md-4\"><img src=\"" . $row2['ruta_imagen1'] . "\" class=\"img-responsive\" alt=\"" . $row2['nombre'] . "\"/><h3>" . $row2['nombre'] . "</h3><a data-toggle=\"modal\" href=\"productos_id.php?id=".$row2['cve_producto']."\" data-target=\"#myModal\" class=\"btn btn-info\">Ver descripción</a><br/></div>";
                    if ($count % 3 == 0) {
                        $tmp2.="<div class=\"clearfix visible-sm\"></div>";
                        $tmp2.="<div class=\"clearfix visible-md\"></div>";
                        $tmp2.="<div class=\"clearfix visible-lg\"></div>";
                    }
                }
                $tmp2 .= "</div>";

                $tmp2 .= "<div class=\"row\">";
                $tmp2 .= "<div class=\"col-md-12\">";
                ?> 
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Modal title</h4>

                            </div>
                            <div class="modal-body"><div class="te"></div></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <?php
                $tmp2 .= "</div>";
                $tmp2 .= "</div>";
            } else {
                $tmp2 .= "<div class=\"row\"><div class=\"col-md-12\"><h2>0 productos cargados.</h2></div></div>";
            }

            $rst2->closeCursor();
            echo($tmp2);
        }
    }
}
?>