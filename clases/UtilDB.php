<?php
/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */

class UtilDB {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "msfstore";
    private static $cnx = NULL;

    function __construct() {
        
    }

    static function getConnection() {
        try {
            $cnx = new PDO("mysql:host=localhost;dbname=msfstore", "root", "");
            // set the PDO error mode to exception
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cnx->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
            //echo "Connected successfully";
        } catch (PDOException $e) {
            //echo "Connection failed: " . $e->getMessage();
        }
        return $cnx;
    }

    static function getSiguienteNumero($tabla, $campo) {
        $cnx2 = UtilDB::getConnection();
        $sql = "SELECT MAX($campo) AS num FROM $tabla";
        $num = 0;
        if ($resultado = $cnx2->query($sql)) {

            /* Comprobar el número de filas que coinciden con la sentencia SELECT */
            if ($resultado->fetchColumn() > 0) {

                foreach ($cnx2->query($sql) as $row) {
                    $num = $row['num'] + 1;
                }
            } else {
                $num = 1;
            }
        }

        return $num;
    }

    static function ejecutaConsulta($sql) {
        $cnx3 = UtilDB::getConnection();
        $rst = $cnx3->query($sql);
        return $rst;
    }

    static function ejecutaSQL($sql) {
        $cnx4 = UtilDB::getConnection();
        $count = $cnx4->exec($sql);
        $cnx4 = NULL;
        return $count;
    }

}
