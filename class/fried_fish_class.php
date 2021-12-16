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
		parent::setConstruct($regular_number, $big_number);
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

	public function calculateEachPrice($number) {
		return $this->price * $number * self::$tax;
	}

}
