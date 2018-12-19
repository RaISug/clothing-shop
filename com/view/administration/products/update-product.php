<?php 

    include_once 'com/view/administration/header.php';

    $product = $response->entity();

    $categories = $response->supportingEntity("categories");
    $languages = $response->supportingEntity("languages");

?>
	<div style="margin-top: 80px">

		<form id="create-product-form" action="<?php echo $response->serverContext(); ?>/administration/products/api/v1/product/<?php echo $product->id(); ?>" method="POST" enctype="multipart/form-data">
      		<input type="hidden" name="_method" value="PUT" />
			<input type="hidden" name="id" value="<?php echo $product->id(); ?>" />
			
			<div class="form-group row">
            	<label for="name" class="col-sm-2 col-form-label">Име на продукта</label>
            	<input type="text" name="name" class="col-sm-10 form-control" value="<?php echo $product->name(); ?>" id="name" placeholder="Име на продукта">
          	</div>
          	
          	<div class="form-group row">
        		<label for="type" class="col-sm-2 col-form-label">Тип</label>
        		<select name="type" class="col-sm-10 form-control" id="type">
        			<option value="male" <?php if ("male" === $product->type()) echo "selected"; ?>>Мъже</option>
        			<option value="female" <?php if ("female" === $product->type()) echo "selected"; ?>>Жени</option>
        			<option value="kids" <?php if ("kids" === $product->type()) echo "selected"; ?>>Деца</option>
        		</select>
          	</div>
        
          	<div class="form-group row">
            	<label for="category" class="col-sm-2 col-form-label">Категория</label>
        		<select class="col-sm-10 form-control" name="category_id" id="category">
            	<?php 
            		foreach ($categories as $category) {
            	?>
            			<option value="<?php echo $category->id(); ?> <?php if ($category->id() == $product->categoryId()) echo "selected"; ?>"><?php echo $category->name(); ?></option>
            	<?php
            		}
            	?>
        		</select>
    		</div>
    	
    		<div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Описание</label>
    			<textarea class="col-sm-10 form-control" form="create-product-form" id="description" name="description" placeholder="Описание"><?php echo $product->description(); ?></textarea>
    		</div>
    		
    		<div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Цена</label>
    			<input id="price" class="col-sm-10 form-control" type="number" min="0" step="0.01" value="<?php echo $product->price(); ?>" name="price" />
    		</div>
    	
    		<div class="form-group row">
                <label for="promotional_price" class="col-sm-2 col-form-label">Промоционална цена</label>
    			<input id="promotional_price" class="col-sm-10 form-control" type="number" min="0" step="0.01" value="<?php echo $product->promotionalPrice(); ?>" name="promotional_price" />
    		</div>
    
    		<div class="form-group row">
                <label for="size" class="col-sm-2 col-form-label">Размери</label>
        		<select id="size" class="col-sm-10 form-control" name="available_sizes[]" multiple="multiple">
            		<option value="XS" <?php if ($product->hasSize("XS")) echo "selected"; ?>>XS</option>
            		<option value="S" <?php if ($product->hasSize("S")) echo "selected"; ?>>S</option>
            		<option value="M" <?php if ($product->hasSize("M")) echo "selected"; ?>>M</option>
            		<option value="L" <?php if ($product->hasSize("L")) echo "selected"; ?>>L</option>
            		<option value="XL" <?php if ($product->hasSize("XL")) echo "selected"; ?>>XL</option>
            		<option value="XXL" <?php if ($product->hasSize("XXL")) echo "selected"; ?>>XXL</option>
        		</select>
    		</div>
    		
    		<div class="form-group row">
                <label for="language" class="col-sm-2 col-form-label">Език</label>
    			<select name="language_id" class="col-sm-10 form-control" id="language">

        			<?php 
        			foreach ($languages as $language) {
        			    ?>
        			    <option value="<?php echo $language->id(); ?>" <?php if ($product->languageId() == $language->id()) { echo "selected"; } ?>><?php echo $language->name(); ?></option>
        			    <?php
        			}
        			?>
    				
    			</select>
			</div>
			
    		<div class="form-group row">
    			<input class="col-sm-3 form-control-file images" type="file" name="productimage[]">
    		</div>
    
    		<div class="form-group row">
    			<button class="col-sm-6 offset-sm-3 form-control btn btn-success more" type="submit">
    				Добави още снимки
    			</button>
    		</div>
    		
    		<div class="form-group">
    			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-3">Промени</button>
        	</div>
    
        </form>

	</div>
	<script>
		debugger;

		$(".more").on("click", function() {
			var iFileInputsCount = $("input[name='productimage[]'").length;
			if (iFileInputsCount >= 5) {
				return false;
			}

			$("<input class='col-sm-2 form-control-file' type='file' name='productimage[]'>").insertAfter(".images");

			return false;
		});
	</script>
	
<?php 

    include_once 'com/view/administration/footer.php';

?>