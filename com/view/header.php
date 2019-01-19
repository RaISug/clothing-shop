<?php

    use service\InternationalizationService;
    use session\SessionService;

    $menCategories = $response->supportingEntity("menCategories");
    $womenCategories = $response->supportingEntity("womenCategories");
    $collections = $response->supportingEntity("collections");
    $cartProducts = $response->supportingEntity("cartProducts");
    $languages = $response->supportingEntity("languages");

    $sessionService = new SessionService();
    $internationalizationService = new InternationalizationService($response->language());

?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <title>N by B WebShop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <link rel="icon" type="image/png" href="<?php echo $response->resourceContext(); ?>/com/view/favicon.ico" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/fonts/iconic/css/material-design-iconic-font.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/fonts/linearicons-v1.0.0/icon-font.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/animate/animate.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/css-hamburgers/hamburgers.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/animsition/css/animsition.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/select2/select2.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/daterangepicker/daterangepicker.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/slick/slick.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/MagnificPopup/magnific-popup.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/vendor/perfect-scrollbar/perfect-scrollbar.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/css/util.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $response->resourceContext(); ?>/com/view/css/main.css">
    
    </head>

	<body class="animsition">
    	
    	<header class="header-v4">
    
    		<div class="container-menu-desktop">
    
    			<div class="top-bar">
    				<div class="content-topbar flex-sb-m h-full container">
    					<div class="left-top-bar">
						</div>
    					<div class="right-top-bar flex-w h-full">
    						<?php 
    						if ($sessionService->isUnauthenticatedRequest()) {
    						    ?>
    						    
        						<a href="<?php echo $response->serverContext(); ?>/login" class="flex-c-m trans-04 p-lr-25">
        							<?php echo $internationalizationService->get("header_view_login_label"); ?> 
    						 	</a> 
    						 	<a href="<?php echo $response->serverContext(); ?>/registration" class="flex-c-m trans-04 p-lr-25"> 
    						 		<?php echo $internationalizationService->get("header_view_registration_label"); ?> 
    					 		</a> 
    						    
    						    <?php
    						} else {
    						    ?>

    					 		<a href="<?php echo $response->serverContext(); ?>/logout" class="flex-c-m trans-04 p-lr-25"> 
    					 			<?php echo $internationalizationService->get("header_view_logout_label"); ?> 
    				 			</a> 

    						    <?php
    						}
    						?>
    					</div>
    				</div>
    			</div>
    			<div class="wrap-menu-desktop how-shadow1">
    				<nav class="limiter-menu-desktop container">
    
    					<a href="<?php echo $response->serverContext(); ?>/" class="logo"> 
    						<img src="<?php echo $response->resourceContext(); ?>/com/view/logo.png" alt="IMG-LOGO">
    					</a>
    
    					<div class="menu-desktop">
    						<ul class="main-menu">
    							<li>
    								<a href="<?php echo $response->serverContext(); ?>/products/api/v1">
    									<?php echo $internationalizationService->get("header_view_navbar_products"); ?> 
									</a>
    							</li>
    
    							<?php 
                      			if (count($menCategories) != 0) {
                      			    ?>

	    							<li>
        								<a href="<?php echo $response->serverContext(); ?>/products/api/v1/type/male">
        									<?php echo $internationalizationService->get("header_view_navbar_mens"); ?> <i class="zmdi zmdi-triangle-down"></i>
        								</a>
        								<ul class="sub-menu">
		                                  	<?php 
                                          	foreach ($menCategories as $menCategorie) {
                                          	    ?>
                                          	    <li>
            										<a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/male/category/<?php echo $menCategorie->name(); ?>"><?php echo $menCategorie->displayName(); ?></a>
            									</li>
                                          	    <?php
                                          	}
                                          	?>
        								</ul>
        							</li>

                      			    <?php
                      			}
                      			?>
    							
    							<?php 
    							if (count($womenCategories) != 0) {
                      			    ?>

	    							<li>
        								<a href="<?php echo $response->serverContext(); ?>/products/api/v1/type/female">
        									<?php echo $internationalizationService->get("header_view_navbar_womens"); ?> <i class="zmdi zmdi-triangle-down"></i>
        								</a>
        								<ul class="sub-menu">
		                                  	<?php 
                                          	foreach ($womenCategories as $womenCategorie) {
                                          	    ?>
                                          	    <li>
            										<a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/female/category/<?php echo $womenCategorie->name(); ?>"><?php echo $womenCategorie->displayName(); ?></a>
            									</li>
                                          	    <?php
                                          	}
                                          	?>
        								</ul>
        							</li>

                      			    <?php
                      			}
                      			?>

    							<?php 
    							if (count($collections) != 0) {
                      			    ?>

	    							<li>
        								<a href="#">
        									<?php echo $internationalizationService->get("header_view_navbar_collections"); ?> <i class="zmdi zmdi-triangle-down"></i>
        								</a>
        								<ul class="sub-menu">
		                                  	<?php 
		                                  	foreach ($collections as $collection) {
                                          	    ?>
                                          	    <li>
            										<a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/collection/<?php echo $collection->technicalName(); ?>"><?php echo $collection->titleName(); ?></a>
            									</li>
                                          	    <?php
                                          	}
                                          	?>
        								</ul>
        							</li>

                      			    <?php
                      			}
                      			?>
    						</ul>
    					</div>
    
    					<div class="wrap-icon-header flex-w flex-r-m">

							<?php 
							if ($sessionService->isUnauthenticatedRequest() == false) {
							    ?>
							    
        						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
        							<a href="<?php echo $response->serverContext(); ?>/users/api/v1/profile"><i class="zmdi zmdi-account"></i></a>
        						</div>
							    
							    <?php
							}
							?>
    						
    						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo count($cartProducts); ?>">
    							<i class="zmdi zmdi-shopping-cart"></i>
    						</div>
    						
    						<?php 
                  			if (count($languages) != 0) {
                  			    ?>
        						<ul class="main-menu">
            						<li>
            							<a href="#">
            								<?php echo $internationalizationService->get("header_view_navbar_languages"); ?> <i class="zmdi zmdi-triangle-down"></i>
            							</a>
            							<ul class="sub-menu">
            								<?php 
                                          	foreach ($languages as $language) {
                                          	    ?>
                                          	    <li>
                                                  	<a class="dropdown-item" href="#" onclick="document.getElementById('form-for-language-<?php echo $language->name(); ?>').submit()">
                                                  		<?php echo $language->name(); ?>
                                                  	</a>
                                              	    
                                              	    <form id="form-for-language-<?php echo $language->name(); ?>" action="<?php echo $response->serverContext(); ?>/languages/api/v1" method="POST">
                                              	    	<input type="hidden" name="language_name" value="<?php echo $language->name(); ?>">
                                              	    </form>
                                          	    </li>
                                          	    <?php
                                          	}
                                          	?>
            							</ul>
            						</li>
        						</ul>
                  			    <?php
                  			}
                  			?>
    					</div>
    				</nav>
    			</div>
    		</div>
    
    		<div class="wrap-header-mobile">
    
    			<div class="logo-mobile">
    				<a href="<?php echo $response->serverContext(); ?>/">
    					<img src="<?php echo $response->resourceContext(); ?>/com/view/logo.png" alt="IMG-LOGO">
					</a>
    			</div>
    
    			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
					<?php 
					if ($sessionService->isUnauthenticatedRequest() == false) {
					    ?>
					    
        				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11">
        					<a href="<?php echo $response->serverContext(); ?>/users/api/v1/profile"><i class="zmdi zmdi-account"></i></a>
        				</div>
					    
					    <?php
					}
					?>
    				
    				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php echo count($cartProducts); ?>">
    					<i class="zmdi zmdi-shopping-cart"></i>
    				</div>
    			</div>
    
    			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
    				<span class="hamburger-box"> <span class="hamburger-inner"></span>
    				</span>
    			</div>
    		</div>
    
    		<div class="menu-mobile">
    			<ul class="topbar-mobile">
    				<li>
    					<div class="left-top-bar">
						</div>
    					<div class="right-top-bar flex-w h-full">
    						<?php 
    						if ($sessionService->isUnauthenticatedRequest()) {
    						    ?>
    						    
    							<a href="<?php echo $response->serverContext(); ?>/login" class="flex-c-m p-lr-10 trans-04"> 
    								<?php echo $internationalizationService->get("header_view_login_label"); ?> 
    							</a> 
    							<a href="<?php echo $response->serverContext(); ?>/registration" class="flex-c-m p-lr-10 trans-04"> 
    								<?php echo $internationalizationService->get("header_view_registration_label"); ?> 
    							</a> 
    						    
    						    <?php
    						} else {
    						    ?>

    							<a href="<?php echo $response->serverContext(); ?>/logout" class="flex-c-m p-lr-10 trans-04"> 
    								<?php echo $internationalizationService->get("header_view_logout_label"); ?>
    							</a>

    						    <?php
    						}
    						?>
    					</div>
    				</li>
    			</ul>

    			<ul class="main-menu-m">
    				<li>
						<a href="<?php echo $response->serverContext(); ?>/products/api/v1">
							<?php echo $internationalizationService->get("header_view_navbar_products"); ?>
						</a>
					</li>

					<?php 
          			if (count($menCategories) != 0) {
          			    ?>

						<li>
							<a href="#">
								<?php echo $internationalizationService->get("header_view_navbar_mens"); ?>
							</a>
							<ul class="sub-menu-m">
                              	<?php 
                              	foreach ($menCategories as $menCategorie) {
                              	    ?>
                              	    <li>
										<a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/male/category/<?php echo $menCategorie->name(); ?>"><?php echo $menCategorie->displayName(); ?></a>
									</li>
                              	    <?php
                              	}
                              	?>
							</ul>

        					<span class="arrow-main-menu-m">
        						<i class="fa fa-angle-right" aria-hidden="true"></i>
        					</span>
						</li>

          			    <?php
          			}
          			?>

					<?php 
					if (count($womenCategories) != 0) {
          			    ?>

						<li>
							<a href="#">
								<?php echo $internationalizationService->get("header_view_navbar_womens"); ?>
							</a>
							<ul class="sub-menu-m">
                              	<?php 
                              	foreach ($womenCategories as $womenCategorie) {
                              	    ?>
                              	    <li>
										<a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/female/category/<?php echo $womenCategorie->name(); ?>"><?php echo $womenCategorie->displayName(); ?></a>
									</li>
                              	    <?php
                              	}
                              	?>
							</ul>

        					<span class="arrow-main-menu-m">
        						<i class="fa fa-angle-right" aria-hidden="true"></i>
        					</span>
						</li>

          			    <?php
          			}
          			?>
 
 					<?php 
					if (count($collections) != 0) {
          			    ?>

						<li>
							<a href="#">
								<?php echo $internationalizationService->get("header_view_navbar_collections"); ?>
							</a>
							<ul class="sub-menu-m">
                              	<?php 
                              	foreach ($collections as $collection) {
                              	    ?>
                              	    <li>
										<a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/collection/<?php echo $collection->technicalName(); ?>"><?php echo $collection->titleName(); ?></a>
									</li>
                              	    <?php
                              	}
                              	?>
							</ul>

        					<span class="arrow-main-menu-m">
        						<i class="fa fa-angle-right" aria-hidden="true"></i>
        					</span>
						</li>

          			    <?php
          			}
          			?>
          			
          			<?php 
          			if (count($languages) != 0) {
          			    ?>

						<li>
							<a href="#">
								<?php echo $internationalizationService->get("header_view_navbar_languages"); ?>
							</a>
							<ul class="sub-menu-m">
								<?php 
                              	foreach ($languages as $language) {
                              	    ?>
                                  	<a class="dropdown-item" href="#" onclick="document.getElementById('form-m-for-language-<?php echo $language->name(); ?>').submit()">
                                  		<?php echo $language->name(); ?>
                                  	</a>
                              	    
                              	    <form id="form-m-for-language-<?php echo $language->name(); ?>" action="<?php echo $response->serverContext(); ?>/languages/api/v1" method="POST">
                              	    	<input type="hidden" name="language_name" value="<?php echo $language->name(); ?>">
                              	    </form>
                              	    
                              	    <?php
                              	}
                              	?>
							</ul>

        					<span class="arrow-main-menu-m">
        						<i class="fa fa-angle-right" aria-hidden="true"></i>
        					</span>
						</li>
          			    <?php
  			        }
      			    ?>
          			
    			</ul>
    		</div>
    
    	</header>