<?php 

    include_once 'com/view/administration/header.php';

    $languages = $response->supportingEntity("languages");

?>
    <div style="margin-top: 100px" >
    	<form id="carousel-form" action="<?php echo $response->serverContext(); ?>/administration/categories/api/v1" method="POST">
          	
    		<div class="form-group row">
    			<label for="name" class="col-sm-2 col-form-label">Техническо име (моля попълни на латиница)</label>
    			<input class="col-sm-10 form-control" id="name" type="text" name="name">
    		</div>
          	
          	<div class="form-group row">
    			<label for="display_name" class="col-sm-2 col-form-label">Име което ще вижда потребителя</label>
    			<input class="col-sm-10 form-control" id="display_name" type="text" name="display_name">
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

    		<div class="form-group">
    			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-3">Създай</button>
        	</div>
    	</form>
    </div>

<?php 

    include_once 'com/view/administration/footer.php';

?>