<?php 

    use service\InternationalizationService;

    include 'com/view/header.php';

    $internationalizationService = new InternationalizationService($response->language());
?>

	<div class="album py-5 bg-light">
        
    	<div class="container">
          
          	<?php 
          	    $request = $response->request();
          	    if ($request->getQueryParameter("insert") === "succeed") {
          	        ?>
          	        	<div id="success-alert" class="alert alert-success" role="alert">
                        	<?php echo $internationalizationService->get("product_view_successfully_added_product_message"); ?>
                        </div>
          	        <?php
          	    }
          	?>
      		<div class="row">
				<?php 
				$pagination = $response->entity();
                
				foreach ($pagination->entities() as $product) {
			    ?>
                	<div class="col-md-4" style="max-height: 380px">
                  		<div class="card mb-4 shadow-sm">
                  			<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>">
                        		<img class="card-img-top" src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>" alt="Card image cap">
                  			</a>
                    		
                    		<div class="card-body">
    							<br>
                        		<?php echo $internationalizationService->get("products_view_product_name_label"); ?>: <?php echo $product->name(); ?>
    							<br>
                        		<?php echo $internationalizationService->get("products_view_product_type_label"); ?>: <?php if ($product->type() === "male") { echo $internationalizationService->get("product_view_product_type_male"); } else { echo $internationalizationService->get("product_view_product_type_female"); } ?>
    							<br>                            		
                        		<?php echo $internationalizationService->get("products_view_product_category_label"); ?>: <?php echo $product->category(); ?>
    							<br>                            		
    
                      			<div class="d-flex justify-content-between align-items-center">
                        			<div class="btn-group">
                          				<?php 
                    				    $availableSizes = $product->availableSizesAsArray();
                                		
                                		foreach ($availableSizes as $availableSize) {
                            		    ?>
                                    		<div style="margin-top: 10px;">
                                    			<form action="<?php echo $response->serverContext(); ?>/carts/api/v1" method="POST">
                                    				<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
                                    				<input type="hidden" name="size" value="<?php echo $availableSize; ?>">
                                    				<button type="submit" class="btn btn-sm btn-outline-secondary"><?php echo $availableSize; ?></button>
                                    			</form>
                                    		</div>
                                		<?php
                                		}
                                		?>
                        			</div>
                        			
                        			<small class="text-muted" style="font-size: 18px">
        								<?php
            								if ($product->promotionalPrice() == 0) {
            								    echo $product->price() . " лв."; 
            								} else {
        			     					    ?>
        				
        										<b><?php echo $product->promotionalPrice(); ?> лв.</b><sup style="color: red"><del><?php echo $product->price(); ?>лв.</del></sup>
        				
        										<?php
            								}
        								?>
                    				</small>
                      			</div>
                    		
                    		</div>
                  		
                  		</div>
                  		
                	</div>
                	
                <?php
				}
				?>            
            	
          	</div>
          	
          	<?php include 'pagination.php'; ?>
        </div>
        
  	</div>

<?php 
    include 'com/view/footer.php';
?>
