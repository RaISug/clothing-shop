<DOCTYPE html>
<html>

	<head>
	   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	</head>
	<?php 

	   $categories = $response->supportingEntity("categories");

	?>

	<form action="<?php echo $response->serverContext(); ?>/administration/products/api/v1" method="POST" enctype="multipart/form-data">
		<input type="text" name="name" />
		<select name="type">
			<option value="male">Мъже</option>
			<option value="female">Жени</option>
			<option value="kids">Деца</option>
		</select>
		<select name="category_id">
    	<?php 
    		foreach ($categories as $category) {
    	?>
    			<option value="<?php echo $category->id(); ?>"><?php echo $category->name(); ?></option>
    	<?php
    		}
    	?>
		</select>
		<input type="number" step="0.01" name="price" />
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