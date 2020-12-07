<?php
require('config.php');

// echo '<pre>';
// print_r($_POST);

if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];

	$data = \Stripe\Charge::create(array(
		"amount" =>50000,
		"currency" => "BDT",
		"description" => "Payment With Stripe",
		"source" => $token,
	));

	echo '<pre>';
	print_r($data);
}
?>

