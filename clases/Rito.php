<?php
/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
require_once('UtilDB.php');

class Rito {

    private $cve_rito;
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
        $this->cve_rito = 0;
        $this->descripcion = '';
        $this->activo = false;
        $this->_existe = false;
    }

    function getCve_rito() {
        return $this->cve_rito;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getActivo() {
        return $this->activo;
    }

    function setCve_rito($cve_rito) {
        $this->cve_rito = $cve_rito;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function toString() {
        return "Rito{cve_rito=$this->cve_rito,descripcion=$this->descripcion,activo=$this->activo}";
    }

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cve_rito = UtilDB::getSiguienteNumero("ritos", "cve_rito");
            $sql = "INSERT INTO ritos VALUES($this->cve_rito,'$this->descripcion',$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE ritos SET ";
            $sql.= "descripcion = '$this->descripcion',";
            $sql.= "activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_rito = $this->cve_rito";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM ritos WHERE cve_rito = $this->cve_rito";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cve_rito = $row['cve_rito'];
            $this->descripcion = $row['descripcion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}

?>
