<?php 

    include_once 'com/view/administration/header.php';

?>
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
  		<div class="row">
    	  	<?php
        	  $pagination = $response->entity();
        	  
        	  foreach ($pagination->entities() as $carousel) {
	              ?>
        	      	<div class="product col-sm-3">
    	      			<img src="<?php echo $response->serverContext(); ?>/../images/carousel/<?php echo $carousel->imageName(); ?>" alt="Smiley face" style="height: 250px; margin-top: 10px;">
						<br>
                		<div style="margin-top: 10px;">
                			<form action="<?php echo $response->serverContext(); ?>/administration/carousels/api/v1/carousel/<?php echo $carousel->id(); ?>" method="POST">
                				<input type="hidden" name="_method" value="DELETE">
                				<input class="btn btn-danger col-sm-12" type="submit" value="Изтрии">
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