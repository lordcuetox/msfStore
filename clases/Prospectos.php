<?php
/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class Prospectos {
    
     private $cveCliente;
    private $nombre;
    private $apellidoPat;
    private $apellidoMat;
    private $sexo;
    private $fechaNac;
    private $fechaRegistro;
    private $habilitado;
    private $fresita;
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

    function __construct1($cveCliente) {
        $this->limpiar();
        $this->cveCliente = $cveCliente;
        $this->cargar();
    }

    private function limpiar() {
        $this->cveCliente = 0;
        $this->nombre='';
        $this->apellidoPat='';
        $this->apellidoMat='';
        $this->sexo=true;
        $this->fechaNac=null;
        $this->fechaRegistro= null;
        $this->habilitado='';
        $this->fresita= '';
        $this->activo = false;
        $this->_existe = false;
  
    }
    function getCveCliente() {
        return $this->cveCliente;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidoPat() {
        return $this->apellidoPat;
    }

    function getApellidoMat() {
        return $this->apellidoMat;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFechaNac() {
        return $this->fechaNac;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getHabilitado() {
        return $this->habilitado;
    }

    function getFresita() {
        return $this->fresita;
    }

    function getActivo() {
        return $this->activo;
    }

    function setCveCliente($cveCliente) {
        $this->cveCliente = $cveCliente;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidoPat($apellidoPat) {
        $this->apellidoPat = $apellidoPat;
    }

    function setApellidoMat($apellidoMat) {
        $this->apellidoMat = $apellidoMat;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setHabilitado($habilitado) {
        $this->habilitado = $habilitado;
    }

    function setFresita($fresita) {
        $this->fresita = $fresita;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    
    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cveProducto = UtilDB::getSiguienteNumero("prospectos", "cve_cliente");
            $sql = "INSERT INTO prospectos (cve_cliente,nombre,"
                    . "apellido_pat, apellido_mat,sexo,fecha_nac,fecha_registro"
                    . ",habilitado,fresita,activo"
                    . ") VALUES($this->cveCliente,'$this->nombre','$this->apellidoPat','$this->apellidoMat',$this->sexo,"
                    . "'$this->fechaNac','$this->fechaRegistro','$this->habilitado','$this->fresita',"
                    . " $this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE prospectos SET ";
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
        $sql = "SELECT * FROM prospectos WHERE cve_cliente = $this->cveCliente";
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

