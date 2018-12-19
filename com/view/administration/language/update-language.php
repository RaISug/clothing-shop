<?php

use service\InternationalizationService;

include_once 'com/view/administration/header.php';

$language = $response->entity();

$internationalizationService = new InternationalizationService($language->name());

?>
    <div style="margin-top: 100px" >
    	
    	<div id="success-alert" class="alert alert-primary" role="alert">
        	Текста намиращ се в полето "Имена на полета и съобщения ... " трябва да бъде преведен спрямо 
        	новосъздадения език.
        </div>
    	
    	<form id="language-form" action="<?php echo $response->serverContext(); ?>/administration/languages/api/v1/language/<?php echo $language->id(); ?>" method="POST">
          	<input type="hidden" name="_method" value="PUT" />
          	<input type="hidden" name="id" value="<?php echo $language->id(); ?>" />
          	
    		<div class="form-group row">
    			<label for="name" class="col-sm-2 col-form-label">Име на езика (моля въведете име с две латински букви)</label>
    			<input class="col-sm-10 form-control" id="name" type="text" name="name" value="<?php echo $language->name(); ?>">
    		</div>

			<div class="form-group row">
            	<label for="is_default" class="col-sm-3 col-form-label">Език по подразбиране</label>
        		<input type="checkbox" class="col-sm-8 form-control" name="is_default" id="is_default" value="<?php if ($language->isDefault() === 1) { echo "on"; } ?>"/>
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
    			<button type="submit" class="btn btn-primary col-sm-6 offset-sm-4">Промени</button>
        	</div>
    	</form>
    </div>

<?php 

    include_once 'com/view/administration/footer.php';

?>