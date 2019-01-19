<?php

    use service\InternationalizationService;

    include "com/view/header.php";
    include "com/view/cart-side-bar.php";

    $request = $response->request();

    $internationalizationService = new InternationalizationService($response->language());

?>

	<div class="container" style="margin-top: 25px; margin-bottom: 25px;">
	
		<?php 
		
		if ($request->getQueryParameter("registration-failed") === "username-is-taken") {
		    ?>
		    
		    <div id="success-alert" class="alert alert-success" role="alert">
            	<?php echo $internationalizationService->get("registration_view_username_is_taken"); ?>
            </div>
		    
		    <?php
		}
		
		?>
		<form action="<?php echo $response->serverContext(); ?>/users/api/v1" method="POST">
			<div class="form-group row">
				<label class="form-label col-sm-3" for="username">
					<?php echo $internationalizationService->get("registration_view_username"); ?>
				</label>

    			<input id="username" class="form-control col-sm-9" type="text" name="username" >
			</div>
			
			<div class="form-group row">
				<label class="form-label col-sm-3" for="password">
					<?php echo $internationalizationService->get("registration_view_password"); ?>
				</label>

    			<input id="password" class="form-control col-sm-9" type="password" name="password" >
			</div>
			
			
			<div class="form-group row">
				<label class="form-label col-sm-3" for="firstname">
					<?php echo $internationalizationService->get("registration_view_first_name"); ?>
				</label>

				<input id="firstname" class="form-control col-sm-9" type="text" name="firstname" >
			</div>

			<div class="form-group row">
				<label class="form-label col-sm-3" for="lastname">
					<?php echo $internationalizationService->get("registration_view_last_name"); ?>
				</label>

    			<input id="lastname" class="form-control col-sm-9" type="text" name="lastname" >
			</div>

			<div class="form-group row">
				<label class="form-label col-sm-3" for="email">
					<?php echo $internationalizationService->get("registration_view_email"); ?>
				</label>

    			<input id="email" class="form-control col-sm-9" type="text" name="email" >
			</div>

			<div class="form-group row">
				<label class="form-label col-sm-3" for="phone">
					<?php echo $internationalizationService->get("registration_view_phone"); ?>
				</label>

    			<input id="phone" class="form-control col-sm-9" type="text" name="phone" >
			</div>

			<div class="form-group row">
				<button type="submit" class="btn btn-primary col-sm-6 offset-sm-4">
					<?php echo $internationalizationService->get("registration_view_registration_button"); ?>
				</button>
			</div>

		</form>
	
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