<?php

abstract class Meal {

	protected static $tax = 1.1;
	public $number;


	public function __construct($number) {

		if (!empty($number)) {
			$this->number = $number;
		} else {
			$this->number = 0;
		}

	}

	public function setConstruct($regular_number, $big_number) {
		self::__construct((int)$regular_number + (int)$big_number);
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

	public function calculatePrice() {
		return $this->price * self::$tax * $this->number;
	}

	public function displayMenu() {
			echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3 ml-3">$this->name&emsp;{$this->price}円</label>
	<span class="pl-5">個数：</span><input type="number" class="form-control col-1" name=$this->input_name min="0">
</div>
EOM;


	}

	public function displayOrder() {
			echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3">$this->name &emsp;{$this->price}円</span>
	<span class="col-1">&emsp;×$this->number</span>
	<span>{$this->calculatePrice()}円</span>
</div>
EOM;

	}

}
