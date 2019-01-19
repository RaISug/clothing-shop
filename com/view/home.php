<?php

    use service\InternationalizationService;

    include "com/view/header.php"; 
    include "com/view/cart-side-bar.php";

    $carousels = $response->supportingEntity("carousels");
    $collections = $response->supportingEntity("collections");
    
    $internationalizationService = new InternationalizationService($response->language());

    if (isset($carousels) && isset($carousels[0])) {
        ?>

    	<section class="section-slide">
    		<div class="wrap-slick1">
    			<div class="slick1">

    				<div class="item-slick1" style="background-image: url(<?php echo $response->imagesContext(); ?>/carousel/<?php echo $carousels[0]->imageName(); ?>);">
    					<div class="container h-full">
    						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
    							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
    							</div>
    							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
    								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
    									<?php echo $carousels[0]->description(); ?>
    								</h2>
    							</div>
    							<div class="layer-slick1 animated visible-false"
    								data-appear="zoomIn" data-delay="1600">
    								<a href="<?php echo $response->serverContext(); ?>/products/api/v1" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
    									<?php echo $internationalizationService->get("home_view_shop_now_label"); ?>
    								</a>
    							</div>
    						</div>
    					</div>
    				</div>
    				    
    				<?php
    				
    				if (isset($carousels[1])) {
    				    ?>
    				    
    				    <div class="item-slick1" style="background-image: url(<?php echo $response->serverContext(); ?>/carousel/<?php echo $carousels[1]->imageName(); ?>);">
        					<div class="container h-full">
        						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
        							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
        							</div>
        							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
        								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
        									<?php echo $carousels[1]->description(); ?>
        								</h2>
        							</div>
        							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
        								<a href="<?php echo $response->serverContext(); ?>/products/api/v1" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
        									<?php echo $internationalizationService->get("home_view_shop_now_label"); ?>
        								</a>
        							</div>
        						</div>
        					</div>
        				</div>
    				
    				    <?php
    				}
    				
    				if (isset($carousels[2])) {
    				    
    				    ?>
    				    
        				<div class="item-slick1" style="background-image: url(<?php echo $response->serverContext(); ?>/carousel/<?php echo $carousels[2]->imageName(); ?>);">
        					<div class="container h-full">
        						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
        							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
        							</div>
        							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
        								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
        									<?php echo $carousels[2]->description(); ?>
        								</h2>
        							</div>
        							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
        								<a href="<?php echo $response->serverContext(); ?>/products/api/v1" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
        									<?php echo $internationalizationService->get("home_view_shop_now_label"); ?>
        								</a>
        							</div>
        						</div>
        					</div>
        				</div>
    				
    				<?php
    				
    				}
    				
    				?>
    				
    			</div>
    		</div>
    	</section>
        
        <?php
    }

    if (isset($collections) && count($collections)) {
        ?>
        
        <div class="sec-banner bg0 p-t-80 p-b-50">
    		<div class="container">
    			<div class="row">
    			
    				<?php 
    				
    				foreach ($collections as $collection) {
    				    ?>
    				    	<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
            					<div class="block1 wrap-pic-w">
            						<img src="<?php echo $response->imagesContext(); ?>/collections/<?php echo $collection->imageName(); ?>" alt="IMG-BANNER"> 
            						<a href="<?php echo $response->serverContext(); ?>/products/api/v1/collection/<?php echo $collection->technicalName(); ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
            							<div class="block1-txt-child1 flex-col-l">
            								<span class="block1-name ltext-102 trans-04 p-b-8"> 
            									<?php echo $collection->titleName(); ?>
            								</span> 
            								<span class="block1-info stext-102 trans-04"> 
            									<?php echo $collection->description(); ?>
            								</span>
            							</div>
            							<div class="block1-txt-child2 p-b-4 trans-05">
            								<div class="block1-link stext-101 cl0 trans-09">
            									<?php echo $internationalizationService->get("home_view_shop_now_label"); ?>
        									</div>
            							</div>
            						</a>
            					</div>
            				</div>
    				    <?php
    				}
    				
    				?>
    			</div>
    		</div>
    	</div>
        
        <?php
    }
	?>

	<?php include "com/view/footer.php"; ?>

	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top"> <i
			class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<script src="<?php echo $response->resourceContext(); ?>/com/view/vendor/jquery/jquery-3.2.1.min.js"></script>

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
		$('.js-addwish-b2').on('click', function(e) {
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