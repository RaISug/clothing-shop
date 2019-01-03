<?php 

    use service\InternationalizationService;

    include_once 'com/view/administration/header.php';

    $request = $response->request();
    $internationalizationService = new InternationalizationService();

?>
    <div style="margin-top: 100px" >
    	
    	<?php
  		if ($request->getQueryParameter("operation-create") === "succeed") {
  	        ?>
  	        	<div id="success-alert" class="alert alert-success" role="alert">
                	Успешно създадохте езика.
                </div>
  	        <?php
  	    }
        ?>

    	<div id="success-alert" class="alert alert-primary" role="alert">
        	Текста намиращ се в полето "Имена на полета и съобщения ... " трябва да бъде преведен спрямо 
        	новосъздадения език.
        </div>
    	
    	<form id="language-form" action="<?php echo $response->serverContext(); ?>/administration/languages/api/v1" method="POST">
          	
    		<div class="form-group row">
    			<label for="name" class="col-sm-2 col-form-label">Име на езика (моля въведете име с две латински букви)</label>
    			<input class="col-sm-10 form-control" id="name" type="text" name="name">
    		</div>

			<div class="form-group row">
            	<label for="is_default" class="col-sm-3 col-form-label">Език по подразбиране</label>
        		<input type="checkbox" class="col-sm-8 form-control" name="is_default" id="is_default"/>
          	</div>

			<div class="form-group row">
    			<label for="name" class="col-sm-2 col-form-label">Имена на полета и съобщения, които ще бъдат видяни от потребителите</label>
    			<textarea rows="15" class="col-sm-10 form-control" id="bundle" form="language-form" name="bundle"><?php 
    				    $properties = $internationalizationService->loadProperties();
    				    foreach ($properties as $key => $value) {
    				        echo $key . " = \"" . $value . "\"\n";
    				    }
    				?></textarea>
    		</div>

    		<div class="form-group">
    			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-4">Създай</button>
        	</div>
    	</form>
    </div>

<?php 

    include_once 'com/view/administration/footer.php';

?>