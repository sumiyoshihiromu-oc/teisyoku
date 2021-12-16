<?php

require_once 'meal_class.php';
require_once '../interface/large_serving_interface.php';

class FriedFish extends Meal implements LargeServingInterface {

	public $price = 1000;
	public $name = '魚フライ定食';
	public $input_name = 'fried_fish_number';

	public function displayMenu() {
		echo <<< EOM
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3 pl-5">$this->name&emsp;{$this->price}円</label>
	<span>ご飯普通個数：</span><input type="number" class="form-control col-1" name={$this->input_name}_regular min="0">
</div>
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3"></label>
	<span>ご飯大盛個数：</span><input type="number" class="form-control col-1" name={$this->input_name}_big min="0">
</div>
EOM;
		self::displayLargeServingOptions();
	}

	public function displayLargeServingOptions() {
		echo <<< EOM
<div class="form-group row align-items-center justify-content-center" v-if="{$this->input_name} > 0">
	<label class="col-3"></label>
	<sapn><input class="mr-2 ml-3" type="checkbox" name="{$this->input_name}_large_serving">大盛</sapn>
</div>
EOM;

	}

	public function displayLargeServingReceipt()
	{
		echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3"></span>
	<span class="col-1"></span>
	<span class="mr-2 ml-3">※$this->is_large_serving</span>
</div>
EOM;
	}

}
