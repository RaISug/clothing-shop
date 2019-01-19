<?php 

    use service\InternationalizationService;

    include "com/view/header.php"; 
    include "com/view/cart-side-bar.php";

    $request = $response->request();

    $internationalizationService = new InternationalizationService($response->language());
?>

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo $internationalizationService->get("cart_view_breadcrumb_home"); ?> <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a> 
			
			<span class="stext-109 cl4"> <?php echo $internationalizationService->get("cart_view_breadcrumb_cart"); ?> </span>
		</div>
	</div>

	<div class="container">
		
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

		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1"><?php echo $internationalizationService->get("cart_view_table_header_product"); ?></th>
								<th class="column-2"></th>
								<th class="column-3"><?php echo $internationalizationService->get("cart_view_table_header_price"); ?></th>
								<th class="column-4"><?php echo $internationalizationService->get("cart_view_table_header_quantity"); ?></th>
								<th class="column-5"><?php echo $internationalizationService->get("cart_view_table_header_size"); ?></th>
							</tr>
							
							<?php 
							    $amount = 0;
							    $products = $response->entity();
							    
							    foreach ($products as $product) {
							        ?>
							        
    								<tr class="table_row">
    									<td class="column-1">
    										<div class="how-itemcart1" onclick="document.getElementById('cart-item-removal-<?php echo $product->id(); ?>').submit();">
    											<form id="cart-item-removal-<?php echo $product->id(); ?>" action="<?php echo $response->serverContext(); ?>/carts/api/v1/cart/<?php echo $product->id(); ?>/size/<?php echo $product->size(); ?>" method="POST">
                                    				<input type="hidden" name="_method" value="DELETE">
                                    				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                                    				<input type="hidden" name="size" value="<?php echo $product->size(); ?>">
                                    				<button type="submit" style="border: none;">
                                    					<img src="<?php echo $response->imagesContext(); ?>/<?php echo $product->getFirstImageName(); ?>" alt="IMG">
                                					</button>
                                    			</form>
    										</div>
    									</td>
    									<td class="column-2"><?php echo $product->name(); ?></td>
    									<td class="column-3"><?php echo $product->price(); ?> <?php echo $internationalizationService->get("product_currency"); ?>.</td>
    									<td class="column-4">
    										<div class="wrap-num-product flex-w m-l-auto m-r-0">
    											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
    												<form style="display: inherit; margin-left: 5px;" action="<?php echo $response->serverContext(); ?>/carts/api/v1/cart/<?php echo $product->id(); ?>/size/<?php echo $product->size(); ?>" method="POST">
                                        				<input type="hidden" name="_method" value="PUT">
                                        				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                                        				<input type="hidden" name="size" value="<?php echo $product->size(); ?>">
                                        				<button type="submit" style="border: none;">
            												<i class="fs-16 zmdi zmdi-minus"></i>
                                    					</button>
                                        			</form>
    											</div>
    											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="<?php echo $product->quantity(); ?>">
    											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
    												<form action="<?php echo $response->serverContext(); ?>/carts/api/v1" method="POST">
                                        				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                                        				<input type="hidden" name="size" value="<?php echo $product->size(); ?>">
                                        			
                                        				<button type="submit" style="border: none;">
            												<i class="fs-16 zmdi zmdi-plus"></i>
                                    					</button>
                                        			</form>
    											</div>
    										</div>
    									</td>
    									<td class="column-5"><?php echo $product->size(); ?></td>
    								</tr>
							        
							        <?php
							        
							        $price = $product->promotionalPrice() == 0 ? $product->price() : $product->promotionalPrice();
							        $amount += $price * $product->quantity();
							    }
							?>
						</table>
					</div>
					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-w flex-m m-r-20 m-tb-5">
							<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
								<a href="<?php echo $response->serverContext(); ?>/products/api/v1"><?php echo $internationalizationService->get("cart_view_back_to_shopping"); ?></a>
							</div>
						</div>
						<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
							<a href="<?php echo $response->serverContext(); ?>/orders/api/v1"><?php echo $internationalizationService->get("cart_view_finish_shopping"); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
				<div
					class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30"><?php echo $internationalizationService->get("cart_view_cart_total_label"); ?></h4>
					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<span class="stext-110 cl2"> <?php echo $internationalizationService->get("cart_view_subtotal_label"); ?>: </span>
						</div>
						<div class="size-209">
							<span class="mtext-110 cl2"> <?php echo $amount; ?> <?php echo $internationalizationService->get("product_currency"); ?> </span>
						</div>
					</div>
					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2"> <?php echo $internationalizationService->get("cart_view_shipping_label"); ?>: </span>
						</div>
						<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
							<p class="stext-111 cl6 p-t-2">There are no shipping methods
								available. Please double check your address, or contact us if
								you need any help.</p>
							<div class="p-t-15">
								<span class="stext-112 cl8"> <?php echo $internationalizationService->get("cart_view_calculate_shipping_label"); ?> </span>
								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
									<select class="js-select2" name="time">
										<option><?php echo $internationalizationService->get("cart_view_choose_country_label"); ?>...</option>
										<option>USA</option>
										<option>UK</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
								<div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
								</div>
								<div class="bor8 bg0 m-b-22">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
								</div>
								<div class="flex-w">
									<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
										<?php echo $internationalizationService->get("cart_view_update_totals_label"); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2"> <?php echo $internationalizationService->get("cart_view_total"); ?>: </span>
						</div>
						<div class="size-209 p-t-1">
							<span class="mtext-110 cl2"> <?php echo $amount . $internationalizationService->get("product_currency"); ?> </span>
						</div>
					</div>
					<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
						<?php echo $internationalizationService->get("cart_view_finish_shopping"); ?>
					</button>
				</div>
			</div>
		</div>
	</div>

	<?php include "com/view/footer.php"; ?>

	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top"> <i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/animsition/js/animsition.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/js/main.js"></script>

	<script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-23581568-13');
	</script>
</body>
</html>