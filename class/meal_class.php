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

	public function calculatePrice() {
		return $this->price * self::$tax * $this->number;
	}

	public function displayMenu() {
		echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3">$this->name&emsp;{$this->price}円</label>
	<span>個数：</span><input type="number" class="form-control col-1" name=$this->input_name min="0">
</div>
EOM;

	}

	public function displayMenuWithOptions() {
		echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3">$this->name&emsp;{$this->price}円</label>
	<span>個数：</span><input type="number" class="form-control col-1" name=$this->input_name min="0" v-model="number">
</div>
EOM;

	}

	public function displayOrder() {
		if (get_class($this) == 'FriedChicken') {
			$this->displayFriedOrder();
		} else {
			echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3">$this->name &emsp;{$this->price}円</span>
	<span class="col-1">&emsp;×$this->number</span>
	<span>{$this->calculatePrice()}円</span>
</div>
EOM;
		}

	}

}
