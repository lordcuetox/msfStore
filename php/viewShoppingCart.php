<?php
session_start();
require('../Clases/ShoppingCart.php');
require('../Clases/Productos.php');
define("GASTOS_ENVIO",180);
$cart = NULL;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Resumen Carrito de compras</h4>
</div>
<div class="modal-body">
    <div class="te">
        <?php
        if (isset($_SESSION['carro'])) {
            $cart = unserialize($_SESSION['carro']);

            if (!$cart->isEmpty()) {
                ?>

                <table  border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr bgcolor="#333333" class="tit"> 
                        <td width="105">Producto</td>
                        <td width="207">Precio</td>
                        <td colspan="2" align="center">Cantidad de Unidades</td>
                        <td width="100" align="center">Borrar</td>
                        <td width="159" align="center">Actualizar</td>
                    </tr>
                    <?php
                    $color = array("#ffffff", "#F0F0F0");
                    $contador = 0;
                    $suma = 0;

                    foreach ($cart as $arr) {
                        $item = $arr['item'];
                        $subto = $arr['qty'] * $item->getPrecio();
                        $suma = $suma + $subto;
                        $contador++;
                        ?>
                        <form name="frmShoppingCart<?php echo($item->getCveProducto()); ?>" id="frmShoppingCart<?php echo($item->getCveProducto() ); ?>" method="post" action="php/agregacar.php">
                            <tr bgcolor="<?php echo $color[$contador % 2]; ?>" class='prod'> 
                                <td><?php echo $item->getNombre() ?></td>
                                <td <?php if($item->isOfertaVigente()){ echo("style=\"color:red;\"");}?>>$ <?php echo $item->getPrecio() ?> <span <?php if($item->isOfertaVigente()){ echo("style=\"color:red;\"");}?>><?php if($item->isOfertaVigente()){ echo("OFERTA!!");}?></span></td>
                                <td width="43" align="center"><?php echo $arr['qty'] ?></td>
                                <td width="136" align="center"> 
                                    <input name="txtCantidad" type="text" id="txtCantidad" value="<?php echo $arr['qty'] ?>" size="3">
                                    <input name="txtCveProducto" name="txtCveProducto" type="hidden" value="<?php echo($item->getCveProducto()); ?>"> 
                                </td>
                                <td align="center"><a href="php/borrarcar.php?xCveProducto=<?php echo $item->getCveProducto() ?>"><img src="img/trash.gif" width="12" height="14" border="0"></a></td>
                                <td align="center"><input name="imageField" type="image" src="img/actualizar.gif" width="20" height="20" border="0"></td>
                            </tr>
                        </form>
                        <?php
                    }
                    ?>
                </table>

                <div align="center"><span class="prod">Total de Artículos: <?php echo count($cart); ?></span></div><br>
                <div align="center"><span class="prod">Subtotal: $<?php echo number_format($suma, 2); ?></span></div><br>
                <div align="center"><span class="prod" style="color:red; font-weight:bold;">(+) Gastos de envío: $<?php echo(GASTOS_ENVIO); ?></span></div><br>
                <div align="center"><span class="prod">Total: $<?php echo number_format($suma+GASTOS_ENVIO, 2); ?></span></div><br>
                <div align="center"><span class="prod"><a href="javascript:void(0);" data-toggle="modal" data-remote="php/finalizarPedido.php" data-target="#myModalPedido" style="color:blue; font-size: 24px;">FINALIZAR PEDIDO</a></span></div><br/>
            <?php } else { ?>
                <p align="center"> <span class="prod">No hay productos seleccionados</span></p>
                <?php
            }
        }
        ?>

    </div>
</div>
<div class="modal-footer">
    Continuar la selección de productos <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-right"></span></button>
</div>