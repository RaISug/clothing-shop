<?php

    include_once 'header.php';
    
    $product = $response->entity();
    $request = $response->request();
    
    $images = $product->imageNamesAsArray();

?>
	<div class="container" style="margin-top: 30px; padding: 30px; background-color: white; border: 1px solid #d1d1d1;">
  		<?php
  		if ($request->getQueryParameter("insert") === "succeed") {
  	        ?>
  	        	<div id="success-alert" class="alert alert-success" role="alert">
                	Продукта беше успешно добавен към вашата кошница.
                </div>
  	        <?php
  	    }
        ?>
        
    	<div class="product-details">
			<div class="product-details-images">
				
				<div class="product-details-main-image">
					<img class="productImage" src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>"/>
				</div>
				
				<div class="product-details-secondary-images">
				
    				<?php 
                    for ($i = 1 ; $i < count($images) ; $i++) {
    				?>
    					<img class="productImage" src="<?php echo $response->serverContext(); ?>/../images/<?php echo $images[$i]; ?>"/>
    				<?php
                    }
    				?>
				
				</div>
			</div>
			
			<div class="product-details-description">
				<div>
					<table>
						<tr>
							<td class="description">Име на продукта: </td>
							<td><?php echo $product->name(); ?></td>
						</tr>
						
						<?php 
						if ($product->description() != "") {
    						?>
						
    						<tr>
    							<td class="description">Описание: </td>
    							<td><?php echo $product->description(); ?></td>
    						</tr>
						
						
							<?php    
						}
						?>
					
						<tr>
							<td class="description">Тип: </td>
							<td><?php if ($product->type() === "male") { echo "Мъжки"; } else { echo "Дамски"; }?></td>
						</tr>
					
						<tr>
							<td class="description">Категория: </td>
							<td><?php echo $product->category(); ?></td>
						</tr>
					
						<tr>
							<td class="description">Цена: </td>
							<td>
								<?php
    								if ($product->promotionalPrice() == 0) {
    								    echo $product->price(); 
    								} else {
			     					    ?>
				
										<b><?php echo $product->promotionalPrice(); ?> лв.</b><sup style="color: red"><del><?php echo $product->price(); ?>лв.</del></sup>
				
										<?php
    								}
								?> лв.
							</td>
						</tr>
					
						<tr>
							<td></td>
							<td>
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
							</td>
						</tr>

					</table>
				</div>
			</div>
		</div>
		
		<div id="productModal" class="modal">
			<span class="close" onclick="document.getElementById('productModal').style.display='none'" style="margin-top: 35px">&times;</span>
			
			<img class="modal-content" id="modalImage">
		
			<div id="caption"></div>
		</div>

	</div>
<?php

    include_once 'footer.php';

?>
