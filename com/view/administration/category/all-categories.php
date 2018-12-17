<?php 

    include_once 'com/view/administration/header.php';

?>
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
  		<div class="row">
    	  	<?php
        	  $pagination = $response->entity();
        	  
        	  foreach ($pagination->entities() as $category) {
        	      ?>
        	      	<div class="product col-sm-3">
                    		Name: <?php echo $category->name(); ?>
							<br>
                    		<div style="margin-top: 10px;">
                    			<form action="<?php echo $response->serverContext(); ?>/administration/categories/api/v1/category/<?php echo $category->id(); ?>" method="POST">
                    				<input type="hidden" name="_method" value="DELETE">
                    				<input class="btn btn-danger" type="submit" value="DELETE">
                    			</form>
                    		</div>
        	      	</div>
        	      <?php 
        	  }
            ?>
	   	</div>
    </div>
<?php 

    include_once 'com/view/administration/footer.php';

?>