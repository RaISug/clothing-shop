<?php

    include_once 'header.php';
    include_once 'carousel.php';

    $collections = $response->supportingEntity("collections");

?>

	<div class="container marketing">

    	<div align="center">
			<h2 style="text-align: center">Колекции</h2>
    	</div>

        <hr class="featurette-divider">

		<?php 
		    $counter = 1;

    		foreach ($collections as $collection) {
    		    if ($counter % 2 == 0) {
    		        ?>
    		        	<div class="row featurette">
                      		<div class="col-md-7">
                                <h2 class="featurette-heading"><?php echo $collection->titleName(); ?></h2>
                                <p class="lead"><?php echo $collection->description(); ?></p>
                          	</div>
                          	
                          	<div class="col-md-5">
                          		<div style="height: 500px; max-height: 500px; overflow: hidden;">
                    				<div class="CategoryImageName" data-href="products/api/v1/category/saka">
                    					<a style="position: relative;  top: 40%; text-decoration: none; color:white;"><?php echo $collection->titleName(); ?></a>
                    				</div>
                    				<img class="CategoryImage" src="<?php echo $collection->imageName(); ?>" alt="<?php echo $collection->titleName(); ?>">
                    			</div>
                      		</div>
                        </div>
    		        <?php 
    		    } else {
    		        ?>
    		        	<div class="row featurette">
                          	<div class="col-md-7 order-md-2">
                            	<h2 class="featurette-heading"><?php echo $collection->titleName(); ?></h2>
                                <p class="lead"><?php echo $collection->description(); ?></p>
                    	  	</div>
                          	
                          	<div class="col-md-5 order-md-1">
                				<div style="height: 500px; max-height: 500px; overflow: hidden;">
                    				<div class="CategoryImageName" data-href="products/api/v1/category/saka">
                    					<a style="position: relative;  top: 40%; text-decoration: none; color:white;"><?php echo $collection->titleName(); ?></a>
                    				</div>
                    				<img class="CategoryImage" src="<?php echo $response->serverContext(); ?>/../images/collections/<?php echo $collection->imageName(); ?>" alt="<?php echo $collection->titleName(); ?>">
                    			</div>
                          	</div>
                        </div>
    		        <?php
    		    }
    		    
    		    $counter++;
    		    ?>

    		    <hr class="featurette-divider">

    		    <?php
    		}
		?>

	</div>
	
<?php

    include 'footer.php';
?>