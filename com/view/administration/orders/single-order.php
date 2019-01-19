<?php

include_once 'com/view/administration/header.php';

?>

    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
  		<?php
    		$order = $response->entity();
        ?>

  		Статус: <?php if ($order->isProcessed() == 0) { echo "Не обработена"; } else { echo "Обработена"; } ?><br>
  		Дата: <?php echo $order->orderDate(); ?><br>
  		Име на потребителя: <?php echo $order->userFirstName() . " " . $order->userLastName(); ?><br>
  		Адрес: <?php echo $order->address(); ?><br>
  		Имейл: <?php echo $order->email(); ?><br>
  		Коментар: <?php echo $order->comment(); ?><br>
    </div>

	<div class="container cart" style="margin-top: 30px; margin-bottom: 30px; padding: 30px; background-color: white; border: 1px solid #d1d1d1;">
		<table>
			<tr>
				<th>Продукт</th>
				<th style="text-align: center">Размер</th>
				<th style="text-align: center;">Количество</th>
				<th style="text-align: center">Цена</th>
			</tr>
			<?php
			$products = $order->products();

			$amount = 0;
			foreach ($products as $product) {
			?>
			
    			<tr>
    				<td class="cart-product">
    					<div>
    						<div class="cart-image">
    							<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>">
    								<img src="<?php echo $response->serverContext(); ?>/../images/<?php echo $product->getFirstImageName(); ?>" />
    							</a>
    						</div>
    						<div class="cart-detail">
    							<a href="<?php echo $response->serverContext(); ?>/products/api/v1/product/<?php echo $product->id(); ?>" class="cart-detail-link"><?php echo $product->name(); ?></a>
    						</div>
    					</div>
    				</td>
    				<td>
    					<div style="text-align: center">
    						<?php echo $product->size(); ?>
    					</div>
    				</td>
    				<td class="cart-product-quantity" style="text-align: center;">
    					<div style="display: inline;">
							<div style="display: inherit;">
	                			<?php echo $product->quantity(); ?>
							</div>                			
    					</div>
    				</td>
    				<td style="text-align: center">
    					<strong>
							<?php
								if ($product->promotionalPrice() == 0) {
								    echo $product->price(); 
								} else {
		     					    ?>
			
									<b><?php echo $product->promotionalPrice(); ?> лв.</b><sup style="color: red"><del><?php echo $product->price(); ?>лв.</del></sup>
			
									<?php
								}
							?>
						</strong>
    				</td>
    			</tr>
			
			<?php
			     $price = $product->promotionalPrice() == 0 ? $product->price() : $product->promotionalPrice();
			     $amount += $price * $product->quantity();
			}
			?>
		</table>
		
		<div style="margin-top: 25px; min-width: 100%; background-color: #5a5a5a; color: white; height: 55px; border-radius: 3px;">
			<div style="margin-right: 25px; padding-top: 10px; float: right;">
				Общо: <b style="font-size: 22px;"><?php echo $amount; ?></b> лв.
			</div>
		</div>
	</div>

<?php 

    include_once 'com/view/administration/footer.php';

?>
