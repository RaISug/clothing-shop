<?php

    include_once 'com/view/administration/header.php';
    
    $collections = $response->supportingEntity("collections");

    $request = $response->request();

?>

    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
    
    	<?php
  		if ($request->getQueryParameter("operation-add") === "succeed") {
  	        ?>
  	        	<div id="success-alert" class="alert alert-success" role="alert">
                	Успешно създадохте каросела.
                </div>
  	        <?php
  	    } else if ($request->getQueryParameter("operation-create") === "succeed") {
  	        ?>
  	        	<div id="success-alert" class="alert alert-success" role="alert">
                	Успешно създадохте колекцията.
                </div>
  	        <?php
  	    }
        ?>

  		<div class="row">
    	  	<?php
        	  $pagination = $response->entity();
        	  
        	  foreach ($pagination->entities() as $product) {
        	      ?>
        	      	<div class="product col-sm-3">
            			<img src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>" alt="Smiley face" style="height: 250px; margin-top: 10px;">
						<br>
                		Name: <?php echo $product->name(); ?>
						<br>
                		Type: <?php echo $product->type(); ?>
						<br>                            		
                		Category: <?php echo $product->category(); ?>
						<br>                            		
                		Price: <?php echo $product->price(); ?>lv
                		<div style="margin-top: 10px;">
                			<form action="<?php echo $response->serverContext(); ?>/administration/collections/api/v1" method="POST">
                				<input type="hidden" name="_method" value="PUT">
                				<input type="hidden" name="product_id" value="<?php echo $product->id(); ?>">
                				<div class="form-group">
                    				<select class="form-control" name="collection_id">
                    					<?php 
                        					foreach ($collections as $collection) {
                    					    ?>
                            					<option value="<?php echo $collection->id(); ?>"><?php echo $collection->titleName(); ?></option>
                    					    
                    					    <?php 
                        					}
                    					?>
                    				</select>
                				</div>
                				<input class="btn btn-primary col-sm-12" type="submit" value="Добави">
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