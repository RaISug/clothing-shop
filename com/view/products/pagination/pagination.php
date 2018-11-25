<div align="center">
	<?php
	  $currentPage = $pagination->currentPage();
	  $pagesCount = $pagination->calculatePagesCount();

	  if ($pagination->hasPreviousPage()) {
	      ?>
		  	<a href="<?php echo $response->serverContext(); ?>/products/api/v1?<?php echo $pagination->constructPreviousPagePaginationQueryPath(); ?>">Previous Page</a>
		  <?php
	  }

	  for ($i = 0 ; $i < $pagesCount ; $i++) {
	      if ($i === $currentPage) {
	          ?>
		      	<?php echo $i + 1; ?>
		      <?php 
	      } else {
		      ?>
		      	<a href="<?php echo $response->serverContext(); ?>/products/api/v1?<?php echo $pagination->construcPaginationQueryPathForPage($i); ?>"><?php echo $i + 1; ?></a>
		      <?php
	      }
	  }
	  ?>

	  <?php
	  if ($pagination->hasMorePages()) {
		  ?>
		  	<a href="<?php echo $response->serverContext(); ?>/products/api/v1?<?php echo $pagination->constructNextPagePaginationQueryPath(); ?>">Next Page</a>
		  <?php
	  }
	?>
</div>
