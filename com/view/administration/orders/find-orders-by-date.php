<?php

include_once 'com/view/administration/header.php';

?>
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
		<form action="<?php echo $response->serverContext(); ?>/administration/orders/api/v1">
    		<div class="form-group row">
            	<label for="date" class="col-sm-3 col-form-label">Дата на поръчка</label>
        		<input type="date" class="col-sm-9 form-control" name="date" id="date" />
          	</div>

          	<div class="form-group row">
            	<label for="show_processed" class="col-sm-3 col-form-label">Обработени поръчки</label>
        		<input type="checkbox" class="col-sm-8 form-control" name="show_processed" id="show_processed"/>
          	</div>

    		<div class="form-group">
    			<button type="submit" class="btn btn-primary col-sm-4 offset-sm-5">Търси</button>
        	</div>
    	</form>
    </div>

<?php 

    include_once 'com/view/administration/footer.php';

?>
