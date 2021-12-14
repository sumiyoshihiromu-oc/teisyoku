<?php

require_once '../class/fried_chicken_class.php';
require_once '../class/chicken_nanban_class.php';
require_once '../class/curry_class.php';

$fried_chicken = new FriedChicken(0);
$chicken_nanban = new ChickenNanban(0);
$curry = new Curry(0);
$menu = [$fried_chicken, $chicken_nanban, $curry];
var_dump($menu);

foreach ($menu as $m) {
	$m->displayMenu();
}

?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.6/dist/vue.js"></script>

    <title>定食オーダー</title>
</head>
<body class="bg-light">
<div class="container" id="app">
    <div class="text-center mt-5 mb-5">
        <h1>ご注文</h1>
    </div>
    <div>
        <form action="display_receipt.php" method="post">
            <div class="form-group row align-items-center justify-content-center">
                <label for="fried_chicken" class="col-3">唐揚げ定食&emsp;900円</label>
                <span>個数：</span><input type="number" class="form-control col-1" id="fried_chicken" name="fried_number" min="0" v-model="number">
            </div>
            <div class="form-group row align-items-center justify-content-center" v-if="number > 0">
                <label for="chili_sauce" class="col-3 text-right">チリソース&emsp;50円</label>
                <span>個数：</span><input type="number" class="form-control col-1" id="chili_sauce" name="chili_number" min="0">
            </div>
            <div class="form-group row align-items-center justify-content-center" v-if="number > 0">
                <label for="grated_radish_sauce" class="col-3  text-right">大根おろしソース&emsp;100円</label>
                <span>個数：</span><input type="number" class="form-control col-1" id="grated_radish_sauce" name="grated_radish_number" min="0">
            </div>
            <div class="form-group row align-items-center justify-content-center" v-if="number > 0">
                <label for="wasabi_soy_sauce" class="col-3  text-right">わさび醤油&emsp;50円</label>
                <span>個数：</span><input type="number" class="form-control col-1" id="wasabi_soy_sauce" name="wasabi_soy_number" min="0">
            </div>
            <div class="form-group row align-items-center justify-content-center">
                <label for="chicken_nanban" class="col-3">チキン南蛮定食&emsp;1000円</label>
                <span>個数：</span><input type="number" class="form-control col-1" name="nanban_number" id="chicken_nanban" min="0">
            </div>
            <div class="form-group row align-items-center justify-content-center">
                <label for="curry" class="col-3">カレー定食&emsp;750円</label>
                <span>個数：</span><input type="number" class="form-control col-1" name="curry_number" id="curry" min="0">
            </div>
            <p class="text-danger text-center">※表示はすべて税抜き価格です。</p>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-info btn-lg">注文する</button>
            </div>
        </form>
    </div>
</div>

<script>
    new Vue({
        el: '#app',
        data: {
            number: ''
        }
    })
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
