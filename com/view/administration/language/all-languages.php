<?php

include_once 'com/view/administration/header.php';

?>
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
  		<div class="row">
    	  	<?php
        	  $entities = $response->entity();
        	  
        	  foreach ($entities as $language) {
        	      ?>
        	      	<div class="product col-sm-3">
                    		Name: <?php echo $language->name(); ?>
							<br>
                    		<div style="margin-top: 10px;">
                    			<form action="<?php echo $response->serverContext(); ?>/administration/languages/api/v1/language/<?php echo $language->id(); ?>">
                    				<input class="btn btn-danger" type="submit" value="Промени">
                    			</form>
                    		</div>
                    		<div style="margin-top: 10px;">
                    			<form action="<?php echo $response->serverContext(); ?>/administration/languages/api/v1/language/<?php echo $language->id(); ?>" method="POST">
                    				<input type="hidden" name="_method" value="DELETE">
                    				<input class="btn btn-danger" type="submit" value="Изтрии">
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