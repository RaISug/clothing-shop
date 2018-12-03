<DOCTYPE html>
<html>

	<head>
	   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	</head>
	<?php 

	   $order = $response->entity();
	   $categories = $response->supportingEntity("categories");

	?>

	<form id="update-product-form" action="<?php echo $response->serverContext(); ?>/administration/products/api/v1/product/<?php echo $order->id(); ?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PUT" />
		<input type="hidden" name="id" value="<?php echo $order->id(); ?>" />
		<input type="text" name="name" value="<?php echo $order->name(); ?>" />
		<select name="type">
			<option value="male" <?php if ("male" === $order->type()) echo "selected"; ?>>Мъже</option>
			<option value="female" <?php if ("female" === $order->type()) echo "selected"; ?>>Жени</option>
			<option value="kids" <?php if ("kids" === $order->type()) echo "selected"; ?>>Деца</option>
		</select>
		<select name="category_id">
    	<?php 
    	   foreach ($categories as $category) {
    	?>
    			<option value="<?php echo $category->id(); ?>" <?php if ($category->id() == $order->categoryId()) echo "selected"; ?>><?php echo $category->name(); ?></option>
    	<?php
    		}
    	?>
		</select>
		<textarea form="update-product-form" name="description" placeholder="Описание" value="<?php echo $order->description(); ?>"></textarea>
		<input type="number" step="0.01" name="price" value="<?php echo $order->price(); ?>" />
		<input type="number" step="0.01" value="0" name="promotional_price" value="<?php echo $order->promotionalPrice(); ?>" />
		<select name="available_sizes[]" multiple="multiple">
    		<option value="XS" <?php if ($order->hasSize("XS")) echo "selected"; ?>>XS</option>
    		<option value="S" <?php if ($order->hasSize("S")) echo "selected"; ?>>S</option>
    		<option value="M" <?php if ($order->hasSize("M")) echo "selected"; ?>>M</option>
    		<option value="L" <?php if ($order->hasSize("L")) echo "selected"; ?>>L</option>
    		<option value="XL" <?php if ($order->hasSize("XL")) echo "selected"; ?>>XL</option>
    		<option value="XXL" <?php if ($order->hasSize("XXL")) echo "selected"; ?>>XXL</option>
		</select>
		<input class="images" type="file" name="productimage[]"><button class="more"><i class="fas fa-plus"></i></button>
		<input type="submit" />
	</form>

	<script>
		debugger;

		$(".more").on("click", function() {
			var iFileInputsCount = $("input[name='productimage[]'").length;
			if (iFileInputsCount >= 5) {
				return false;
			}

			$("<input type='file' name='productimage[]'>").insertAfter(".images");

			return false;
		});
	</script>
</html>