<?php
require('config.php');
?>

<form action="submit.php" method="post">
	<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	data-key="<?php echo $publishable_key ?>"
	data-amount="50000"
	data-name="BISMIB FASHION"
	data-description="Payment With Stripe"
	data-image="https://image.shutterstock.com/image-vector/real-estate-logo-260nw-1615688014.jpg"
	data-currency="BDT"
	data-email="info@bismibtechnology.com"
	>
	</script>
</form>
