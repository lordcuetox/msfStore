<?php

/**
 * Description of newPHPClass
 *
 * @author Weiss
 */
class DetallePedido {

    private $cve_cliente;
    private $cve_pedido;
    private $cve_rito;
    private $cve_clasificacion;
    private $cve_grado;
    private $cve_clas_producto;
    private $cve_producto;
    private $etiqueta_producto;
    private $cantidad;
    private $precio_unitario;
    private $descuento;
    private $precio_unitario_desc;
    private $monto_total_pagar;
    private $_existe;

    function __construct() {
        $this->limpiar();

        $args = func_get_args();
        $nargs = func_num_args();

        switch ($nargs) {
            case 1:
                self::__construct1($args[0]);
                break;
            //case 2:
            //self::__construct2($args[0], $args[1]);
            //break;
        }
    }

    function __construct1($cveCliente, $cvePedido, $cveRito, $cveClasificacion, $cveGrado, $cveClasProducto, $cveProducto) {
        $this->limpiar();
        $this->cve_cliente = $cveCliente;
        $this->cve_pedido = $cvePedido;
        $this->cve_rito = $cveRito;
        $this->cve_clasificacion = $cveClasificacion;
        $this->cve_grado = $cveGrado;
        $this->cve_clas_producto = $cveClasProducto;
        $this->cve_producto = $cveProducto;
        $this->cargar();
    }

    private function limpiar() {
        $this->cve_cliente = 0;
        $this->cve_pedido = 0;
        $this->cve_rito = 0;
        $this->cve_clasificacion = 0;
        $this->cve_grado = 0;
        $this->cve_clas_producto = 0;
        $this->cve_producto = 0;
        $this->etiqueta_producto = "";
        $this->cantidad = 0;
        $this->precio_unitario = 0.0;
        $this->descuento = 0;
        $this->precio_unitario_desc = 0.0;
        $this->monto_total_pagar = 0.0;
        $this->_existe = false;
    }

    function getCve_cliente() {
        return $this->cve_cliente;
    }

    function getCve_pedido() {
        return $this->cve_pedido;
    }

    function getCve_rito() {
        return $this->cve_rito;
    }

    function getCve_clasificacion() {
        return $this->cve_clasificacion;
    }

    function getCve_grado() {
        return $this->cve_grado;
    }

    function getCve_clas_producto() {
        return $this->cve_clas_producto;
    }

    function getCve_producto() {
        return $this->cve_producto;
    }

    function getEtiqueta_producto() {
        return $this->etiqueta_producto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecio_unitario() {
        return $this->precio_unitario;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getPrecio_unitario_desc() {
        return $this->precio_unitario_desc;
    }

    function getMonto_total_pagar() {
        return $this->monto_total_pagar;
    }

    function setCve_cliente($cve_cliente) {
        $this->cve_cliente = $cve_cliente;
    }

    function setCve_pedido($cve_pedido) {
        $this->cve_pedido = $cve_pedido;
    }

    function setCve_rito($cve_rito) {
        $this->cve_rito = $cve_rito;
    }

    function setCve_clasificacion($cve_clasificacion) {
        $this->cve_clasificacion = $cve_clasificacion;
    }

    function setCve_grado($cve_grado) {
        $this->cve_grado = $cve_grado;
    }

    function setCve_clas_producto($cve_clas_producto) {
        $this->cve_clas_producto = $cve_clas_producto;
    }

    function setCve_producto($cve_producto) {
        $this->cve_producto = $cve_producto;
    }

    function setEtiqueta_producto($etiqueta_producto) {
        $this->etiqueta_producto = $etiqueta_producto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio_unitario($precio_unitario) {
        $this->precio_unitario = $precio_unitario;
    }

    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    function setPrecio_unitario_desc($precio_unitario_desc) {
        $this->precio_unitario_desc = $precio_unitario_desc;
    }

    function setMonto_total_pagar($monto_total_pagar) {
        $this->monto_total_pagar = $monto_total_pagar;
    }

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $sql = "INSERT INTO detalle_pedido (cve_cliente,cve_pedido,cve_rito,cve_clasificacion,cve_grado,cve_clas_producto,cve_producto,etiqueta_producto,cantidad,precio_unitario,descuento,precio_unitario_desc,monto_total_pagar) VALUES($this->cve_cliente,$this->cve_pedido,$this->cve_rito,$this->cve_clasificacion,$this->cve_grado,$this->cve_clas_producto,$this->cve_producto,'$this->etiqueta_producto',$this->cantidad,$this->precio_unitario,$this->descuento,$this->precio_unitario_desc,$this->monto_total_pagar)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE detalle_pedido SET etiqueta_producto = '$this->etiqueta_producto',cantidad = $this->cantidad,precio_unitario = $this->precio_unitario,descuento = $this->descuento,precio_unitario_desc = $this->precio_unitario_desc,monto_total_pagar = $this->monto_total_pagar";
            $sql .= " WHERE  cve_cliente = $this->cve_cliente";
            $sql .= " AND cve_pedido = $this->cve_pedido";
            $sql .= " AND cve_rito = $this->cve_rito";
            $sql .= " AND cve_clasificacion = $this->cve_clasificacion";
            $sql .= " AND cve_grado = $this->cve_grado";
            $sql .= " AND cve_clas_producto = $this->cve_clas_producto";
            $sql .= " AND cve_producto = $this->cve_producto";
            $count = UtilDB::ejecutaSQL($sql);
        }


        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM detalle_pedido WHERE cve_cliente = $this->cve_cliente";
        $sql .= "  AND cve_pedido = " . $this->cve_pedido;
        $sql .= "  AND cve_rito = " . $this->cve_rito;
        $sql .= "  AND cve_clasificacion = " . $this->cve_clasificacion;
        $sql .= "  AND cve_grado = " . $this->cve_grado;
        $sql .= "  AND cve_clas_producto = " . $this->cve_clas_producto;
        $sql .= "  AND cve_producto = " . $this->cve_producto;
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cve_cliente = $row['cve_cliente'];
            $this->cve_pedido = $row['cve_pedido'];
            $this->cve_rito = $row['cve_rito'];
            $this->cve_clasificacion = $row['cve_clasificacion'];
            $this->cve_grado = $row['cve_grado'];
            $this->cve_clas_producto = $row['cve_clas_producto'];
            $this->cve_producto = $row['cve_producto'];
            $this->etiqueta_producto = $row['etiqueta_producto'];
            $this->cantidad = $row['cantidad'];
            $this->precio_unitario = $row['precio_unitario'];
            $this->descuento = $row['descuento'];
            $this->precio_unitario_desc = $row['precio_unitario_desc'];
            $this->monto_total_pagar = $row['monto_total_pagar'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}

?>