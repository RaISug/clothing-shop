<?php 

    use service\InternationalizationService;

    $internationalizationService = new InternationalizationService($response->language());

?>
				
    <div class="flex-w flex-c-m m-tb-10">
    	<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
    		<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
    		<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
    		<?php echo $internationalizationService->get("filter_view_header_label"); ?>
    	</div>
    </div>
    
    <div class="dis-none panel-filter w-full p-t-10">
    	<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
    		<div class="filter-col1 p-r-15 p-b-27">
    			<div class="mtext-102 cl2 p-b-15"><?php echo $internationalizationService->get("filter_view_sort_by_label"); ?></div>
    			<ul>
    				<li class="p-b-6">
    					<a href="#" class="filter-link stext-106 trans-04">
    						 <?php echo $internationalizationService->get("filter_view_price_from_low_high"); ?>
    					</a>
    				</li>
    				<li class="p-b-6">
    					<a href="#" class="filter-link stext-106 trans-04">
    						 <?php echo $internationalizationService->get("filter_view_price_from_high_to_low"); ?>
    					</a>
    				</li>
    			</ul>
    		</div>
    	</div>
    </div>