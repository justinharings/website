<?php
if(!isset($_SESSION))
{
	session_start();
}
	
define("_LANGUAGE_PACK", $_SESSION['_LANGUAGE_PACK']);
	
require_once($_SERVER['DOCUMENT_ROOT'] . "/library/php/classes/motherboard.php");

$mb = new main_board();
$cart = $mb->_runFunction("cart", "quantityCartItem", array($_POST['key'], $_POST['quantity'], $_SESSION['cart']));

$_SESSION['cart'] = $cart;

header("location: /" . $_SESSION['_LANGUAGE_PACK'] . "/system/cart.html");
?>