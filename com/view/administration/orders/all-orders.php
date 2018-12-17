<?php 

    include_once 'com/view/administration/header.php';

?>
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
  		<div class="row">
    	  	<?php
        	  $pagination = $response->entity();
        	  
        	  foreach ($pagination->entities() as $order) {
        	      ?>
        	      	<div class="product col-sm-3">
        	      		<a href="<?php echo $response->serverContext(); ?>/administration/orders/api/v1/order/<?php echo $order->id(); ?>"">
            	      		ID: <?php echo $order->id(); ?>
            	      		Статус: <?php echo $order->isProcessed(); ?>
            	      		Дата: <?php echo $order->orderDate(); ?>
        	      		</a>
        	      		<form action="<?php echo $response->serverContext(); ?>/administration/orders/api/v1/order/<?php echo $order->id(); ?>">
        	      			<input type="hidden" name="update" value="true" />
            				<input class="btn btn-primary col-sm-12" style="margin-bottom: 10px" type="submit" value="Промени">
            			</form>
            			<form action="<?php echo $response->serverContext(); ?>/administration/orders/api/v1/order/<?php echo $order->id(); ?>" method="POST">
            				<input type="hidden" name="_method" value="DELETE">
            				<input class="btn btn-danger col-sm-12" type="submit" value="Изтрии">
            			</form>
        	      	</div>
        	      <?php 
        	  }
            ?>
	   	</div>
	   	<?php include "com/view/products/pagination/pagination.php"; ?>
    </div>

<?php 

    include_once 'com/view/administration/footer.php';

?>
