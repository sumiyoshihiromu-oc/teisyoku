<?php

function displayLargeServingOomori($is_large_serving) {
	echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3"></span>
	<span class="col-1"></span>
	<span class="mr-2 ml-3">$is_large_serving</span>
</div>
EOM;
}

function doublePoints(LargeServingInterface $menu) {
	echo $menu->name . "のポイント2倍" . '<br>';
}

function RegularAndBigRiceOrder() {
	echo <<< EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3">$this->name &emsp;ご飯大盛 &emsp;{$this->price}円</span>
	<span class="col-1">&emsp;×$this->number</span>
	<span>{$this->calculatePrice()}円</span>
</div>

EOM;
}
