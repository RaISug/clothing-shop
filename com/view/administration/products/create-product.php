<?php 

    include_once 'com/view/administration/header.php';

    $categories = $response->supportingEntity("categories");
    $languages = $response->supportingEntity("languages");
?>

	<div style="margin-top: 80px">
	
        <form id="create-product-form" action="<?php echo $response->serverContext(); ?>/administration/products/api/v1" method="POST" enctype="multipart/form-data">
      		<div class="form-group row">
            	<label for="name" class="col-sm-2 col-form-label">Име на продукта</label>
            	<input type="text" name="name" class="col-sm-10 form-control" id="name" placeholder="Име на продукта">
          	</div>
          	
          	<div class="form-group row">
        		<label for="type" class="col-sm-2 col-form-label">Тип</label>
        		<select name="type" class="col-sm-10 form-control" id="type">
        			<option value="male">Мъже</option>
        			<option value="female">Жени</option>
        		</select>
          	</div>
        
          	<div class="form-group row">
            	<label for="category" class="col-sm-2 col-form-label">Категория</label>
        		<select class="col-sm-10 form-control" name="category_id" id="category">
            	<?php 
            		foreach ($categories as $category) {
            	?>
            			<option value="<?php echo $category->id(); ?>"><?php echo $category->name(); ?></option>
            	<?php
            		}
            	?>
        		</select>
    		</div>
    	
    		<div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Описание</label>
    			<textarea class="col-sm-10 form-control" form="create-product-form" id="description" name="description" placeholder="Описание"></textarea>
    		</div>
    		
    		<div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Цена</label>
    			<input id="price" class="col-sm-10 form-control" type="number" min="0" step="0.01" value="0" name="price" />
    		</div>
    	
    		<div class="form-group row">
                <label for="promotional_price" class="col-sm-2 col-form-label">Промоционална цена</label>
    			<input id="promotional_price" class="col-sm-10 form-control" type="number" min="0" step="0.01" value="0" name="promotional_price" />
    		</div>
    
    		<div class="form-group row">
                <label for="size" class="col-sm-2 col-form-label">Размери</label>
        		<select id="size" class="col-sm-10 form-control" name="available_sizes[]" multiple="multiple">
        			<option value="XS">XS</option>
        			<option value="S">S</option>
        			<option value="M">M</option>
        			<option value="L">L</option>
        			<option value="XL">XL</option>
        			<option value="XXL">XXL</option>
        		</select>
    		</div>
    		
    		<div class="form-group row">
                <label for="language" class="col-sm-2 col-form-label">Език</label>
    			<select name="language_id" class="col-sm-10 form-control" id="language">

        			<?php 
        			foreach ($languages as $language) {
        			    ?>
        			    <option value="<?php echo $language->id(); ?>"><?php echo $language->name(); ?></option>
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
    			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-3">Създай</button>
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