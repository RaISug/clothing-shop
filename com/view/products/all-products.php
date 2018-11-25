<DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="UTF-8"/>
		
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/common.css" />
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/header/header.css" />
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/products/all-products.css" />

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">	
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	</head>

	<body style="background-color: transparent;">

		<div class="fillParent" style="background-color:transparent;">
            <?php
                include_once 'com/view/header/header.php';
            ?>
            <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    	  		<div class="row">
            	  	<?php
                	  $pagination = $response->entity();
                	  
                	  foreach ($pagination->entities() as $product) {
                	      ?>
                	      	<div class="product col-sm-3">
                            		<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>">
                            			<img src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>" alt="Smiley face" style="height: 250px; margin-top: 10px;">
                        			</a>
    								<br>
                            		Name: <?php echo $product->name(); ?>
    								<br>
                            		Type: <?php echo $product->type(); ?>
    								<br>                            		
                            		Category: <?php echo $product->category(); ?>
    								<br>                            		
                            		Price: <?php echo $product->price(); ?>lv
                            		<div style="margin-top: 10px;">
                            			<form action="<?php echo $response->serverContext(); ?>/cart/api/v1" method="POST">
                            				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                            				<input class="addToCartButton" type="submit" value="Add to cart">
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
  				include_once 'com/view/footer/footer.php';
            ?>

    		<script src="http://localhost/com.radoslav.web.shop/com/view/header/header.js"></script>
		</div>
	</body>
</html>
