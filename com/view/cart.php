<?php
    
    include 'com/view/header.php';

	$products = $response->entity();
	if (count($products) !== 0) {
        ?>
    	<div class="container cart" style="margin-top: 30px; padding: 30px; background-color: white; border: 1px solid #d1d1d1;">
    		<table>
    			<tr>
    				<th>Продукт</th>
    				<th style="text-align: center">Размер</th>
    				<th style="padding-left:15px;">Количество</th>
    				<th style="text-align: center">Цена</th>
    				<th></th>
    			</tr>
    
    			<?php 
    
    			$amount = 0;
    	
    			foreach ($products as $product) {
        			?>
        			<tr>
        				<td class="cart-product">
        					<div>
        						<div class="cart-image">
        							<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>">
        								<img src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>" />
        							</a>
        						</div>
        						<div class="cart-detail">
        							<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>" class="cart-detail-link"><?php echo $product->name(); ?></a>
        						</div>
        					</div>
        				</td>
        				<td>
        					<div style="text-align: center">
        						<?php echo $product->size(); ?>
        					</div>
        				</td>
        				<td class="cart-product-quantity">
        					<div style="display: inline;">
        						<div style="display: inherit">
                					<form style="display: inherit; margin-right: 5px;" action="<?php echo $response->serverContext(); ?>/carts/api/v1" method="POST">
                        				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                        				<input type="hidden" name="size" value="<?php echo $product->size(); ?>">
                        			
                        				<button type="submit" class="btn btn-sm btn-outline-secondary">
                        					<span class="fa fa-plus" style="color: green;"></span>
                    					</button>
                        			</form>
        						</div>
    							
    							<div style="display: inherit">
    	                			<?php echo $product->quantity(); ?>
    							</div>                			
    
            					<div style="display: inherit">
                					<form style="display: inherit; margin-left: 5px;" action="<?php echo $response->serverContext(); ?>/carts/api/v1/cart/<?php echo $product->id(); ?>/size/<?php echo $product->size(); ?>" method="POST">
                        				<input type="hidden" name="_method" value="PUT">
                        				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                        				<input type="hidden" name="size" value="<?php echo $product->size(); ?>">
                        				<button type="submit" class="btn btn-sm btn-outline-secondary">
                        					<span class="fa fa-minus" style="color: red;"></span>
                    					</button>
                        			</form>
            					</div>
        					</div>
        				</td>
        				<td style="text-align: center">
        					<strong>
    							<?php
    								if ($product->promotionalPrice() == 0) {
    								    echo $product->price(); 
    								} else {
    		     					    ?>
    			
    									<b><?php echo $product->promotionalPrice(); ?> лв.</b><sup style="color: red"><del><?php echo $product->price(); ?>лв.</del></sup>
    			
    									<?php
    								}
    							?>
    						</strong>
        				</td>
        				<td class="cart-product-removal">
        					<form action="<?php echo $response->serverContext(); ?>/carts/api/v1/cart/<?php echo $product->id(); ?>/size/<?php echo $product->size(); ?>" method="POST">
                				<input type="hidden" name="_method" value="DELETE">
                				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                				<input type="hidden" name="size" value="<?php echo $product->size(); ?>">
                				<button type="submit" class="btn btn-sm btn-outline-secondary">
                					<span style="color: red">&times;</span>
            					</button>
                			</form>
        				</td>
        			</tr>
    			
    			<?php
    			     $price = $product->promotionalPrice() == 0 ? $product->price() : $product->promotionalPrice();
    			     $amount += $price * $product->quantity();
    			}
    			?>
    		</table>
    		
    		<div style="margin-top: 25px; min-width: 100%; background-color: #5a5a5a; color: white; height: 55px; border-radius: 3px;">
    			<div style="padding-top: 15px; padding-left: 15px; display: inline-block; font-size: 17px;">
    				<a href="<?php echo $response->serverContext(); ?>/products/api/v1" style="text-decoration: none; color: white;">
    					<span class="fa fa-arrow-left"> Обратно към пазаруването</span>
    				</a>
    			</div>
    			<div style="margin-right: 5px; padding-top: 15px; display: inline-block; float: right; font-size: 17px;">
    				<a href="<?php echo $response->serverContext(); ?>/orders/api/v1" style="text-decoration: none; color: white;">
    					<b> Завърши поръчката <span class="fa fa-arrow-right"></span></b>
    				</a>
    			</div>
    			<div style="margin-right: 25px; padding-top: 10px; float: right;">
    				Общо: <b style="font-size: 22px;"><?php echo $amount; ?></b> лв.
    			</div>
    		</div>
    	</div>
		<?php 
	} else {
	    ?>
		<div class="container" style="margin-top: 100px" >
    	    <div class="alert alert-primary" role="alert">
            	Няма добавени продукти в количката!
            </div>
        </div>
	    <?php
	}

    include 'com/view/footer.php';

?>