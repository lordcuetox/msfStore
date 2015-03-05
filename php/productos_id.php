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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        $sql = "SELECT * FROM productos WHERE cve_producto=" . $_GET['id'];
        $rst = UtilDB::ejecutaConsulta($sql);
        foreach ($rst as $row) {
            ?>
            <div class="container">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <p><img src="<?php echo($row['ruta_imagen']); ?>" class="img-responsive"/></p>
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
    </body>
</html>
