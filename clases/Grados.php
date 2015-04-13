<?php
/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class Grados {


    private $cveRito;
    private $cveClasificacion;
    private $cveGrado;
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

    function __construct1($cveGrado) {
        $this->limpiar();
        $this->cveGrado = $cveGrado;
        $this->cargar();
    }

    private function limpiar() {

        $this->cveRito=0;
        $this->cveClasificacion=0;
        $this->cveGrado=0;
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
            $this->cveGrado = UtilDB::getSiguienteNumero("grados", "cve_grado");
            $sql = "INSERT INTO grados (cve_rito,cve_clasificacion,"
                    . "cve_grado,descripcion"
                    . ",activo"
                    . ") VALUES($this->cveRito,$this->cveClasificacion,$this->cveGrado,"
                    . "'$this->descripcion',"
                    . " $this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE grados SET ";
            $sql.= "cve_rito = $this->cveRito,";
            $sql.= "cve_clasificacion = $this->cveClasificacion,";
            $sql.= "descripcion = '$this->descripcion',";
            $sql.= "activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_grado = $this->cveGrado";
    
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM grados WHERE cve_grado = $this->cveGrado";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveRito = $row['cve_rito'];
            $this->cveClasificacion = $row['cve_clasificacion'];
            $this->cveGrado = $row['cve_grado'];
            $this->descripcion = $row['descripcion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }
    
          function borrar($cveGrado) {
                     $sql = "update  productos set activo =0 WHERE cve_grado = $cveGrado";
        $rst = UtilDB::ejecutaConsulta($sql);
               $sql = "UPDATE clasificaciones_productos SET activo=0 WHERE cve_grado = $cveGrado";
        $rst = UtilDB::ejecutaConsulta($sql);

               $sql = "UPDATE grados SET activo=0 WHERE cve_grado = $cveGrado";
        $rst = UtilDB::ejecutaConsulta($sql);

         $rst->closeCursor();
       
       }

}

?>

