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
        $this->cvePedido =  $cvePedido;
        $this->cargar();
    }

    private function limpiar() {
        $this->cveCliente = 0;
        $this->cvePedido=0;
        $this->referencia='';
        $this->fecha=null;
        $this->status=int;
        $this->montoTotal=0;
        $this->fechaActualizacion= null;
        $this->numeroGuia='';
        $this->descripcionGuia= '';
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

        
    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cveProducto = UtilDB::getSiguienteNumero("pedidos", "cve_pedido");
            $sql = "INSERT INTO pedidos (cve_cliente,cve_pedido,"
                    . "referencia, fecha,status,monto_total,fecha_actualizacion"
                    . ",numero_guia,descripcion_guia"
                    . ") VALUES($this->cveCliente,$this->nombre,'$this->apellidoPat','$this->apellidoMat',$this->sexo,"
                    . "'$this->fechaNac','$this->fechaRegistro','$this->habilitado','$this->fresita',"
                    . " $this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE pedidos SET ";
            $sql.= "nombre= '$this->nombre',";
            $sql.= "apellido_pat='$this->apellidoPat',";
            $sql.= "apellido_mat='$this->apellidoMat',";
            $sql.= "sexo=". ($this->sexo ? "1" : "0");
            $sql.= ",fecha_nac = '$this->fechaNac',";
            $sql.= ",fecha_registro=' $this->fechaRegistro',";
            $sql.= ",habilitado = '$this->habilitado',";
            $sql.= ",fresita = '$this->fresita',";
            $sql.= "activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_cliente = $this->cveCliente";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM pedidos WHERE cve_pedido = $this->cvePedido";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveCliente = $row['cve_cliente'];
            $this->nombre = $row['nombre'];
            $this->apellidoPat = $row['apellido_pat'];
            $this->apellidoMat = $row['apellido_mat'];
            $this->sexo = $row['sexo'];
            $this->fechaNac = $row['fecha_nac'];
            $this->fechaRegistro = $row['fecha_registro'];
            $this->habilitado = $row['habilitado'];
            $this->fresita = $row['fresita'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}

?>

