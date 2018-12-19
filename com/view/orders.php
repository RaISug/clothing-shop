<?php

    use service\InternationalizationService;

    include_once 'header.php';

    $request = $response->request();
    
    $internationalizationService = new InternationalizationService($response->language());

    if ($request->getQueryParameter("order") === "succeed") {
        ?>
        <div class="container" style="margin-top: 100px" >
            <div class="alert alert-success" role="alert">
            	<?php echo $internationalizationService->get("order_view_confirmation_message"); ?>
            </div>
        </div>
        <?php
    } else {
        ?>
    	<div class="container" style="margin-top: 100px" >
    		<div style="text-align: center"><h3><?php echo $internationalizationService->get("order_view_finish_your_order_label"); ?></h3></div>
        	<form id="order-form" action="<?php echo $response->serverContext(); ?>/orders/api/v1" method="POST">
              	
              	<div class="form-group row">
                    <label for="user_first_name" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_name_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="user_first_name" name="user_first_name" placeholder="Име"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="user_last_name" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_family_name_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="user_last_name" name="user_last_name" placeholder="Фамилия"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_email_label"); ?></label>
                    <input class="col-sm-10 form-control" type="email" id="email" name="email" placeholder="имейл@домейн.ком"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_phone_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="phone" name="phone" placeholder="Телефон"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_address_label"); ?></label>
                    <input class="col-sm-10 form-control" type="text" id="address" name="address" placeholder="Адрес"/>
        		</div>
              	
              	<div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label"><?php echo $internationalizationService->get("order_view_user_comment_label"); ?></label>
        			<textarea class="col-sm-10 form-control" form="order-form" id="comment" name="comment" placeholder="Коментар"></textarea>
        		</div>
        		
        		<div class="form-group">
        			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-4"><?php echo $internationalizationService->get("order_view_order_button_text"); ?></button>
            	</div>
        	</form>
        </div>
		<?php
    }
    
    include_once 'footer.php';

?>