<?php

    include_once 'com/view/administration/header.php';

?>

    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
	  	<?php
            $product = $response->entity();
        ?>
        <form action="<?php echo $response->serverContext(); ?>/administration/orders/api/v1/order/<?php echo $product->id(); ?>" method="POST">
        	<input type="hidden" name="_method" value="PUT" />
        	<input type="hidden" name="id" value="<?php echo $product->id(); ?>" />

          	<div class="form-group row">
            	<label for="show_processed" class="col-sm-3 col-form-label">Обработени поръчки</label>
        		<input type="checkbox" class="col-sm-8 form-control" name="show_processed" id="show_processed"/>
          	</div>

    		<div class="form-group">
    			<button type="submit" class="btn btn-primary col-sm-4 offset-sm-5">Промени</button>
        	</div>
    	</form>
    </div>

<?php 

    include_once 'com/view/administration/footer.php';

?>
