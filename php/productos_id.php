<!--
/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
-->
<?php
require_once '../clases/UtilDB.php';
?>
<?php
$sql = "SELECT * FROM productos WHERE cve_producto=" . $_GET['id'];
$rst = UtilDB::ejecutaConsulta($sql);
foreach ($rst as $row) {
    ?>
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <p><img src="<?php echo($row['ruta_imagen1']); ?>" class="img-responsive"/></p>
                <p>Nombre producto: <?php echo($row['nombre']); ?></p>
                <p>Descripción: <?php echo($row['descripcion']); ?></p>
                <p>Precio: $<?php echo($row['precio']); ?></p>
                <p>Existencias: <?php echo($row['existencias']); ?></p>
                <p><a href="javascript:void(0);" onclick="alert('El carrito de compras aun no esta terminado');"><img src="img/Shopping-cart-accept-icon.png" alt="Agregar al carrito de compras" class="img-responsive"/></a></p>
            </div>
        </div>
    </div>
    <?php
}
?>