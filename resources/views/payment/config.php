<?php
require('/resources/views/payment/stripe-php-master/init.php');

// $publishable_key =
// "pk_live_51HtX6kENsc8UGICBHgXiHGGO2CFozsOTN4STTj4blT1nlEtNEiTjnPUxtul8uqyuKUkGQ2ShUSwgwGEW7iitfwJb00WFBGyMNq";

// $secret_key =
// "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";

$publishable_key =
"pk_test_51HvdxJBuHtSEnNpzJiI5UWLlMYBJjDhwuCUCu5bTg6ZiOmadkfh6uZEJ1YNpCQK5liQDNy5Vt3Dsa97xoUo2iTux00dUo10b8e";

$secret_key =
"sk_test_51HvdxJBuHtSEnNpz2oh1c1fnjcj025Ruoe5CNKJ3fgULv4q4WD0FQ5cUEERMo6htJM4wrSsM1xP7T6dc8ePOtsOv00bxvkuqDr";

\Stripe\Stripe::setApiKey($secret_key);
?>
