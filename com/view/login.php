<DOCTYPE html>
<html>

	<div>
	
		<form action="<?php echo $response->serverContext(); ?>/login" method="POST">
			<input type="text" name="username" />
			<input type="password" name="password" />
			<input type="submit" />
		</form>
	
	</div>

</html>