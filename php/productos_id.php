<?php
require_once '../clases/UtilDB.php';

$sql = "SELECT * FROM productos WHERE cve_producto=" . $_GET['id'];
$rst = UtilDB::ejecutaConsulta($sql);
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
            <p class="negritas">Precio: $<?php echo($row['precio']); ?></p>
            <p class="negritas">Existencias: <?php echo($row['existencias']); ?></p>
            <p><a href="javascript:void(0);" onclick="alert('El carrito de compras aun no esta terminado');"><img src="img/Shopping-cart-accept-icon.png" alt="Agregar al carrito de compras" class="img-responsive"/></a></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
    </div>
    <?php
}
?>