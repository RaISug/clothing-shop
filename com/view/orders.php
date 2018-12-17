<?php

    include_once 'header.php';

    if ($response->statusCode() === 201) {
        ?>
        <div class="container" style="margin-top: 100px" >
            <div class="alert alert-success" role="alert">
            	Благодаря за направената поръчка! Веднага след като я обработим, ще се свържем с Вас.
            </div>
        </div>
        <?php
    } else {
        ?>
    	<div class="container" style="margin-top: 100px" >
    		<div style="text-align: center"><h3>Завършете вашата поръчка</h3></div>
        	<form id="order-form" action="<?php echo $response->serverContext(); ?>/orders/api/v1" method="POST">
              	
              	<div class="form-group row">
                    <label for="user_first_name" class="col-sm-2 col-form-label">Име</label>
                    <input class="col-sm-10 form-control" type="text" id="user_first_name" name="user_first_name" placeholder="Име"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="user_last_name" class="col-sm-2 col-form-label">Фамилия</label>
                    <input class="col-sm-10 form-control" type="text" id="user_last_name" name="user_last_name" placeholder="Фамилия"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Имейл</label>
                    <input class="col-sm-10 form-control" type="email" id="email" name="email" placeholder="имейл@домейн.ком"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Телефон</label>
                    <input class="col-sm-10 form-control" type="text" id="phone" name="phone" placeholder="Телефон"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Адрес</label>
                    <input class="col-sm-10 form-control" type="text" id="address" name="address" placeholder="Адрес"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label">Коментар</label>
        			<textarea class="col-sm-10 form-control" form="order-form" id="comment" name="comment" placeholder="Коментар"></textarea>
        		</div>
        		
        		<div class="form-group">
        			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-4">Поръчай</button>
            	</div>
        	</form>
        </div>
		<?php
    }
    
    include_once 'footer.php';

?>