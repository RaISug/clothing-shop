<DOCTYPE html>
<html>

    <div>
    	<form
    		action="<?php echo $response->serverContext(); ?>/administration/users/api/v1" method="POST">
    		<input type="text" name="username" />
    		<input type="password" name="password" />
    		<input type="text" name="firstname" />
    		<input type="text" name="lastname" /> 
    		<input type="submit" />
    	</form>
    </div>

</html>