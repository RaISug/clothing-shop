<DOCTYPE html>
<html>

	<div>
		<form action="<?php echo $response->serverContext()?>/orders/api/v1" method="POST">
			<input type="text" name="user_first_name" placeholder="firstname"/>
			<input type="text" name="user_last_name" placeholder="lastname" />
			<input type="email" name="email" placeholder="email" />
			<input type="text" name="phone" placeholder="phone" />
			<input type="text" name="address" placeholder="address" />
			<input type="text" name="comment" placeholder="comment" />
			<input type="submit" />
		</form>
	</div>

</html>