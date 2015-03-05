<?php
/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class ClasificacionProductos {
    
    private $cveRito;
    private $cveClasificacion;
    private $cveGrado;
    private $cveClasProducto;
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

    function __construct1($cveClaProducto) {
        $this->limpiar();
        $this->cveClasProducto = $cveClaProducto;
        $this->cargar();
    }

    private function limpiar() {

        $this->cveRito=0;
        $this->cveClasificacion=0;
        $this->cveGrado=0;
        $this->cveClasProducto=0;
        $this->descripcion = "";
        $this->activo = false;
        $this->_existe = false;
  
    }

    function getCveRito() {
        return $this->cveRito;
    }

    function getCveClasificacion() {
        return $this->cveClasificacion;
    }

    function getCveGrado() {
        return $this->cveGrado;
    }

    function getCveClasProducto() {
        return $this->cveClasProducto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getActivo() {
        return $this->activo;
    }

    function setCveRito($cveRito) {
        $this->cveRito = $cveRito;
    }

    function setCveClasificacion($cveClasificacion) {
        $this->cveClasificacion = $cveClasificacion;
    }

    function setCveGrado($cveGrado) {
        $this->cveGrado = $cveGrado;
    }

    function setCveClasProducto($cveClasProducto) {
        $this->cveClasProducto = $cveClasProducto;
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
            $this->cveClasProducto = UtilDB::getSiguienteNumero("clasificaciones_productos", "cve_clas_producto");
            $sql = "INSERT INTO clasificaciones_productos (cve_rito,cve_clasificacion,"
                    . "cve_grado, cve_clas_producto,descripcion"
                    . ",activo"
                    . ") VALUES($this->cveRito,'$this->cveClasificacion','$this->cveGrado','$this->cveClasProducto'"
                    . ",'$this->descripcion',"
                    . "$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE clasificaciones_productos SET ";
            $sql.= " cve_rito = $this->cveRito,";
            $sql.= "cve_clasificacion = $this->cveClasificacion,";
            $sql.= "cve_grado = $this->cveGrado,";
            $sql.= "descripcion = '$this->descripcion',";
            $sql.= "activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_clas_producto = $this->cveClasProducto";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM clasificaciones_productos WHERE cve_clas_producto = $this->cveClasProducto";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveRito = $row['cve_rito'];
            $this->cveClasificacion = $row['cve_clasificacion'];
            $this->cveGrado = $row['cve_grado'];
             $this->cveClasProducto = $row['cve_clas_producto'];
            $this->descripcion = $row['descripcion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}

?>

