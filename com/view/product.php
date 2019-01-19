<?php 

    use service\InternationalizationService;

    include "com/view/header.php";
	include "com/view/cart-side-bar.php";

    $product = $response->entity();
    $request = $response->request();

    $internationalizationService = new InternationalizationService($response->language());

?>

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?php echo $response->serverContext(); ?>" class="stext-109 cl8 hov-cl1 trans-04"> 
				<?php echo $internationalizationService->get("product_view_home_breadcrumb_label"); ?> <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a> 
			
			<a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
				<?php if ($product->type() === "male") { echo $internationalizationService->get("product_view_product_type_male"); } else { echo $internationalizationService->get("product_view_product_type_female"); } ?> <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			
			<span class="stext-109 cl4"> <?php echo $product->name(); ?> </span>
		</div>
	</div>

	<?php
	if ($request->getQueryParameter("insert") === "succeed") {
        ?>
		<div class="container" style="margin-top: 25px">
        	<div id="success-alert" class="alert alert-success" role="alert">
            	<?php echo $internationalizationService->get("product_view_successfully_added_product_message"); ?>
            </div>
    	</div>
        <?php
    }
    ?>
	
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							
							<div class="slick3 gallery-lb">
								<?php 
								$images = $product->imageNamesAsArray();
								
                                for ($i = 0 ; $i < count($images) ; $i++) {
                				?>
                					<div class="item-slick3" data-thumb="<?php echo $response->imagesContext(); ?>/<?php echo $images[$i]; ?>">
    									<div class="wrap-pic-w pos-relative">
    										<img src="<?php echo $response->imagesContext(); ?>/<?php echo $images[$i]; ?>" alt="IMG-PRODUCT"> 
    											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo $response->imagesContext(); ?>/<?php echo $images[$i]; ?>"> 
    											<i class="fa fa-expand"></i>
    										</a>
    									</div>
    								</div>
                				<?php
                                }
                				?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $product->name(); ?>
						</h4>
						
						<span class="mtext-106 cl2"><?php echo $product->price(); ?> <?php echo $internationalizationService->get("product_currency"); ?>.</span>
						
						<p class="stext-102 cl3 p-t-23">
							<?php echo $product->description(); ?>
						</p>

						<form action="<?php echo $response->serverContext(); ?>/carts/api/v1" method="POST">
							<input type="hidden" name="id" value="<?php echo $product->id(); ?>">

    						<div class="p-t-33">
    							<div class="flex-w flex-r-m p-b-10">
    								<div class="size-203 flex-c-m respon6"><?php echo $internationalizationService->get("product_view_size_label"); ?></div>
    						
    								<div class="size-204 respon6-next">
    									<div class="rs1-select2 bor8 bg0">
    										<select class="js-select2" name="size">
    											<option><?php echo $internationalizationService->get("product_view_choose_size_label"); ?></option>
                                        		<?php
                            				    $availableSizes = $product->availableSizesAsArray();
                                        		
                                        		foreach ($availableSizes as $availableSize) {
                                        		    ?>
            											<option value="<?php echo $availableSize; ?>"><?php echo $internationalizationService->get("product_view_size_label"); ?> <?php echo $availableSize; ?></option>
                                        		    <?php
                                        		}
                                        		?>
    										</select>
    						
    										<div class="dropDownSelect2"></div>
    									</div>
    								</div>
    							</div>
    						
    							<div class="flex-w flex-r-m p-b-10">
    								<div class="size-204 flex-w flex-m respon6-next">
    									<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
    										<?php echo $internationalizationService->get("product_view_add_to_cart_label"); ?>
    									</button>
    								</div>
    							</div>
    						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

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

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/daterangepicker/daterangepicker.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/slick/slick.min.js"></script>
	<script src="<?php echo $response->resourceContext(); ?>/com/view/js/slick-custom.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/isotope/isotope.pkgd.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>

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