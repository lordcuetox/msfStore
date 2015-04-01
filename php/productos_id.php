<?php
require_once '../clases/UtilDB.php';
require_once('../clases/Productos.php');
$producto = "";
$sql = "";
$msg = "";

if (isset($_GET['id'])) {
    $producto = new Productos((int) $_GET['id']);
} else {
    $producto = new Productos();
    $msg = "Lo sentimos, su busqueda no tiene resultados";
}

if ($producto->getCveProducto() != 0) {
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo($producto->getNombre()); ?></h4>
    </div>
    <div class="modal-body">
        <div class="te">
            <?php
            if ($producto->getRutaImagen1() != "" && $producto->getRutaImagen2() != "" && $producto->getRutaImagen3() != "" && $producto->getRutaImagen4() != "") {
                ?>
                <ul class="bxslider">
                    <li><img src="<?php echo($producto->getRutaImagen1()); ?>" class="img-responsive"/></li>
                    <li><img src="<?php echo($producto->getRutaImagen2()); ?>" class="img-responsive"/></li>
                    <li><img src="<?php echo($producto->getRutaImagen3()); ?>" class="img-responsive"/></li>
                    <li><img src="<?php echo($producto->getRutaImagen4()); ?>" class="img-responsive"/></li>
                </ul>
                <?php
            } elseif ($producto->getRutaImagen1() != "" && $producto->getRutaImagen2() != "" && $producto->getRutaImagen3() != "") {
                ?>
                <ul class="bxslider">
                    <li><img src="<?php echo($producto->getRutaImagen1()); ?>" class="img-responsive"/></li>
                    <li><img src="<?php echo($producto->getRutaImagen2()); ?>" class="img-responsive"/></li>
                    <li><img src="<?php echo($producto->getRutaImagen3()); ?>" class="img-responsive"/></li>
                </ul>
                <?php
            } elseif ($producto->getRutaImagen1() != "" && $producto->getRutaImagen2() != "") {
                ?>
                <ul class="bxslider">
                    <li><img src="<?php echo($producto->getRutaImagen1()); ?>" class="img-responsive"/></li>
                    <li><img src="<?php echo($producto->getRutaImagen2()); ?>" class="img-responsive"/></li>
                </ul>
                <?php
            } else {
                ?>
                <img src="<?php echo($producto->getRutaImagen1()); ?>" class="img-responsive" style="margin:10px auto;"/>
                <?php
            }
            ?>
            <p class="negritas">Descripción:</p>
            <p><?php echo($producto->getDescripcion()); ?></p>
            <p <?php
            if ($producto->isOfertaVigente()) {
                echo("style=\"color:red;\"");
            }
            ?>>$ <?php echo $producto->getPrecio() ?> <span <?php
                        if ($producto->isOfertaVigente()) {
                            echo("style=\"color:red;\"");
                        }
                        ?>><?php
                        if ($producto->isOfertaVigente()) {
                            echo("OFERTA!!");
                        }
                        ?></span></p>
           <!--<p class="negritas">Existencias: <?php echo($producto->getExistencias()); ?></p>-->
            <p><a href="javascript:void(0);" onclick="addToShoppingCart(<?php echo($producto->getCveProducto()); ?>);"><img src="img/Shopping-cart-accept-icon.png" alt="Carrito de comprar" title="Agregar al carrito de compras <?php echo($producto->getNombre()); ?>" class="img-responsive"/></a></p>
            <p id="ajax_msg"></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
    <?php
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