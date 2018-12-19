<!doctype html>
<html lang="en">

  	<head>

        <meta charset="utf-8">
    
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <meta name="description" content="">
        <meta name="author" content="">
    
        <link rel="icon" href="../../../../favicon.ico">
    
        <link href="http://localhost/com.radoslav.web.shop/com/external/libraries/ui/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="http://localhost/com.radoslav.web.shop/com/external/libraries/ui/font-awesome/all.min.css" rel="stylesheet">
        <link href="http://localhost/com.radoslav.web.shop/com/view/administration/carousel.css" rel="stylesheet">
    	<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/home.css" />
    	<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/products.css" />
    	<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/cart.css" />
    	<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/product.css" />
    
  	</head>

<?php

    use service\InternationalizationService;

    $menCategories = $response->supportingEntity("menCategories");
    $womenCategories = $response->supportingEntity("womenCategories");
    $collections = $response->supportingEntity("collections");
    $languages = $response->supportingEntity("languages");

    $internationalizationService = new InternationalizationService($response->language());
?>

	<body>

    	<header>

      		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        		<a class="navbar-brand" href="<?php echo $response->serverContext(); ?>">Лого</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                  	<span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
              		<ul class="navbar-nav mr-auto">
              			<?php 
              			if (count($menCategories) != 0) {
              			    ?>
              			    
                            <li class="nav-item dropdown">
                              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 	 <?php echo $internationalizationService->get("header_view_navbar_mens"); ?>
                              	</a>

                				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  	<?php 
                                  	foreach ($menCategories as $menCategorie) {
                                  	    ?>
                                  	    
                                          <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/male/category/<?php echo $menCategorie->name(); ?>"><?php echo $menCategorie->displayName(); ?></a>
                                  	    
                                  	    <?php
                                  	}
                                  	?>
                              		<a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/male">Всички</a>
                                </div>
                			</li>
              			    
              			    
              			    <?php
              			}
              			?>

						<?php 
						if (count($womenCategories) != 0) {
						   ?>
						   
						   <li class="nav-item dropdown">
                              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 	 <?php echo $internationalizationService->get("header_view_navbar_womens"); ?>
                              	</a>
                				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	                              	<?php 
	                              	foreach ($womenCategories as $womenCategorie) {
                                  	    ?>
                                  	    
                                          <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/female/category/<?php echo $womenCategorie->name(); ?>"><?php echo $womenCategorie->displayName(); ?></a>
                                  	    
                                  	    <?php
                                  	}
                                  	?>
                					
                                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/type/female">Всички</a>

                                </div>
                			</li>
						   
						   <?php 
						}
						?>
        				
        				<?php 
        				if (count($collections) != 0) {
        				    ?>
        				    
            				<li class="nav-item dropdown">
                              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 	 <?php echo $internationalizationService->get("header_view_navbar_collections"); ?>
                              	</a>
                              	
                				<div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                  	<?php 
                                  	foreach ($collections as $collection) {
                                        ?>
    
                                              <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/products/api/v1/collection/<?php echo $collection->technicalName(); ?>"><?php echo $collection->titleName(); ?></a>
                                  	     
    									<?php   
                                  	}
                                  	?>

                                </div>
                			</li>

        				    <?php
        				}
        				?>

                  	</ul>
        
        			<ul class="navbar-nav justify-content-end">
        				<li class="nav-item">
                          	<a class="nav-link" href="<?php echo $response->serverContext(); ?>/carts/api/v1">
                             	 <?php echo $internationalizationService->get("header_view_navbar_cart"); ?>
                          	</a>
            			</li>
        				<li class="nav-item dropdown">
                          	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             	 <?php echo $internationalizationService->get("header_view_navbar_languages"); ?>
                          	</a>
            				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              	<?php 
                              	foreach ($languages as $language) {
                              	    ?>
                                  	<a class="dropdown-item" href="#" onclick="document.getElementById('form-for-language-<?php echo $language->name(); ?>').submit()">
                                  		<?php echo $language->name(); ?>
                                  	</a>
                              	    
                              	    <form id="form-for-language-<?php echo $language->name(); ?>" action="<?php echo $response->serverContext(); ?>/languages/api/v1" method="POST">
                              	    	<input type="hidden" name="language_name" value="<?php echo $language->name(); ?>">
                              	    </form>
                              	    
                              	    <?php
                              	}
                              	?>
            					
                            </div>
            			</li>
        			</ul>
            	</div>
			</nav>
		</header>

    <main role="main">
