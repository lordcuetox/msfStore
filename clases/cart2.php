<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Testing the Shopping Cart</title>
</head>
<body>
<?php # cart.php
// This script uses the ShoppingCart and Item classes.

// Create the cart:
try {

require('ShoppingCart2.php');
$cart = new ShoppingCart2();

// Create some items:
require('Productos.php');
$w1 = new Productos(1);
$w2 = new Productos(2);
$w3 = new Productos(3);

// Add the items to the cart:
$cart->addItem($w1);
$cart->addItem($w2);
$cart->addItem($w3);

// Update some quantities:
$cart->updateItem($w2, 4);
$cart->updateItem($w1, 1);

// Delete an item:
$cart->deleteItem($w3);

// Show the cart contents:
echo '<h2>Cart Contents (' . count($cart) . ' items)</h2>';

if (!$cart->isEmpty()) {

	foreach ($cart as $arr) {

		// Get the item object:
		$item = $arr['item'];

		// Print the item:
		printf('<p><strong>%s</strong>: %d @ $%0.2f each.<p>', $item->getNombre(), $arr['qty'], $item->getPrecio());

	} // End of foreach loop!

} // End of IF.

} catch (Exception $e) {
// Handle the exception.
}
?>
</body>
</html>