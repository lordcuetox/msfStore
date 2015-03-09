<?php
/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class ElReaton {

    private $cveReata;
    private $habilitado;
    private $fresita;
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
        $this->cveReata = $valor;
        $this->cargar();
    }

    private function limpiar() {
        $this->cveReata = 0;
        $this->habilitado = '';
        $this->fresita = '';
        $this->_existe = false;
    }

    function getCveReata() {
        return $this->cveReata;
    }

    function getHabilitado() {
        return $this->habilitado;
    }

    function getFresita() {
        return $this->fresita;
    }

    function setCveReata($cveReata) {
        $this->cveReata = $cveReata;
    }

    function setHabilitado($habilitado) {
        $this->habilitado = $habilitado;
    }

    function setFresita($fresita) {
        $this->fresita = $fresita;
    }

        
    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cveReata = UtilDB::getSiguienteNumero("el_reaton", "cve_reata");
            $sql = "INSERT INTO el_reaton (cve_reata,habilitado,fresita) VALUES($this->cveReata,'$this->habilitado','$this->fresita')";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE el_reaton SET ";
            $sql.= "habilitado = '$this->habilitado',";
            $sql.= "fresita = '$this->fresita'";
            $sql.= " WHERE cve_reata = $this->cveReata";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM el_reaton WHERE cve_reata = $this->cveReata";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveReata = $row['cve_reata'];
            $this->habilitado = $row['habilitado'];
            $this->fresita = $row['fresita'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}

?>
