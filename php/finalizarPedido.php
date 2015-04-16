<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Finalizar Pedido</h4>
</div>
<div class="modal-body">
    <div class="te">
        <form class="form-horizontal" role="form" method="post" action="index.php" id="frmFinalizarPedido" name="frmFinalizarPedido">
            <div class="form-group">
                <label for="txtDireccionEnvio" class="col-lg-2 control-label">Dirección de envío:</label>
                <div class="col-lg-10">
                    <input class="form-control" type="hidden" name="xAccionPedido" id="xAccionPedido" value="0" />
                    <textarea class="form-control" rows="5" id="txtDireccionEnvio" name="txtDireccionEnvio"></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-success" onclick="if(confirm('¿Esta realmente seguro de finalizar el pedido?')){ finalizarPedido();}"><span class="glyphicon glyphicon-thumbs-up"></span> Finalizar pedido</button>
        </form>
    </div>
</div> 
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
