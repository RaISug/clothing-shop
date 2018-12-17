<?php 

    include_once 'com/view/administration/header.php';

?>
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
  		<div class="row">
    	  	<?php
        	  $pagination = $response->entity();
        	  
        	  foreach ($pagination->entities() as $collection) {
        	      ?>
        	      	<div class="product col-sm-3">
                    		Title: <?php echo $collection->titleName(); ?>
							<br>
                    		<div style="margin-top: 10px;">
                    			<form action="<?php echo $response->serverContext(); ?>/administration/collections/api/v1/collection/<?php echo $collection->id(); ?>" method="POST">
                    				<input type="hidden" name="_method" value="DELETE">
                    				<input class="btn btn-danger" style="width: 100%" type="submit" value="DELETE">
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