<?php 

    include 'com/view/header.php';

?>

	<div class="album py-5 bg-light">
        
    	<div class="container">
          
      		<div class="row">
				<?php 
				$pagination = $response->entity();
                
				foreach ($pagination->entities() as $product) {
			    ?>
                	<div class="col-md-4">
                  		<div class="card mb-4 shadow-sm">
                  			<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>">
                        		<img class="card-img-top" src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>" alt="Card image cap">
                  			</a>
                    		
                    		<div class="card-body">
    							<br>
                        		Име: <?php echo $product->name(); ?>
    							<br>
                        		Тип: <?php if ($product->type() === "male") { echo "Мъжки"; } else { echo "Дамски"; } ?>
    							<br>                            		
                        		Категория: <?php echo $product->category(); ?>
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
                        			
                        			<small class="text-muted">
        								<?php
            								if ($product->promotionalPrice() == 0) {
            								    echo $product->price(); 
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
