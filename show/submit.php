<?php
use Illuminate\Support\Facades\Auth;
require('config.php');

$userId = Auth::id();

echo '<pre>';
print_r($userId);

$db = mysqli_connect('localhost','root','','elaravel_v2')
or die('Error connecting to MySQL server.');

$total_cost_query = "SELECT total_cost FROM payments ORDER BY id DESC LIMIT 1;";
mysqli_query($db, $total_cost_query) or die('Error querying database.');

$result = mysqli_query($db, $total_cost_query);
$row = mysqli_fetch_array($result);

// echo '<pre>';
// print_r($_POST);

if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];

	$data = \Stripe\Charge::create(array(
		"amount" => (int) $row[0],
		// "amount" => 500000,
		"currency" => "BDT",
		"description" => "Payment With Stripe",
		"source" => $token,
	));

	echo '<pre>';
	print_r($data);
}
// else{
//     $db = mysqli_connect('localhost','root','','elaravel_v2')
//     or die('Error connecting to MySQL server.');

//     $total_cost_query = "SELECT total_cost FROM payments ORDER BY id DESC LIMIT 1;";
//     $total_cost_query = "DELETE FROM payments WHERE id=(SELECT max(id) from payments);";
//     mysqli_query($db, $total_cost_query) or die('Error querying database.');

//     $result = mysqli_query($db, $total_cost_query);
//     $row = mysqli_fetch_array($result);
// }
?>

