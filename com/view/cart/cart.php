<DOCTYPE html>
<html>

	<div>
		<?php 
		  $cartItems = $response->entity();

		  foreach ($cartItems as $cartItem) {
		      ?>
		      	<div>
		      		Product Id:
		      		<?php echo $cartItem->productId(); ?>
		      		<br>
		      		Quantity:
		      		<?php echo $cartItem->quantity(); ?>
		      	</div>
		      <?php 
		  }
		  
		  print_r($cartItems);
		?>
	</div>

</html>