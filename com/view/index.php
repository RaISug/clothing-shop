<DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="UTF-8"/>
		
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/common.css" />
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/header/header.css" />
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/carousel/carousel.css" />
		<link rel="stylesheet" href="http://localhost/com.radoslav.web.shop/com/view/home/home.css" />

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">	
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	</head>

	<body>

		<div class="fillParent">
            <?php
                include_once 'com/view/header/header.php';
                include_once 'com/view/carousel/carousel.php';
                include_once 'com/view/home/home.php';
                include_once 'com/view/footer/footer.php';
            ?>

    		<script src="http://localhost/com.radoslav.web.shop/com/view/header/header.js"></script>
    		<script src="http://localhost/com.radoslav.web.shop/com/view/carousel/carousel.js"></script>
    		<script src="http://localhost/com.radoslav.web.shop/com/view/home/home.js"></script>
		</div>
	</body>
</html>
