<?php
/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class MediosComunicacion {

    private $cveComunicacion;
    private $descripcion;
    private $activo;
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

    function __construct1($valor) {
        $this->limpiar();
        $this->cve_rito = $valor;
        $this->cargar();
    }

    private function limpiar() {
        $this->cveComunicacion = 0;
        $this->descripcion = 0;
        $this->activo = false;
        $this->_existe = false;
    }

    function getCveComunicacion() {
        return $this->cveComunicacion;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getActivo() {
        return $this->activo;
    }

    function setCveComunicacion($cveComunicacion) {
        $this->cveComunicacion = $cveComunicacion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    
    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cveComunicacion = UtilDB::getSiguienteNumero("medios_comunicacion", "cve_comunicacion");
            $sql = "INSERT INTO medios_comunicacion VALUES($this->cveComunicacion,'$this->descripcion',$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE medios_comunicacion SET ";
            $sql.= "descripcion = '$this->descripcion',";
            $sql.= "activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_comunicacion = $this->cveComunicacion";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM medios_comunicacion WHERE cve_comunicacion = $this->cveComunicacion";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveComunicacion = $row['cve_comunicacion'];
            $this->descripcion = $row['descripcion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}

?>
