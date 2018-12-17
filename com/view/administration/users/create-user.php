<?php 

    include_once 'com/view/administration/header.php';

?>
    <div style="margin-top: 100px" >
    	<form action="<?php echo $response->serverContext(); ?>/administration/users/api/v1" method="POST">
    		<div class="form-group row">
            	<label for="username" class="col-sm-3 col-form-label">Входно име на потребителя</label>
        		<input type="text" class="col-sm-9 form-control" name="username" id="username" placeholder="Входно име на потребителя"/>
          	</div>
          	
          	<div class="form-group row">
            	<label for="password" class="col-sm-3 col-form-label">Парола на потребителя</label>
        		<input type="password" class="col-sm-9 form-control" name="password" id="password" placeholder="Парола на потребителя"/>
          	</div>
          	
          	<div class="form-group row">
            	<label for="firstname" class="col-sm-3 col-form-label">Име на потребителя</label>
        		<input type="text" class="col-sm-9 form-control" name="firstname" id="firstname" placeholder="Име на потребителя"/>
          	</div>
          	
          	<div class="form-group row">
            	<label for="lastname" class="col-sm-3 col-form-label">Фамилия на потребителя</label>
        		<input type="text" class="col-sm-9 form-control" name="lastname" id="lastname" placeholder="Фамилия на потребителя"/>
          	</div>

    		<div class="form-group">
    			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-3">Създай</button>
        	</div>
    	</form>
    </div>

<?php 

    include_once 'com/view/administration/footer.php';

?>