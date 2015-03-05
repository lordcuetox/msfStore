<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class Clasificacion {

    private $cve_clasificacion;
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
        }
    }

    function __construct1($cve_clasificacion) {
        $this->limpiar();
        $this->cve_clasificacion = $cve_clasificacion;
        $this->cargar();
    }

    private function limpiar() {
        $this->cve_clasificacion = 0;
        $this->cve_rito = new Rito();
        $this->descripcion = "";
        $this->activo = false;
        $this->_existe = false;
    }

    function getCve_clasificacion() {
        return $this->cve_clasificacion;
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

    function setCve_clasificacion($cve_clasificacion) {
        $this->cve_clasificacion = $cve_clasificacion;
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

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cve_clasificacion = UtilDB::getSiguienteNumero("clasificaciones", "cve_clasificacion");
            $sql = "INSERT INTO clasificaciones VALUES($this->cve_clasificacion,".$this->cve_rito->getCve_rito().",'$this->descripcion',$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE CLASIFICACIONES SET ";
            $sql.= "cve_rito=".$this->cve_rito->getCve_rito();
            $sql.= ",descripcion = '$this->descripcion',";
            $sql.= " activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_clasificacion = $this->cve_clasificacion";
            $count = UtilDB::ejecutaSQL($sql);
            
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM clasificaciones WHERE cve_clasificacion = $this->cve_clasificacion";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cve_clasificacion = $row['cve_clasificacion'];
            $this->cve_rito = new Rito($row['cve_rito']);
            $this->descripcion = $row['descripcion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }

        $rst->closeCursor();
    }

}
