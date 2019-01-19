<?php 

    use service\InternationalizationService;

    $internationalizationService = new InternationalizationService($response->language());

?>

	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30"><?php echo $internationalizationService->get("footer_view_categories_label"); ?></h4>
					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04"> 
								<?php echo $internationalizationService->get("footer_view_men_category_label"); ?> 
							</a>
						</li>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04"> 
								<?php echo $internationalizationService->get("footer_view_women_category_label"); ?> 
							</a>
						</li>
					</ul>
				</div>
				<div class="col-sm-6 col-lg-3 p-b-50">
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30"><?php echo $internationalizationService->get("footer_view_get_in_touch_label"); ?></h4>

					<p class="stext-107 cl7 size-201">
						<?php echo $internationalizationService->get("footer_view_get_in_touch_description"); ?>
					</p>

					<!-- <div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16"> 
							<i class="fa fa-facebook"></i>
						</a> 
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16"> 
							<i class="fa fa-instagram"></i>
						</a>
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16"> 
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div> -->
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30"><?php echo $internationalizationService->get("footer_view_newsletter_label"); ?></h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								<?php echo $internationalizationService->get("footer_view_newsletter_subsribe_button_label"); ?>
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<!-- <div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1"> <img
						src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a> <a href="#" class="m-all-1"> <img
						src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a> <a href="#" class="m-all-1"> <img
						src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a> <a href="#" class="m-all-1"> <img
						src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a> <a href="#" class="m-all-1"> <img
						src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div> -->
				<p class="stext-107 cl6 txt-center">

					Copyright &copy;
					<script>
						document.write(new Date().getFullYear());
					</script>

				</p>
			</div>
		</div>
	</footer>