<DOCTYPE html>
<html>

	<form id="carousel-description" action="<?php echo $response->serverContext(); ?>/administration/carousels/api/v1" method="POST" enctype="multipart/form-data">
		<input type="file" name="carouselimage" />
		<textarea form="carousel-description" name="description"></textarea>
		<input type="submit" />
	</form>

</html>