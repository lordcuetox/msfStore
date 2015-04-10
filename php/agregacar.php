<?php

require_once '../clases/ShoppingCart.php';
require_once('../clases/Productos.php');
session_start();

$cart = NULL;
$producto = NULL;

if (isset($_SESSION['habilitado'])) {
    if (isset($_SESSION['carro']) && isset($_POST['txtCantidad']) && isset($_POST['txtCveProducto'])) {
        $cart = unserialize($_SESSION['carro']);
        $producto = new Productos((int) $_POST['txtCveProducto']);
        $cart->updateItem($producto, (int) $_POST['txtCantidad']);
        $_SESSION['carro'] = serialize($cart);
        header('Location:../index.php');
        return;
    } elseif (isset($_SESSION['carro'])) {
        $cart = unserialize($_SESSION['carro']);
        $producto = new Productos((int) $_POST['xCveProducto']);
        $cart->addItem($producto);
        $_SESSION['carro'] = serialize($cart);
        echo("Se agrego (1) " . $producto->getNombre() . " al carrito de comprar.");
    } else {
        $cart = new ShoppingCart();
        $producto = new Productos((int) $_POST['xCveProducto']);
        $cart->addItem($producto);
        $_SESSION['carro'] = serialize($cart);
        echo("Se agrego (1) " . $producto->getNombre() . " al carrito de comprar.");
    }
} else {
    echo("NO_SESSION");
}
?>