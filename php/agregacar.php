<?php 
session_start();
require_once '../clases/ShoppingCart2.php';
require_once('../clases/Productos.php');
$cart = NULL;

if(isset($_SESSION['carro']))
{
    $cart= unserialize($_SESSION['carro']);
}
else
{   $cart = new ShoppingCart2();
    $cart->addItem(new Productos((int)$_GET['id']));
    $_SESSION['carro'] = serialize(new ShoppingCart2());
    
}
?>