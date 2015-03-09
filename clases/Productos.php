<?php

/**
 *
 * @author Jorge José Jiménez Del Cueto
 * 
 */
require_once('UtilDB.php');

class Productos {

    private $cveRito;
    private $cveClasificacion;
    private $cveGrado;
    private $cveClasProducto;
    private $cveProducto;
    private $nombre;
    private $descripcion;
    private $rutaImagen;
    private $precio;
    private $novedad;
    private $fechaNovedad;
    private $oferta;
    private $fechaOferta;
    private $precioOferta;
    private $existencias;
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

    function __construct1($cveProducto) {
        $this->limpiar();
        $this->cveProducto = $cveProducto;
        $this->cargar();
    }

    private function limpiar() {
        $this->cveProducto = 0;
        $this->cveRito = 0;
        $this->cveClasificacion = 0;
        $this->cveGrado = 0;
        $this->cveClasProducto = 0;
        $this->nombre = '';
        $this->descripcion = '';
        $this->rutaImagen1 = '';
        $this->rutaImagen2 = '';
        $this->rutaImagen3 = '';
        $this->rutaImagen4 = '';
        $this->precio = 0.0;
        $this->novedad = false;
        $this->fechaNovedad = null;
        $this->oferta = false;
        $this->fechaOferta = null;
        $this->precioOferta = 0.0;
        $this->existencias = 0;
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

    function getCveProducto() {
        return $this->cveProducto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getRutaImagen1() {
        return $this->rutaImagen1;
    }

    function getRutaImagen2() {
        return $this->rutaImagen2;
    }

    function getRutaImagen3() {
        return $this->rutaImagen3;
    }

    function getRutaImagen4() {
        return $this->rutaImagen4;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getNovedad() {
        return $this->novedad;
    }

    function getFechaNovedad() {
        return $this->fechaNovedad;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFechaOferta() {
        return $this->fechaOferta;
    }

    function getPrecioOferta() {
        return $this->precioOferta;
    }

    function getExistencias() {
        return $this->existencias;
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

    function setCveProducto($cveProducto) {
        $this->cveProducto = $cveProducto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setRutaImagen1($rutaImagen1) {
        $this->rutaImagen1 = $rutaImagen1;
    }

    function setRutaImagen2($rutaImagen2) {
        $this->rutaImagen2 = $rutaImagen2;
    }

    function setRutaImagen3($rutaImagen3) {
        $this->rutaImagen3 = $rutaImagen3;
    }

    function setRutaImagen4($rutaImagen4) {
        $this->rutaImagen4 = $rutaImagen4;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setNovedad($novedad) {
        $this->novedad = $novedad;
    }

    function setFechaNovedad($fechaNovedad) {
        $this->fechaNovedad = $fechaNovedad;
    }

    function setOferta($oferta) {
        $this->oferta = $oferta;
    }

    function setFechaOferta($fechaOferta) {
        $this->fechaOferta = $fechaOferta;
    }

    function setPrecioOferta($precioOferta) {
        $this->precioOferta = $precioOferta;
    }

    function setExistencias($existencias) {
        $this->existencias = $existencias;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->cveProducto = UtilDB::getSiguienteNumero("Productos", "cve_producto");
            $sql = "INSERT INTO productos (cve_rito,cve_clasificacion,"
                    . "cve_grado, cve_clas_producto,cve_producto,nombre,descripcion"
                    . ",precio,novedad,fecha_novedad,oferta,fecha_oferta,precio_oferta,existencias,activo"
                    . ") VALUES($this->cveRito,$this->cveClasificacion,$this->cveGrado,$this->cveClasProducto,$this->cveProducto,"
                    . "'$this->nombre','$this->descripcion',$this->precio,$this->novedad,'$this->fechaNovedad',$this->oferta,"
                    . "'$this->fechaOferta',$this->precioOferta,$this->existencias,$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql.= "UPDATE productos SET ";
            $sql.= "cve_rito= $this->cveRito,";
            $sql.= "cve_clasificacion= $this->cveClasificacion,";
            $sql.= "cve_grado= $this->cveGrado,";
            $sql.= "cve_clas_producto= $this->cveClasProducto,";
            $sql.= "ruta_imagen1= '$this->rutaImagen1',";
            $sql.= "ruta_imagen2= '$this->rutaImagen2',";
            $sql.= "ruta_imagen3= '$this->rutaImagen3',";
            $sql.= "ruta_imagen4= '$this->rutaImagen4',";
            $sql.= "nombre='$this->nombre',";
            $sql.= "precio='$this->precio',";
            $sql.= "novedad=" . ($this->novedad ? "1" : "0");
            $sql.= ",fecha_novedad = '$this->fechaNovedad',";
            $sql.= "oferta=" . ($this->oferta ? "1" : "0");
            $sql.= ",fecha_oferta = '$this->fechaOferta',";
            $sql.= "descripcion = '$this->descripcion',";
            $sql.= "precio_oferta = '$this->precioOferta',";
            $sql.= "activo=" . ($this->activo ? "1" : "0");
            $sql.= " WHERE cve_producto = $this->cveProducto";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM productos WHERE cve_producto = $this->cveProducto";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveRito = $row['cve_rito'];
            $this->cveClasificacion = $row['cve_clasificacion'];
            $this->cveGrado = $row['cve_grado'];
            $this->cveProducto = $row['cve_producto'];
            $this->cveClasProducto = $row['cve_clas_producto'];
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->rutaImagen1 = $row['ruta_imagen1'];
            $this->rutaImagen2 = $row['ruta_imagen2'];
            $this->rutaImagen3 = $row['ruta_imagen3'];
            $this->rutaImagen4 = $row['ruta_imagen4'];
            $this->precio = $row['precio'];
            $this->novedad = $row['novedad'];
            $this->fechaNovedad = $row['fecha_novedad'];
            $this->oferta = $row['oferta'];
            $this->fechaOferta = $row['fecha_oferta'];
            $this->precioOferta = $row['precio_oferta'];
            $this->existencias = $row['existencias'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
?>

