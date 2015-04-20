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
            <div id="carousel-productos-msfarreos" class="carousel slide" data-ride="carousel">


                <?php
                if ($producto->getRutaImagen1() != "" && $producto->getRutaImagen2() != "" && $producto->getRutaImagen3() != "" && $producto->getRutaImagen4() != "") {
                    ?>
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-productos-msfarreos" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-productos-msfarreos" data-slide-to="1"></li>
                        <li data-target="#carousel-productos-msfarreos" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="<?php echo($producto->getRutaImagen2()); ?>" alt="<?php echo($producto->getNombre()); ?> - Imagen 2">
                        </div>
                        <div class="item">
                            <img src="<?php echo($producto->getRutaImagen3()); ?>" alt="<?php echo($producto->getNombre()); ?> - Imagen 3">
                        </div>
                        <div class="item">
                            <img src="<?php echo($producto->getRutaImagen4()); ?>" alt="<?php echo($producto->getNombre()); ?> - Imagen 4">
                        </div>
                    </div>    
                    <?php
                } elseif ($producto->getRutaImagen1() != "" && $producto->getRutaImagen2() != "" && $producto->getRutaImagen3() != "") {
                    ?>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-productos-msfarreos" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-productos-msfarreos" data-slide-to="1"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="<?php echo($producto->getRutaImagen2()); ?>" alt="<?php echo($producto->getNombre()); ?> - Imagen 2">
                        </div>
                        <div class="item">
                            <img src="<?php echo($producto->getRutaImagen3()); ?>" alt="<?php echo($producto->getNombre()); ?> - Imagen 3">
                        </div>
                    </div>    
                    <?php
                } elseif ($producto->getRutaImagen1() != "" && $producto->getRutaImagen2() != "") {
                    ?>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-productos-msfarreos" data-slide-to="0" class="active"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="<?php echo($producto->getRutaImagen2()); ?>" alt="<?php echo($producto->getNombre()); ?> - Imagen 2">
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="<?php echo($producto->getRutaImagen1()); ?>" alt="<?php echo($producto->getNombre()); ?> - Imagen 1">
                        </div>
                    </div>
                    <?php
                }
                ?>


                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-productos-msfarreos" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-productos-msfarreos" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <p class="negritas">Descripción:</p>
            <p><?php echo($producto->getDescripcion()); ?></p>
            <p <?php if ($producto->isOfertaVigente()) {echo("style=\"color:red;\"");}?>>$ <?php echo $producto->getPrecio() ?> 
            <span <?php if ($producto->isOfertaVigente()) { echo("style=\"color:red;\"");}?>>
            <?php if ($producto->isOfertaVigente()) {echo("OFERTA!!");}?>
            </span>
            </p>
           <!--<p class="negritas">Existencias: <?php echo($producto->getExistencias()); ?></p>-->
            <p><a href="javascript:void(0);" onclick="addToShoppingCart(<?php echo($producto->getCveProducto()); ?>);" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Agregar</a></p>
            <p><a href="javascript:void(0);" data-toggle="modal" data-remote="php/viewShoppingCart.php" data-target="#mResumenCarritoCompras" class="btn btn-primary"><span class="glyphicon glyphicon-usd"></span> Comprar ahora</a></p>
            <div id="ajax_msg" class="alert alert-success" style="display: none"></div>
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