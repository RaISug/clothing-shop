<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="<?php echo $response->serverContext(); ?>/../com/external/libraries/ui/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $response->serverContext(); ?>/../com/external/libraries/ui/jquery/jquery-3.3.1.min.js" ></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	
	<link href="<?php echo $response->serverContext(); ?>/../com/view/administration/products/manage-products.css" rel="stylesheet">
	<link href="<?php echo $response->serverContext(); ?>/../com/view/cart.css" rel="stylesheet">
	
  </head>

  <body>

    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?php echo $response->serverContext(); ?>/administration">Администрация</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 	 Поръчки
              	</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/orders/by/date">Търсене на поръчка по зададена дата</a>
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/orders/between/datetimes">Търсене на поръчка между часови интервал</a>
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/orders/api/v1">Всички</a>
                </div>
			</li>
            
            <li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 	 Продукти
              	</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/products/create">Създаване</a>
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/products/api/v1">Изтриване / Промяна</a>
                </div>
			</li>
            
            <li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 	 Потребители
              	</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/users/create">Създаване</a>
                </div>
			</li>
			
            
            <li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 	 Каросел
              	</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/carousels/create">Създаване</a>
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/carousels/api/v1">Изтриване</a>
                </div>
			</li>
			
			<li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 	 Категории
              	</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/categories/create">Създаване</a>
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/categories/api/v1">Изтриване</a>
                </div>
			</li>
			
			<li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 	 Колекции
              	</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/collections/create">Създаване</a>
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/collections/add/products">Добавяне на елементи</a>
                  <a class="dropdown-item" href="<?php echo $response->serverContext(); ?>/administration/collections/api/v1">Изтриване</a>
                </div>
			</li>

          </ul>
        </div>
      </nav>
    </header>

    <main role="main">

      <div class="container">
		
