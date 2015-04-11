<?php
require_once ('../clases/PDF.php');
if (isset($_GET['CvePedido'])) {
    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->setCvePedido((int) $_GET['CvePedido']);
    $pdf->imprimir();
    $pdf->Output();
}
?>