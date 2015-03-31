<?php

require_once '../clases/ShoppingCart.php';
require_once('../clases/Productos.php');
session_start();

$cart = NULL;
$producto = NULL;

if (isset($_SESSION['carro'])) {
    $cart = unserialize($_SESSION['carro']);
    $producto = new Productos((int) $_GET['xCveProducto']);
    $cart->deleteItem($producto);
    $_SESSION['carro'] = serialize($cart);
    header('Location:../index.php');
    return;
}
?>