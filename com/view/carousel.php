<?php 

    $carousels = $response->supportingEntity("carousels");

?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">

      	<div class="carousel-item active">
        	<img class="first-slide" style="z-index: -1" src="<?php echo $response->serverContext(); ?>/../images/carousel/<?php echo $carousels[0]->imageName(); ?>" alt="First slide">
        	<div class="container">
          		<div class="carousel-caption text-left">
                	<p><?php echo $carousels[0]->description(); ?></p>
              	</div>
        	</div>
      	</div>

		<?php 
		if (isset($carousels[1])) {
	    ?>
          	<div class="carousel-item">
            	<img class="second-slide" style="z-index: -1" src="<?php echo $response->serverContext(); ?>/../images/carousel/<?php echo $carousels[1]->imageName(); ?>" alt="Second slide">
            	<div class="container">
              		<div class="carousel-caption">
                        <p><?php echo $carousels[1]->description(); ?></p>
              		</div>
            	</div>
          	</div>
	    <?php
		}

		if (isset($carousels[2])) {
	    ?>
          	<div class="carousel-item">
            	<img class="third-slide" style="z-index: -1" src="<?php echo $response->serverContext(); ?>/../images/carousel/<?php echo $carousels[2]->imageName(); ?>" alt="Third slide">
            	<div class="container">
              		<div class="carousel-caption text-right">
                        <p><?php echo $carousels[2]->description(); ?></p>
              		</div>
            	</div>
          	</div>
		<?php
		}
		?>
		
    </div>

    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
      	<span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
    </a>

</div>
