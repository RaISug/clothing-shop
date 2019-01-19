<?php 

    use service\InternationalizationService;

    include "com/view/header.php";
    include "com/view/cart-side-bar.php";

    $request = $response->request();
    
    $internationalizationService = new InternationalizationService($response->language());

?>
	
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<?php 

				if ($request->getPath() === "/products/api/v1" || strpos($request->getPath(), "/products/api/v1/collections/") !=  FALSE) {
				    ?>

        				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
        					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
        						<?php echo $internationalizationService->get("products_view_all_products_label"); ?>
        					</button>
        					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
        						<?php echo $internationalizationService->get("products_view_women_products_label"); ?>
        					</button>
        					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
        						<?php echo $internationalizationService->get("products_view_men_products_label"); ?>
        					</button>
        				</div>


				    <?php
				}
				
				?>
				
				<?php include "com/view/filter.php"; ?>
			</div>

			<?php
            	if ($request->getQueryParameter("insert") === "succeed") {
                    ?>
            		<div>
                    	<div id="success-alert" class="alert alert-success" role="alert">
                        	<?php echo $internationalizationService->get("products_view_successfully_added_product_message"); ?>
                        </div>
                	</div>
                    <?php
                }
            ?>
			
			<div class="row isotope-grid">
				<?php
				    $pagination = $response->entity();

					foreach ($pagination->entities() as $product) {
                        ?>
                        
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php if ($product->type() === "male") { echo "men"; } else { echo "women"; } ?>">

        					<div class="block2">
        						<div class="block2-pic hov-img0">
        							<img src="<?php echo $response->imagesContext(); ?>/<?php echo $product->getFirstImageName(); ?>" alt="IMG-PRODUCT"> 
    								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal<?php echo $product->id(); ?>">
    									<?php echo $internationalizationService->get("products_view_quick_view_label"); ?>
    								</a>
        						</div>

        						<div class="block2-txt flex-w flex-t p-t-14">
        							<div class="block2-txt-child1 flex-col-l ">
        								<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
        									<?php echo $product->name(); ?> 
    									</a> 
    									
    									<span class="stext-105 cl3">
    										<?php echo $product->price(); ?> <?php echo $internationalizationService->get("product_currency"); ?>.
        								</span>
        							</div>
        						</div>
        					</div>

        				</div>
                        
                        <?php
					}		
				?>
				
			</div>

		</div>
	</div>

	<?php include "com/view/footer.php"; ?>
	
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top"> <i
			class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/jquery/jquery-3.2.1.min.js"></script>

	<?php include "com/view/product-quick-view.php"; ?>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/animsition/js/animsition.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function() {
			$(this).select2({
				minimumResultsForSearch : 20,
				dropdownParent : $(this).next('.dropDownSelect2')
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
				delegate : 'a', // the selector for gallery item
				type : 'image',
				gallery : {
					enabled : true
				},
				mainClass : 'mfp-fade'
			});
		});
	</script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/isotope/isotope.pkgd.min.js"></script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e) {
			e.preventDefault();
		});

		$('.js-addwish-b2').each(
				function() {
					var nameProduct = $(this).parent().parent().find(
							'.js-name-b2').html();
					$(this).on('click', function() {
						swal(nameProduct, "is added to wishlist !", "success");

						$(this).addClass('js-addedwish-b2');
						$(this).off('click');
					});
				});

		$('.js-addwish-detail').each(
				function() {
					var nameProduct = $(this).parent().parent().parent().find(
							'.js-name-detail').html();

					$(this).on('click', function() {
						swal(nameProduct, "is added to wishlist !", "success");

						$(this).addClass('js-addedwish-detail');
						$(this).off('click');
					});
				});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(
				function() {
					var nameProduct = $(this).parent().parent().parent()
							.parent().find('.js-name-detail').html();
					$(this).on('click', function() {
						swal(nameProduct, "is added to cart !", "success");
					});
				});
	</script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function() {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed : 1,
				scrollingThreshold : 1000,
				wheelPropagation : false,
			});

			$(window).on('resize', function() {
				ps.update();
			})
		});
	</script>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/js/main.js"></script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-23581568-13');
	</script>
	
</body>
</html>