<?php

class Sauce {

	protected static $tax = 1.1;
	public $number;

	public function __construct($number){

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

}
