<div align="center">
	<?php

      use service\InternationalizationService;

      $request = $response->request();

	  $currentPage = $pagination->currentPage();
	  $pagesCount = $pagination->calculatePagesCount();

	  $internationalizationService = new InternationalizationService($response->language());
	  
	  if ($pagination->hasPreviousPage()) {
	      ?>
		  	<a href="<?php echo $response->serverContext(); ?><?php echo $request->getPath(); ?>?<?php echo $pagination->constructPreviousPagePaginationQueryPath(); ?>">
		  		<?php echo $internationalizationService->get("pagination_view_previous_page_text"); ?>
		  	</a>
		  <?php
	  }

	  for ($i = 0 ; $i < $pagesCount ; $i++) {
	      if ($i === $currentPage) {
		      	echo $i + 1;
	      } else {
		      ?>
		      	<a href="<?php echo $response->serverContext(); ?><?php echo $request->getPath(); ?>?<?php echo $pagination->construcPaginationQueryPathForPage($i); ?>"><?php echo $i + 1; ?></a>
		      <?php
	      }
	  }
	  ?>

	  <?php
	  if ($pagination->hasMorePages()) {
		  ?>
		  	<a href="<?php echo $response->serverContext(); ?><?php echo $request->getPath(); ?>?<?php echo $pagination->constructNextPagePaginationQueryPath(); ?>">
		  		<?php echo $internationalizationService->get("pagination_view_next_page_text"); ?>
	  		</a>
		  <?php
	  }
	?>
</div>
