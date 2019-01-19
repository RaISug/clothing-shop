<?php

    use service\InternationalizationService;
use session\SessionService;
    
    include "com/view/header.php";
    include "com/view/cart-side-bar.php";
    
    $request = $response->request();
    
    $sessionService = new SessionService();
    $user = $sessionService->getAuthenticatedUser();

    $internationalizationService = new InternationalizationService($response->language());

    if ($request->getQueryParameter("order") === "succeed") {
        ?>
        <div class="container" style="margin-top: 50px" >
            <div class="alert alert-success" role="alert">
            	<?php echo $internationalizationService->get("order_view_confirmation_message"); ?>
            </div>
        </div>
        <?php
    } else {
        ?>
    	<div class="container" style="margin-top: 50px" >
    		<div style="text-align: center"><h3><?php echo $internationalizationService->get("order_view_finish_your_order_label"); ?></h3></div>
        	<form id="order-form" action="<?php echo $response->serverContext(); ?>/orders/api/v1" method="POST">
              	
              	<div class="form-group row">
                    <label for="user_first_name" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_name_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="user_first_name" name="user_first_name" value="<?php echo $user->firstName(); ?>"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="user_last_name" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_family_name_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="user_last_name" name="user_last_name" value="<?php echo $user->lastName(); ?>"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_email_label"); ?></label>
                    <input class="col-sm-10 form-control" type="email" id="email" name="email" value="<?php echo $user->email(); ?>"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_phone_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="phone" name="phone" value="<?php echo $user->phone(); ?>"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_address_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="address" name="address"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_comment_label"); ?></label>
        			<textarea class="col-sm-10 form-control" form="order-form" id="comment" name="comment" placeholder="Коментар"></textarea>
        		</div>
        		
        		<div class="form-group">
        			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-4"><?php echo $internationalizationService->get("order_view_order_button_text"); ?></button>
            	</div>
        	</form>
        </div>
		<?php
    }
    
    include "com/view/footer.php"; 

?>

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