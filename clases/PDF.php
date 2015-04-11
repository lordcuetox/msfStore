<?php
require_once ('../lib/fpdf/fpdf.php');
require_once '../clases/UtilDB.php';
class PDF extends FPDF
{
   private $cvePedido;

   function setCvePedido($cvePedido)
   {
       $this->cvePedido=$cvePedido;
   }
   
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../img/encabezado.jpg',10,10,175,40);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Recibo de MSF Store',0,0,'C');
    // Salto de línea
    $this->Ln(40);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function TablaDetalle($cvePedido)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(43,84,163);
    $this->SetTextColor(255);
    $this->SetDrawColor(229,245,255);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
     $this->Cell(100,7,iconv('UTF-8', 'windows-1252', 'Descripción'),1,0,'C',true);
     $this->Cell(25,7,iconv('UTF-8', 'windows-1252', 'Precio U.'),1,0,'C',true);
     $this->Cell(25,7,iconv('UTF-8', 'windows-1252', 'Cantidad'),1,0,'C',true);
     $this->Cell(25,7,iconv('UTF-8', 'windows-1252', 'Total'),1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(229,245,255);
    $this->SetTextColor(0);
    $this->SetFont('','',10);
    // Datos
    $fill = false;
        $sql2 = "SELECT * from detalle_pedido where cve_pedido=".$this->cvePedido;
        $rst = UtilDB::ejecutaConsulta($sql2);
         if($rst->rowCount()>0)
        {
    
    foreach($rst as $row)
    {
        $this->Cell(100,6,iconv('UTF-8', 'windows-1252',$row['etiqueta_producto']),'LR',0,'L',$fill);
        $this->Cell(25,6,$row['descuento']==0?('$ '.number_format($row['precio_unitario'],  2 , '.' , ',' )):('$ '.number_format($row['precio_unitario_desc'],  2 , '.' , ',' )),'LR',0,'C',$fill);
        $this->Cell(25,6,number_format($row['cantidad']),'LR',0,'C',$fill);
        $this->Cell(25,6,'$ '.number_format($row['monto_total_pagar'],  2 , '.' , ',' ),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
        }
        $rst->closeCursor(); 
      // agregando los gastos de envío
        $this->Cell(100,6,iconv('UTF-8', 'windows-1252','Gastos de envío'),'LR',0,'L',$fill);
        $this->Cell(25,6,'$ 180.00','LR',0,'C',$fill);
        $this->Cell(25,6,'1','LR',0,'C',$fill);
        $this->Cell(25,6,'$ 180.00','LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
      
              // agregando los totales
         $sql = "SELECT * from pedidos where cve_pedido=".$this->cvePedido;
        $rst2 = UtilDB::ejecutaConsulta($sql);
        if($rst2->rowCount()>0)
        {
              foreach($rst2 as $row2)
                  {
                   $totalPagar=$row2['monto_total'];
                  }
            
        }
         $rst2->closeCursor(); 
           $this->SetFont('','B',13);
        $this->Cell(100,6,iconv('UTF-8', 'windows-1252',''),'LR',0,'L',$fill);
        $this->Cell(25,6,'','LR',0,'C',$fill);
        $this->Cell(25,6,'Total','LR',0,'C',$fill);
        $this->Cell(25,6,'$ '.number_format($totalPagar,  2 , '.' , ',' ),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
        
    // Línea de cierre
    //$this->Cell(array_sum($w),0,'','T');
}


function imprimir()
{
$this->AliasNbPages();
$this->AddPage();
$this->SetFont('Times','',12);
$this->TablaDetalle($this->cvePedido);

}

}
// Creación del objeto de la clase heredada


?>