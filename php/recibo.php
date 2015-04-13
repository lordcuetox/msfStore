<?php

session_start();
//unset($_SESSION['cve_cliente']);
require_once ('../clases/PDF.php');
require_once ('../clases/Pedidos.php');
require_once '../clases/Prospectos.php';

if (!isset( $_SESSION['habilitado']) )
{
     if  (!isset($_SESSION['cve_usuario']))
   {
        header('Location:../index.php');
          return;
       
   }
   else
   {
            if (isset($_GET['P'])) {
            $pedidos = new Pedidos((int) $_GET['P']);
            if ($pedidos->existe()) {
                $pdf = new PDF();
                $pdf->setCvePedido((int) $_GET['P']);
                $pdf->imprimir();
                $pdf->Output();
            } else {
 
                 header('Location:../index.php');
                return;
            }
        }
        else
        {

                 header('Location:../index.php');
                return;
        }
    }

   
}
else
{
   
 
    $idPrincipal=$_SESSION['habilitado'];
      
    if (isset($_GET['P'])) {
      $pedidos=new Pedidos();
     $clasf = new Prospectos();
     $clasf->cargar2($idPrincipal);
     $pedidos->cargar2($clasf->getCveCliente(),(int) $_GET['P']); 
        if($pedidos->existe())
       {
    $pdf = new PDF();
    $pdf->setCvePedido((int) $_GET['P']);
    $pdf->imprimir();
    $pdf->Output();
       }
 else {
        header('Location:../index.php');
          return;    
       }
     }
     else
     {
              header('Location:../index.php');
          return;
     }
    
}




?>