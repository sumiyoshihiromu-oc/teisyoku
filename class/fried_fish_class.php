<?php

require_once 'meal_class.php';
require_once '../interface/large_serving_interface.php';

class FriedFish extends Meal implements LargeServingInterface {

	public $price = 1000;
	public $name = '魚フライ定食';
	public $regular_number;
	public $big_number;
	public $input_name = 'fried_fish_number';

	public function __construct($regular_number, $big_number) {
		parent::__construct((int)$regular_number + (int)$big_number);
		if (!empty($regular_number)) {
			$this->regular_number = $regular_number;
		} else {
			$this->regular_number = 0;
		}
		if (!empty($big_number)) {
			$this->big_number = $big_number;
		} else {
			$this->big_number = 0;
		}
	}


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

	public function displayOrder() {
		$regular_rice_price = number_format(self::calculateEachPrice($this->regular_number));
		$big_rice_price = number_format(self::calculateEachPrice($this->big_number));
		echo <<< EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3">$this->name &emsp;ご飯普通 &emsp;{$this->price}円</span>
	<span class="col-1">&emsp;×$this->regular_number</span>
	<span>{$regular_rice_price}円</span>
</div>
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3">$this->name &emsp;ご飯大盛 &emsp;{$this->price}円</span>
	<span class="col-1">&emsp;×$this->big_number</span>
	<span>{$big_rice_price}円</span>
</div>
EOM;
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

	public function RegularAndBigRiceOrder() {
		// TODO: Implement RegularAndBigRiceOrder() method.
	}
	public function calculateEachPrice($number) {
		return $this->price * $number * self::$tax;
	}

}
