<?php

/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class Pedidos {

    private $cveCliente;
    private $cvePedido;
    private $referencia;
    private $fecha;
    private $status;
    private $montoTotal;
    private $fechaActualizacion;
    private $numeroGuia;
    private $descripcionGuia;
    private $direccionEnvio;
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

    function __construct1($cvePedido) {
        $this->limpiar();
        $this->cvePedido = $cvePedido;
        $this->cargar();
    }

    private function limpiar() {
        $this->cveCliente = 0;
        $this->cvePedido = 0;
        $this->referencia = '';
        $this->fecha = null;
        $this->status = 0;
        $this->montoTotal = 0;
        $this->fechaActualizacion = null;
        $this->numeroGuia = '';
        $this->descripcionGuia = '';
        $this->direccionEnvio = '';
        $this->_existe = false;
    }

    function getCveCliente() {
        return $this->cveCliente;
    }

    function getCvePedido() {
        return $this->cvePedido;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getStatus() {
        return $this->status;
    }

    function getMontoTotal() {
        return $this->montoTotal;
    }

    function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    function getNumeroGuia() {
        return $this->numeroGuia;
    }

    function getDescripcionGuia() {
        return $this->descripcionGuia;
    }

    function getDireccionEnvio() {
        return $this->direccionEnvio;
    }
    
     function existe() {
        return $this->_existe;
    }

    function setCveCliente($cveCliente) {
        $this->cveCliente = $cveCliente;
    }

    function setCvePedido($cvePedido) {
        $this->cvePedido = $cvePedido;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setMontoTotal($montoTotal) {
        $this->montoTotal = $montoTotal;
    }

    function setFechaActualizacion($fechaActualizacion) {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    function setNumeroGuia($numeroGuia) {
        $this->numeroGuia = $numeroGuia;
    }

    function setDescripcionGuia($descripcionGuia) {
        $this->descripcionGuia = $descripcionGuia;
    }

    function setDireccionEnvio($direccionEnvio) {
        $this->direccionEnvio = $direccionEnvio;
    }

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cvePedido = UtilDB::getSiguienteNumero("pedidos", "cve_pedido");
            $sql = "INSERT INTO pedidos (cve_cliente,cve_pedido,"
                    . "referencia, fecha,status,monto_total,direccion_envio"
                    . ") VALUES($this->cveCliente,$this->cvePedido,'$this->referencia',NOW(),$this->status,$this->montoTotal,"
                    . "'$this->direccionEnvio')";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE pedidos SET ";
            $sql.= "referencia= '$this->referencia',";
            $sql.= "monto_total= $this->montoTotal,";
            $sql.= "status= $this->status,";
            $sql.= "fecha_actualizacion=NOW(),";
            $sql.= "numero_guia='$this->numeroGuia',";
            $sql.= "descripcion_guia = '$this->descripcionGuia' ";
            $sql.= " WHERE cve_cliente = $this->cveCliente and cve_pedido= $this->cvePedido";
            $count = UtilDB::ejecutaSQL($sql);
        }


        return $count;
    }

    function  cargar() {
        $sql = "SELECT * FROM pedidos WHERE cve_pedido = $this->cvePedido";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveCliente = $row['cve_cliente'];
            $this->cvePedido = $row['cve_pedido'];
            $this->referencia = $row['referencia'];
            $this->fecha = $row['fecha'];
            $this->status = $row['status'];
            $this->montoTotal = $row['monto_total'];
            $this->fechaActualizacion = $row['fecha_actualizacion'];
            $this->numeroGuia = $row['numero_guia'];
            $this->descripcionGuia = $row['descripcion_guia'];
            $this->direccionEnvio = $row['direccion_envio'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }
    
    
    function  cargar2($cveCliente,$cvePedido) {
        $sql = "SELECT * FROM pedidos WHERE cve_pedido = $cvePedido and cve_cliente=$cveCliente";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveCliente = $row['cve_cliente'];
            $this->cvePedido = $row['cve_pedido'];
            $this->referencia = $row['referencia'];
            $this->fecha = $row['fecha'];
            $this->status = $row['status'];
            $this->montoTotal = $row['monto_total'];
            $this->fechaActualizacion = $row['fecha_actualizacion'];
            $this->numeroGuia = $row['numero_guia'];
            $this->descripcionGuia = $row['descripcion_guia'];
            $this->direccionEnvio = $row['direccion_envio'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
?>