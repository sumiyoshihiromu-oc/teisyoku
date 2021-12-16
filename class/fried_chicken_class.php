<?php

require_once 'meal_class.php';
require_once 'chili_sauce_class.php';
require_once 'grated_radish_sauce_class.php';
require_once 'wasabi_soy_sauce.php';
require_once '../interface/large_serving_interface.php';
require_once '../function/method.php';

class FriedChicken extends Meal implements LargeServingInterface {

	public $price = 900;
	public $name = '唐揚げ定食';
	public $regular_number;
	public $big_number;
	public $input_name = 'fried_number';

	public $sauces = [];

	public function __construct($regular_number, $big_number, $chili_number = null, $grated_radish_number = null, $wasabi_number = null) {
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

		$chili = new ChiliSauce($chili_number);
		$grated_radish = new GratedRadishSauce($grated_radish_number);
		$wasabi = new WasabiSoySauce($wasabi_number);
		$this->sauces = [$chili, $grated_radish, $wasabi];
	}

	public function displayMenu() {
		echo <<< EOM
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3 pl-5">$this->name&emsp;{$this->price}円</label>
	<span>ご飯普通個数：</span><input type="number" class="form-control col-1" name={$this->input_name}_regular min="0" v-model={$this->input_name}_regular>
</div>
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3"></label>
	<span>ご飯大盛個数：</span><input type="number" class="form-control col-1" name={$this->input_name}_big min="0" v-model={$this->input_name}_big>
</div>
EOM;
		foreach ($this->sauces as $sauce) {
			echo <<<EOM
<div class="form-group row align-items-center justify-content-center" v-if="{$this->input_name}_regular > 0 || {$this->input_name}_big > 0">
	<label class="col-3 text-right ml-5 mr-3">$sauce->name&emsp;{$sauce->price}円</label>
	<span>個数：</span><input type="number" class="form-control col-1" name=$sauce->input_name min="0">
</div>
EOM;
		}

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

		foreach ($this->sauces as $sauce) {
			echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3 text-right">$sauce->name &emsp;{$sauce->price}円</span>
	<span class="col-1">&emsp;×$sauce->number</span>
	<span>{$sauce->calculatePrice()}円</span>
</div>
EOM;
		}
	}

	public function getSauceSumPrice() {
		$sum_sauce_price = 0;
		foreach ($this->sauces as $sauce) {
			$sum_sauce_price += $sauce->calculatePrice();
		}
		return $sum_sauce_price;
	}

	public function displayLargeServingOptions() {
		echo <<<EOM
<div class="form-group row align-items-center justify-content-center" v-if="fried_number_regular > 0 || fried_number_big > 0">
	<label class="col-3"></label>
	<sapn><input class="mr-2 ml-3" type="checkbox" name="{$this->input_name}_large_serving">大盛</sapn>
</div>
EOM;

	}

	public function displayLargeServingReceipt() {
		displayLargeServingOomori($this->is_large_serving);
	}

	public function RegularAndBigRiceOrder() {
		RegularAndBigRiceOrder();
	}

	public function calculateEachPrice($number) {
		return $this->price * $number * self::$tax;
	}
}
