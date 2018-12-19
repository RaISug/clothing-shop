<?php 

    include_once 'com/view/administration/header.php';

    $languages = $response->supportingEntity("languages");

?>
    <div style="margin-top: 100px" >
    	<form id="carousel-form" action="<?php echo $response->serverContext(); ?>/administration/carousels/api/v1" method="POST" enctype="multipart/form-data">
          	
    		<div class="form-group row">
    			<input class="col-sm-3 form-control-file" type="file" name="carouselimage">
    		</div>
    	
    		<div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Описание</label>
    			<textarea class="col-sm-10 form-control" form="carousel-form" id="description" name="description" placeholder="Описание"></textarea>
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