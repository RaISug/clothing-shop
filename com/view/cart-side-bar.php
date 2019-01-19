<?php 

    use service\InternationalizationService;

    $cartProducts = $response->supportingEntity("cartProducts");

    $internationalizationService = new InternationalizationService($response->language());

?>
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>
		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2"> 
					<?php echo $internationalizationService->get("cart_side_view_header_label"); ?>
				</span>
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php 
					$amount = 0;

					foreach ($cartProducts as $cartProduct) {
					    ?>

    					<li class="header-cart-item flex-w flex-t m-b-12">
    						<div class="header-cart-item-img" onclick="document.getElementById('form-for-cart-product-removal-<?php echo $cartProduct->id(); ?>').submit()">
    							<img src="<?php echo $response->imagesContext(); ?>/<?php echo $cartProduct->getFirstImageName(); ?>" alt="IMG">

    							<form id="form-for-cart-product-removal-<?php echo $cartProduct->id(); ?>" action="<?php echo $response->serverContext(); ?>/carts/api/v1/cart/<?php echo $cartProduct->id(); ?>/size/<?php echo $cartProduct->size(); ?>" method="POST">
                    				<input type="hidden" name="_method" value="PUT">
                    				<input type="hidden" name="id" value="<?php echo $cartProduct->id(); ?>">
                    				<input type="hidden" name="size" value="<?php echo $cartProduct->size(); ?>">
                    			</form>
    						</div>
    						<div class="header-cart-item-txt p-t-8">
    							<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $cartProduct->id(); ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
    								<?php echo $cartProduct->name(); ?> 
								</a> 
								
								<span class="header-cart-item-info">
									<?php echo $cartProduct->quantity(); ?> 
									x 
									<?php 
									if ($cartProduct->promotionalPrice() > 0) {
									    echo $cartProduct->promotionalPrice(); 
									    ?>
									    	$ <sup style="color: red"><del><?php echo $cartProduct->price(); ?> <?php echo $internationalizationService->get("product_currency"); ?>.</del></sup> 
									    <?php
									} else {
									    echo $cartProduct->price() . " " . $internationalizationService->get("product_currency") . ".";
									}
								    
									echo $internationalizationService->get("cart_side_view_size_label") . ": " . $cartProduct->size(); 
									
									?>
								</span>
    						</div>
    					</li>
					    
					    <?php
					    
					    $price = $cartProduct->promotionalPrice() == 0 ? $cartProduct->price() : $cartProduct->promotionalPrice();
					    $amount += $price * $cartProduct->quantity();
					}
					?>
				</ul>
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40"><?php echo $internationalizationService->get("cart_side_view_total_label") . ": " . $amount . $internationalizationService->get("product_currency"); ?>.</div>
					<div class="header-cart-buttons flex-w w-full">
						<a href="<?php echo $response->serverContext(); ?>/carts/api/v1" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							<?php echo $internationalizationService->get("cart_side_view_check_cart_label"); ?>
						</a> 
						<a href="<?php echo $response->serverContext(); ?>/orders/api/v1" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							<?php echo $internationalizationService->get("cart_side_view_finish_your_order_label"); ?> 
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
