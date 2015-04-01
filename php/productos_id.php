<?php
require_once '../clases/UtilDB.php';
$sql = "";
$msg = "";

if (isset($_GET['from'])) {
    if ($_GET['from'] == "ofertas") {
        $sql = "SELECT * FROM productos WHERE oferta = 1 AND ruta_imagen1 IS NOT NULL AND fecha_oferta >= NOW() AND cve_producto=" . $_GET['id'];
        $msg = "Lo sentimos la oferta ha expirado";
    }
    if ($_GET['from'] == "novedad") {
        $sql = "SELECT * FROM productos WHERE novedad = 1 AND ruta_imagen1 IS NOT NULL AND fecha_novedad >= NOW() AND cve_producto=" . $_GET['id'];
        $msg = "Lo sentimos, la novedad ha expirado";
    }
} else {
    $sql = "SELECT * FROM productos WHERE cve_producto=" . $_GET['id'];
    $msg = "Lo sentimos, su busqueda no tiene resultados";
}

$rst = UtilDB::ejecutaConsulta($sql);
if ($rst->rowCount() > 0) {
    foreach ($rst as $row) {
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo($row['nombre']); ?></h4>
        </div>
        <div class="modal-body">
            <div class="te">
                <?php
                if ($row['ruta_imagen1'] != NULL && $row['ruta_imagen2'] != NULL && $row['ruta_imagen3'] != NULL && $row['ruta_imagen4'] != NULL) {
                    ?>
                    <ul class="bxslider">
                        <li><img src="<?php echo($row['ruta_imagen1']); ?>" class="img-responsive"/></li>
                        <li><img src="<?php echo($row['ruta_imagen2']); ?>" class="img-responsive"/></li>
                        <li><img src="<?php echo($row['ruta_imagen3']); ?>" class="img-responsive"/></li>
                        <li><img src="<?php echo($row['ruta_imagen4']); ?>" class="img-responsive"/></li>
                    </ul>
                    <?php
                } elseif ($row['ruta_imagen1'] != NULL && $row['ruta_imagen2'] != NULL && $row['ruta_imagen3'] != NULL) {
                    ?>
                    <ul class="bxslider">
                        <li><img src="<?php echo($row['ruta_imagen1']); ?>" class="img-responsive"/></li>
                        <li><img src="<?php echo($row['ruta_imagen2']); ?>" class="img-responsive"/></li>
                        <li><img src="<?php echo($row['ruta_imagen3']); ?>" class="img-responsive"/></li>
                    </ul>
                    <?php
                } elseif ($row['ruta_imagen1'] != NULL && $row['ruta_imagen2'] != NULL) {
                    ?>
                    <ul class="bxslider">
                        <li><img src="<?php echo($row['ruta_imagen1']); ?>" class="img-responsive"/></li>
                        <li><img src="<?php echo($row['ruta_imagen2']); ?>" class="img-responsive"/></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <img src="<?php echo($row['ruta_imagen1']); ?>" class="img-responsive" style="margin:10px auto;"/>
                    <?php
                }
                ?>
                <p class="negritas">Descripción:</p>
                <p><?php echo($row['descripcion']); ?></p>
                <?php
                if ($row['oferta'] == 1) {
                ?>
                <p class="negritas_oferta">Precio oferta: $<?php echo($row['precio_oferta']); ?></p>
                <?php
                } else {
                ?>
                <p class="negritas_">Precio: $<?php echo($row['precio']); ?></p>
                <?php } ?>
        <!--<p class="negritas">Existencias: <?php echo($row['existencias']); ?></p>-->
                <p><a href="javascript:void(0);" onclick="addToShoppingCart(<?php echo($row['cve_producto']); ?>);"><img src="img/Shopping-cart-accept-icon.png" alt="Carrito de comprar" title="Agregar al carrito de compras <?php echo($row['nombre']); ?>" class="img-responsive"/></a></p>
                <p id="ajax_msg"></p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
        <?php
    }
} else {
    ?>    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Aviso importante</h4>
    </div>
    <div class="modal-body">
        <div class="te"><?php echo($msg); ?></div>
    </div> 
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
    <?php
}
?>