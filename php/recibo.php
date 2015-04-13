<?php

session_start();
//unset($_SESSION['cve_cliente']);
if (!isset( $_SESSION['habilitado'])) 
{
    header('Location:login_cliente.php');
    return;
}
else
{
    $idPrincipal=$_SESSION['habilitado'];
}
require_once ('../clases/PDF.php');
require_once ('../clases/Pedidos.php');
require_once '../clases/Prospectos.php';


if (isset($_GET['P'])) {
    $clasf = new Prospectos();
    // Creación del objeto de la clase heredada
     $pedidos=new Pedidos();
      $clasf->cargar2($idPrincipal);
     $pedidos->cargar2($clasf->getCveCliente(),(int) $_GET['P']);
       if($pedidos->existe())
       {
    
    $pdf = new PDF();
    $pdf->setCvePedido($pedidos->getCvePedido());
    $pdf->imprimir();
    $pdf->Output();
       }
       else
       {
            header('Location:login_cliente.php');
         return;
       }
}
else
{
      header('Location:login_cliente.php');
         return; 
}
?>