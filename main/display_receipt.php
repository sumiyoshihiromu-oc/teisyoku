<?php

ini_set("error_reporting", E_ALL);

require_once '../class/fried_chicken_class.php';
require_once '../class/chicken_nanban_class.php';
require_once '../class/curry_class.php';
require_once '../class/chili_sauce_class.php';
require_once '../class/grated_radish_sauce_class.php';
require_once '../class/wasabi_soy_sauce.php';

$fried_chicken = new FriedChicken($_POST['fried_number'], $_POST['chili_number'], $_POST['grated_radish_number'], $_POST['wasabi_soy_number']);
$fried_chicken_price = $fried_chicken->calculatePrice();
$fried_chicken_number = $fried_chicken->number;

if ($_POST['fried_number'] > 0) {
	$chili = new ChiliSauce($_POST['chili_number']);
	$chili_price = $chili->calculatePrice();
	$chili_number = $chili->number;

	$grated_radish = new GratedRadishSauce($_POST['grated_radish_number']);
	$grated_radish_price = $grated_radish->calculatePrice();
	$grated_radish_number = $grated_radish->number;

	$wasabi_soy = new WasabiSoySauce($_POST['wasabi_soy_number']);
	$wasabi_soy_price = $wasabi_soy->calculatePrice();
	$wasabi_soy_number = $wasabi_soy->number;
}

$chicken_nanban = new ChickenNanban($_POST['nanban_number']);
$chicken_nanban_price = $chicken_nanban->calculatePrice();
$chicken_nanban_number = $chicken_nanban->number;

$curry = new Curry($_POST['curry_number']);
$curry_price = $curry->calculatePrice();
$curry_number = $curry->number;

$menu_sum_price = 0;

$orders = [$fried_chicken, $chicken_nanban, $curry];
foreach ($orders as $order) {
	$order->displayOrder();
	$menu_sum_price += $order->calculatePrice();
}

$sum = $menu_sum_price + $fried_chicken->getSauceSumPrice();
displaySumPrice(number_format($sum));

var_dump($sum);

if ($_POST['fried_number'] > 0) {
	$sum_price = $fried_chicken_price + $chicken_nanban_price + $curry_price + $chili_price + $grated_radish_price + $wasabi_soy_price;
} else {
	$sum_price = $fried_chicken_price + $chicken_nanban_price + $curry_price;
}

function displaySumPrice($sum) {
    echo <<<EOM
<div class="text-center mt-5">
    <h2>合計：$sum&emsp;円(税込)</h2>
</div>
EOM;

}

$today = (new DateTimeImmutable())->format('Y年m月d日 H:i');

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
        <div class="form-group row align-items-center justify-content-center">
            <span class="col-3">唐揚げ定食 &emsp;900円</span>
            <span class="col-1">&emsp;×<?php echo $fried_chicken_number ?></span>
            <span><?php echo number_format($fried_chicken_price) ?>円</span>
        </div>
        <?php if ($fried_chicken_number > 0) { ?>
        <div class="form-group row align-items-center justify-content-center">
            <span class="col-3 text-right">チリソース &emsp;50円</span>
            <span class="col-1">&emsp;×<?php echo $chili_number ?></span>
            <span><?php echo number_format($chili_price) ?>円</span>
        </div>
        <div class="form-group row align-items-center justify-content-center">
            <span class="col-3 text-right">大根おろしソース &emsp;100円</span>
            <span class="col-1">&emsp;×<?php echo $grated_radish_number ?></span>
            <span><?php echo number_format($grated_radish_price) ?>円</span>
        </div>
        <div class="form-group row align-items-center justify-content-center">
            <span class="col-3 text-right">わさび醤油 &emsp;50円</span>
            <span class="col-1">&emsp;×<?php echo $wasabi_soy_number ?></span>
            <span><?php echo number_format($wasabi_soy_price) ?>円</span>
        </div>
        <?php } ?>
        <div class="form-group row align-items-center justify-content-center">
            <span class="col-3">チキン南蛮定食 &emsp;1000円</span>
            <span class="col-1">&emsp;×<?php echo $chicken_nanban_number ?></span>
            <span><?php echo number_format($chicken_nanban_price) ?>円</span>
        </div>
        <div class="form-group row align-items-center justify-content-center">
            <span class="col-3">カレー定食 &emsp;750円</span>
            <span class="col-1">&emsp;×<?php echo $curry_number ?></span>
            <span><?php echo number_format($curry_price) ?>円</span>
        </div>
        <div class="text-center mt-5">
            <h2>合計：<?php echo number_format($sum_price) ?>&emsp;円(税込)</h2>
        </div>
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
