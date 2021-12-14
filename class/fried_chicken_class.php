<?php

require_once 'meal_class.php';
require_once 'chili_sauce_class.php';

class FriedChicken extends Meal {

	public $price = 900;
	public $name = '唐揚げ定食';
	public $input_name = 'fried_number';

	public $sauces = [];

}
