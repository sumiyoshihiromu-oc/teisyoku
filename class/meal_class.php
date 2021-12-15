<?php

abstract class Meal {

	protected static $tax = 1.1;
	public $number;


	public function __construct($number) {

		$this->price = $this->price * self::$tax;
		if (!empty($number)) {
			$this->number = $number;
		} else {
			$this->number = 0;
		}

	}

	public function calculatePrice() {
		return $this->price * $this->number;
	}

	public function getNumber() {
		return $this->number;
	}

	public function displayMenu() {
		echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3">$this->name&emsp;{$this->price}円</label>
	<span>個数：</span><input type="number" class="form-control col-1" name=$this->input_name min="0">
</div>
EOM;

	}

}
