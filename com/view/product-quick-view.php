<?php 

    use service\InternationalizationService;

    $pagination = $response->entity();
    
    $internationalizationService = new InternationalizationService($response->language());

    foreach ($pagination->entities() as $product) {
?>
    	<div class="wrap-modal<?php echo $product->id(); ?> js-modal<?php echo $product->id(); ?> p-t-60 p-b-20">
    		<div class="overlay-modal<?php echo $product->id(); ?> js-hide-modal<?php echo $product->id(); ?>"></div>
    
    		<div class="container">
    			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
    				<button class="how-pos3 hov3 trans-04 js-hide-modal<?php echo $product->id(); ?>">
    					<img src="<?php echo $response->resourceContext(); ?>/com/view/icon-close.png" alt="CLOSE">
    				</button>
    
    				<div class="row">
    					<div class="col-md-6 col-lg-7 p-b-30">
    						<div class="p-l-25 p-r-30 p-lr-0-lg">
    							<div class="wrap-slick3 flex-sb flex-w">
    								<div class="wrap-slick3-dots"></div>
    
    								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
    
    								<div class="slick3 gallery-lb">
    									<?php 
        									$images = $product->imageNamesAsArray();
            								
                                            for ($i = 0 ; $i < count($images) ; $i++) {
                            				?>
                            					<div class="item-slick3" data-thumb="<?php echo $response->imagesContext(); ?>/<?php echo $images[$i]; ?>">
                									<div class="wrap-pic-w pos-relative">
                										<img src="<?php echo $response->imagesContext(); ?>/<?php echo $images[$i]; ?>" alt="IMG-PRODUCT"> 
                											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo $response->imagesContext(); ?>/<?php echo $images[$i]; ?>"> 
                											<i class="fa fa-expand"></i>
                										</a>
                									</div>
                								</div>
                            				<?php
                                            }
                        				?>
    								</div>
    							</div>
    						</div>
    					</div>
    
    					<div class="col-md-6 col-lg-5 p-b-30">
    						<div class="p-r-50 p-t-5 p-lr-0-lg">
    							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
    								<?php echo $product->name(); ?>
    							</h4>
    							
    							<span class="mtext-106 cl2"> $<?php echo $product->price(); ?> </span>
    							
    							<p class="stext-102 cl3 p-t-23">
    								<?php echo $product->description(); ?>
    							</p>
    
    							<form action="<?php echo $response->serverContext(); ?>/carts/api/v1" method="POST">
        							<input type="hidden" name="id" value="<?php echo $product->id(); ?>">
        
            						<div class="p-t-33">
            							<div class="flex-w flex-r-m p-b-10">
            								<div class="size-203 flex-c-m respon6">
            									<?php echo $internationalizationService->get("product_quick_view_size_label"); ?>
        									</div>
            						
            								<div class="size-204 respon6-next">
            									<div class="rs1-select2 bor8 bg0">
            										<select class="js-select2" name="size">
            											<option><?php echo $internationalizationService->get("product_quick_view_choose_size_label"); ?></option>
                                                		<?php
                                    				    $availableSizes = $product->availableSizesAsArray();
                                                		
                                                		foreach ($availableSizes as $availableSize) {
                                                		    ?>
                    											<option value="<?php echo $availableSize; ?>"><?php echo $internationalizationService->get("product_quick_view_size_label"); ?> <?php echo $availableSize; ?></option>
                                                		    <?php
                                                		}
                                                		?>
            										</select>
            						
            										<div class="dropDownSelect2"></div>
            									</div>
            								</div>
            							</div>
            						
            							<div class="flex-w flex-r-m p-b-10">
            								<div class="size-204 flex-w flex-m respon6-next">
            									<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
            										<?php echo $internationalizationService->get("product_quick_view_add_to_cart_label"); ?>
            									</button>
            								</div>
            							</div>
            						</div>
        						</form>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	
    	<style>
        
            .wrap-modal<?php echo $product->id(); ?> {
              position: fixed;
              width: 100%;
              height: 100vh;
              top: 0;
              left: 0;
              z-index: 9000;
              overflow: auto;
            
              -webkit-transition: all 0.4s;
              -o-transition: all 0.4s;
              -moz-transition: all 0.4s;
              transition: all 0.4s;
            
              visibility: hidden;
              opacity: 0;
            }
            
            .overlay-modal<?php echo $product->id(); ?> {
              position: fixed;
              z-index: -1;
              width: 100%;
              height: 100%;
              top: 0;
              left: 0;
              background: #000;
              opacity: 0.8;
            }
            
            .show-modal<?php echo $product->id(); ?> {
              visibility: visible;
              opacity: 1;
            }
        
        </style>

    	<script>
        	$('.js-show-modal<?php echo $product->id(); ?>').on('click',function(e){
                e.preventDefault();
                $('.js-modal<?php echo $product->id(); ?>').addClass('show-modal<?php echo $product->id(); ?>');
            });
        
            $('.js-hide-modal<?php echo $product->id(); ?>').on('click',function(){
                $('.js-modal<?php echo $product->id(); ?>').removeClass('show-modal<?php echo $product->id(); ?>');
            });
    	</script>
<?php
    }
?>