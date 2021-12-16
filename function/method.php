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
