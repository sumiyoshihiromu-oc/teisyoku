<?php

ini_set("error_reporting", E_ALL);

require_once '../class/fried_chicken_class.php';
require_once '../class/chicken_nanban_class.php';
require_once '../class/curry_class.php';
require_once '../class/chili_sauce_class.php';
require_once '../class/grated_radish_sauce_class.php';
require_once '../class/wasabi_soy_sauce.php';

$fried_chicken = new FriedChicken($_POST['fried_number'], $_POST['chili_number'], $_POST['grated_radish_number'], $_POST['wasabi_soy_number']);
$chicken_nanban = new ChickenNanban($_POST['nanban_number']);
$curry = new Curry($_POST['curry_number']);
$orders = [$fried_chicken, $chicken_nanban, $curry];

$today = (new DateTimeImmutable())->format('Y年m月d日 H:i');

function displaySumPrice($sum) {
    echo <<<EOM
<div class="text-center mt-5">
    <h2>合計：$sum&emsp;円(税込)</h2>
</div>
EOM;

}

?>

<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>定食オーダー</title>
</head>
<body class="bg-light">
<div class="container">
	<div class="text-center mt-5">
		<h1>レシート</h1>
	</div>
	<div>
        <div class="text-center mb-5">
            <small><?php echo $today ?></small>
        </div>
        <?php
		$menu_sum_price = 0;
		foreach ($orders as $order) {
			$order->displayOrder();
			$menu_sum_price += $order->calculatePrice();
		}
		$sum = $menu_sum_price + $fried_chicken->getSauceSumPrice();
		displaySumPrice(number_format($sum));
        ?>
        <div class="text-center mt-5">
            <button type="button" class="btn btn-info btn-lg" onclick="location.href='./order.php'">注文しなおす</button>
        </div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
