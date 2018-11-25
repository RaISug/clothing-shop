<DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="UTF-8"/>
		
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/common.css" />
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/header/header.css" />
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/products/single-product.css" />

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">	
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	</head>

	<body style="background-color: transparent;">

		<div class="fillParent" style="background-color: transparent;">
            <?php
                include_once 'com/view/header/header.php';
                
                $product = $response->entity();
                
                $images = $product->imageNames();
            ?>
            	<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
                	<div class="product-details">
    					<div class="product-details-images">
    						<div class="product-details-main-image">
    							<img class="productImage" src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>"/>
    						</div>
    						<?php 
    						  for ($i = 1 ; $i < count($images) ; $i++) {
    						?>
        						<div class="product-details-secondary-images">
        							<img class="productImage" src="<?php echo $response->serverContext(); ?>/../images/<?php echo $images[$i]; ?>"/>
        						</div>
    						<?php
    						  }
    						?>
    					</div>
    					
    					<div class="product-details-description">
    						<div>
    							<table>
    								<tr>
    									<td class="description">Описание: </td>
    									<td>Един от най-хубавите и здрави камиони. Отличен с най-много отличия за 2016г.</td>
    								</tr>
    								<tr>
    									<td class="description">Модел: </td>
    									<td>RX-KK443</td>
    								</tr>
    									<td class="description">Марка: </td>
    								<tr>
    									<td>MAN</td>
    								</tr>
    								<tr>
    									<td class="description">Име: </td>
    									<td>Камион</td>
    								</tr>
    								<tr>
    									<td class="description">Цена: </td>
    									<td>394.23 лв.</td>
    								</tr>
    								<tr>
    									<td></td>
    									<td>
    										<form action="<?php echo $response->serverContext(); ?>/cart/api/v1" method="POST">
                                				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                                				<input class="addToCartButton" type="submit" value="Add to cart">
                            				</form>
    									</td>
    								</tr>
    							</table>
    						</div>
    					</div>
    				</div>
    				
    				<div id="productModal" class="modal">
    					<span class="close" onclick="document.getElementById('productModal').style.display='none'">&times;</span>
    					
    					<img class="modal-content" id="modalImage">
    				
    					<div id="caption"></div>
    				</div>
            	</div>
            <?php
                include_once 'com/view/footer/footer.php';
            ?>

    		<script src="http://localhost/com.radoslav.web.shop/com/view/header/header.js"></script>
    		<script src="http://localhost/com.radoslav.web.shop/com/view/products/single-product.js"></script>
		</div>
	</body>
</html>