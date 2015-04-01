<?php
/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class ComunicacionesClientes {


    private $cveCliente;
    private $cveComunicacion;
    private $consecutivoComunicacion;
    private $dato;
    private $activo;
    private $_existe;

    function __construct() {
        $this->limpiar();

        $args = func_get_args();
        $nargs = func_num_args();

        switch ($nargs) {
            case 1:
                self::__construct1($args[0],$args[1],$args[2]);
                break;
            case 2:
            self::__construct2($args[0], $args[1]);
            break;
        }
    }

    function __construct1($cveCliente,$cveComunicacion,$consecutivoComunicacion) {
        $this->limpiar();
        $this->cveCliente = $cveCliente;
        $this->cveComunicacion = $cveComunicacion;
       $this->consecutivoComunicacion = $consecutivoComunicacion;
        $this->cargar();
    }
        function __construct2($cveCliente,$cveComunicacion) {
        $this->limpiar();
        $this->cveCliente = $cveCliente;
        $this->cveComunicacion = $cveComunicacion;
        $this->cargar2();
    }

    private function limpiar() {

        $this->cveCliente=0;
        $this->cveComunicacion=0;
        $this->consecutivoComunicacion=0;
        $this->dato = '';
        $this->activo = false;
        $this->_existe = false;
  
    }
    function getCveCliente() {
        return $this->cveCliente;
    }

    function getCveComunicacion() {
        return $this->cveComunicacion;
    }

    function getConsecutivoComunicacion() {
        return $this->consecutivoComunicacion;
    }

    function getDato() {
        return $this->dato;
    }

    function getActivo() {
        return $this->activo;
    }

    function setCveCliente($cveCliente) {
        $this->cveCliente = $cveCliente;
    }

    function setCveComunicacion($cveComunicacion) {
        $this->cveComunicacion = $cveComunicacion;
    }

    function setConsecutivoComunicacion($consecutivoComunicacion) {
        $this->consecutivoComunicacion = $consecutivoComunicacion;
    }

    function setDato($dato) {
        $this->dato = $dato;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

        function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->consecutivoComunicacion = UtilDB::getSiguienteNumero("comunicaciones_clientes", "consecutivo_comunicacion");
            $sql = "INSERT INTO comunicaciones_clientes (cve_cliente,cve_comunicacion,"
                    . "consecutivo_comunicacion,dato"
                    . ",activo"
                    . ") VALUES($this->cveCliente,$this->cveComunicacion,$this->consecutivoComunicacion,"
                    . "'$this->dato',"
                    . " $this->activo)";
            
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE comunicaciones_clientes SET ";
            $sql.= ",dato = '$this->descripcion',";
            $sql.= "activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_cliente = $this->cveCliente";
            $sql.= " and cve_comunicacion = $this->cveComunicacion";
            $sql.= " and consecutivo_comunicacion = $this->consecutivoComunicacion";
            echo($sql);
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM comunicaciones_clientes WHERE cve_cliente = $this->cveCliente";
        $sql.= " and cve_comunicacion = $this->cveComunicacion";
       $sql.= " and consecutivo_comunicacion = $this->consecutivoComunicacion";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveCliente = $row['cve_cliente'];
            $this->cveComunicacion = $row['cve_comunicacion'];
            $this->consecutivoComunicacion = $row['consecutivo_comunicacion'];
            $this->dato = $row['dato'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }
    
    
    function cargar2() {
        $sql = "SELECT * FROM comunicaciones_clientes WHERE cve_cliente = $this->cveCliente";
        $sql.= " and cve_comunicacion = $this->cveComunicacion";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveCliente = $row['cve_cliente'];
            $this->cveComunicacion = $row['cve_comunicacion'];
            $this->consecutivoComunicacion = $row['consecutivo_comunicacion'];
            $this->dato = $row['dato'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}

?>

