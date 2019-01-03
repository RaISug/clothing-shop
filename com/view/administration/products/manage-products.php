<?php 

    include_once 'com/view/administration/header.php';

?>

    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
  		<div class="row">
    	  	<?php
        	  $pagination = $response->entity();
        	  
        	  foreach ($pagination->entities() as $product) {
        	      ?>
        	      	<div class="product col-sm-3">
            			<img src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>" alt="Smiley face" style="height: 250px; margin-top: 10px;">
						<br>
                		Име на продукта : <?php echo $product->name(); ?>
						<br>
                		Тип на продукта: <?php echo $product->type(); ?>
						<br>
                		Категория: <?php echo $product->category(); ?>
						<br>
                		Език: <?php echo $product->language(); ?>
						<br>
                		Цена: <?php echo $product->price(); ?>lv
                		<div style="margin-top: 10px;">
                			<form action="<?php echo $response->serverContext(); ?>/administration/products/api/v1/product/<?php echo $product->id(); ?>">
                				<input class="btn btn-primary col-sm-12" style="margin-bottom: 10px" type="submit" value="Update">
                			</form>
                			<form action="<?php echo $response->serverContext(); ?>/administration/products/api/v1/product/<?php echo $product->id(); ?>" method="POST">
                				<input type="hidden" name="_method" value="DELETE">
                				<input class="btn btn-danger col-sm-12" type="submit" value="DELETE">
                			</form>
                		</div>
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