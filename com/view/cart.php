<?php
    
    use service\InternationalizationService;

    include 'com/view/header.php';

    $request = $response->request();
	$products = $response->entity();

    $internationalizationService = new InternationalizationService($response->language());
    

	if (count($products) !== 0) {
        ?>
        
    	<div class="container cart" style="margin-top: 30px; padding: 30px; background-color: white; border: 1px solid #d1d1d1;">
    	    <?php
    	    if ($request->getQueryParameter("insert") === "succeed") {
            ?>
            	<div id="success-alert" class="alert alert-success" role="alert">
                	<?php echo $internationalizationService->get("cart_view_successfully_added_product"); ?>
                </div>
            <?php
    	    } else if ($request->getQueryParameter("remove") === "succeed") {
            ?>
            	<div id="success-alert" class="alert alert-success" role="alert">
                	<?php echo $internationalizationService->get("cart_view_successfully_removed_product"); ?>
                </div>
            <?php
    	    } else if ($request->getQueryParameter("decrement") === "succeed") {
            ?>
            	<div id="success-alert" class="alert alert-success" role="alert">
                	<?php echo $internationalizationService->get("cart_view_successfully_decremented_product_count"); ?>
                </div>
            <?php
    	    }
    	    ?>
    	    
    		<table>
    			<tr>
    				<th><?php echo $internationalizationService->get("cart_view_table_header_product"); ?></th>
    				<th style="text-align: center"><?php echo $internationalizationService->get("cart_view_table_header_size"); ?></th>
    				<th style="padding-left:15px;"><?php echo $internationalizationService->get("cart_view_table_header_quantity"); ?></th>
    				<th style="text-align: center"><?php echo $internationalizationService->get("cart_view_table_header_price"); ?></th>
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
    								    echo $product->price() . " лв."; 
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
    					<span class="fa fa-arrow-left"> <?php echo $internationalizationService->get("cart_view_back_to_shopping"); ?></span>
    				</a>
    			</div>
    			<div style="margin-right: 5px; padding-top: 15px; display: inline-block; float: right; font-size: 17px;">
    				<a href="<?php echo $response->serverContext(); ?>/orders/api/v1" style="text-decoration: none; color: white;">
    					<b> <?php echo $internationalizationService->get("cart_view_finish_shopping"); ?> <span class="fa fa-arrow-right"></span></b>
    				</a>
    			</div>
    			<div style="margin-right: 25px; padding-top: 10px; float: right;">
    				<span class="fa fa-arrow-left"> <?php echo $internationalizationService->get("cart_view_total"); ?>: </span><b style="font-size: 22px;"><?php echo $amount; ?></b> лв.
    			</div>
    		</div>
    	</div>
		<?php 
	} else {
	    ?>
		<div class="container" style="margin-top: 100px" >
			<?php
    	    if ($request->getQueryParameter("remove") === "succeed") {
            ?>
            	<div id="success-alert" class="alert alert-success" role="alert">
                	<?php echo $internationalizationService->get("cart_view_successfully_removed_product"); ?>
                </div>
            <?php
    	    } else if ($request->getQueryParameter("decrement") === "succeed") {
            ?>
            	<div id="success-alert" class="alert alert-success" role="alert">
                	<?php echo $internationalizationService->get("cart_view_successfully_decremented_product_count"); ?>
                </div>
            <?php
    	    }
    	    ?>
    	    
    	    <div class="alert alert-primary" role="alert">
            	<?php echo $internationalizationService->get("cart_view_empty_cart"); ?>
            </div>
        </div>
	    <?php
	}

    include 'com/view/footer.php';

?>