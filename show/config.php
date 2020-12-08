<?php
// namespace show;
// use Illuminate\Support\Facades\DB;
require('stripe-php-master/init.php');

// $total_cost = 0;
// $total_cost = DB::table('payments')
// ->orderBy('id', 'desc')
// ->pluck('total_cost')
// ->first();

// $shipping_address = DB::table('users')
// ->orderBy('id', 'desc')
// ->pluck('shipping_address')
// ->first();

// $shipping_district = DB::table('users')
// ->orderBy('id', 'desc')
// ->pluck('shipping_district')
// ->first();


$publishable_key =
"pk_test_51HvdxJBuHtSEnNpzJiI5UWLlMYBJjDhwuCUCu5bTg6ZiOmadkfh6uZEJ1YNpCQK5liQDNy5Vt3Dsa97xoUo2iTux00dUo10b8e";

$secret_key =
"sk_test_51HvdxJBuHtSEnNpz2oh1c1fnjcj025Ruoe5CNKJ3fgULv4q4WD0FQ5cUEERMo6htJM4wrSsM1xP7T6dc8ePOtsOv00bxvkuqDr";

\Stripe\Stripe::setApiKey($secret_key);
?>
