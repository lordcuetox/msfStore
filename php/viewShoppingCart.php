<?php
require_once '../clases/ShoppingCart.php';
require_once '../clases/Productos.php';
session_start();
define("GASTOS_ENVIO", 180);
$cart = NULL;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Resumen Carrito de Compras</h4>
</div>
<div class="modal-body">
    <div class="te">
        <?php
        if (isset($_SESSION['carro'])) {
            $cart = unserialize($_SESSION['carro']);

            if (!$cart->isEmpty()) {
                ?>
                <form name="frmShoppingCart" id="frmShoppingCart" method="post" action="php/agregacar.php">
                    <input type="hidden" name="xAccion" id="xAccion" value="0" />
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
                            $id_producto = $item->getCveProducto();
                            ?>
                            <tr bgcolor="<?php echo $color[$contador % 2]; ?>" class='prod'> 
                                <td><?php echo $item->getNombre() ?></td>
                                <td <?php
                                if ($item->isOfertaVigente()) {
                                    echo("style=\"color:red;\"");
                                }
                                ?>>$ <?php echo $item->getPrecio() ?> <span <?php
                                        if ($item->isOfertaVigente()) {
                                            echo("style=\"color:red;\"");
                                        }
                                        ?>><?php
                                            if ($item->isOfertaVigente()) {
                                                echo("OFERTA!!");
                                            }
                                            ?></span></td>
                                <td width="43" align="center"><?php echo $arr['qty'] ?></td>
                                <td width="136" align="center">
                                    <input name="txtCveProducto<?php echo($id_producto); ?>" type="hidden" id="txtCveProducto<?php echo($id_producto); ?>" value="<?php echo($id_producto); ?>">
                                    <input name="txtCantidad<?php echo($id_producto); ?>" type="text" id="txtCantidad<?php echo($id_producto); ?>" value="<?php echo $arr['qty'] ?>" size="3">
                                </td>
                                <td align="center"><a href="php/borrarcar.php?xCveProducto=<?php echo($id_producto) ?>" class="btn"><span class="glyphicon glyphicon-trash"></span></a></td>
                                <td align="center"><a href="javascript:void(0);" onclick="$('#xAccion').val('update');$('#frmShoppingCart').submit();" class="btn"><span class="glyphicon glyphicon-repeat"></span></a></td>
                            </tr>

                            <?php
                        }
                        ?>
                    </table>
                </form>
                <div align="center"><span class="prod">Total de Artículos: <?php echo count($cart); ?></span></div><br>
                <div align="center"><span class="prod">Subtotal: $<?php echo number_format($suma, 2); ?></span></div><br>
                <div align="center"><span class="prod" style="color:red; font-weight:bold;">(+) Gastos de envío: $<?php echo(GASTOS_ENVIO); ?></span></div><br>
                <div align="center"><span class="prod">Total: $<?php echo number_format($suma + GASTOS_ENVIO, 2); ?></span></div><br>
                <div align="center"><span class="prod"><a href="javascript:void(0);" data-toggle="modal" data-remote="php/finalizarPedido.php" data-target="#myModalPedido" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Finalizar pedido</a></span></div><br/>
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