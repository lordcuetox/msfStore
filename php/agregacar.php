<?php

require_once '../clases/ShoppingCart.php';
require_once '../clases/Productos.php';
session_start();

$cart = NULL;
$producto = NULL;

if (isset($_SESSION['habilitado'])) {
    if (isset($_SESSION['carro']) && isset($_POST['xAccion']) && ($_POST['xAccion'] == "update")) {
        $count = 1;
        $size = count($_POST);
        $cart = unserialize($_SESSION['carro']);

        foreach ($_POST as $key => $value) {

              /*echo "$key : $value <br>";
              echo($count."<br>");
              echo((($count % 2))."<br>");*/

            if ($count != 1) {
                if ($count % 2 == 0) {
                    $producto = new Productos((int) $value);
                } else {
                    $cart->updateItem($producto, (int) $value);
                }
            }
            $count++;
        }
        $_SESSION['carro'] = serialize($cart);
        header('Location:../index.php');

        /* $cart = unserialize($_SESSION['carro']);
          $producto = new Productos((int) $_POST['txtCveProducto']);
          $cart->updateItem($producto, (int) $_POST['txtCantidad']);
          $_SESSION['carro'] = serialize($cart);
          header('Location:../index.php'); */
        return;
    } elseif (isset($_SESSION['carro'])) {
        $cart = unserialize($_SESSION['carro']);
        $producto = new Productos((int) $_POST['xCveProducto']);
        $cart->addItem($producto);
        $_SESSION['carro'] = serialize($cart);
        echo("Se agrego (1) " . $producto->getNombre() . " al carrito de compras.");
    } else {
        $cart = new ShoppingCart();
        $producto = new Productos((int) $_POST['xCveProducto']);
        $cart->addItem($producto);
        $_SESSION['carro'] = serialize($cart);
        echo("Se agrego (1) " . $producto->getNombre() . " al carrito de compras.");
    }
} else {
    echo("NO_SESSION");
}
?>