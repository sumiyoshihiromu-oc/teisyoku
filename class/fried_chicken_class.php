<?php

require_once 'meal_class.php';
require_once 'chili_sauce_class.php';
require_once 'grated_radish_sauce_class.php';
require_once 'wasabi_soy_sauce.php';

class FriedChicken extends Meal {

	public $price = 900;
	public $name = '唐揚げ定食';
	public $input_name = 'fried_number';

	public $sauces = [];

	public function __construct($number, $chili_number, $grated_radish_number, $wasabi_number) {
		parent::__construct($number);

		$chili = new ChiliSauce($chili_number);
		$grated_radish = new GratedRadishSauce($grated_radish_number);
		$wasabi = new WasabiSoySauce($wasabi_number);
		$this->sauces = [$chili, $grated_radish, $wasabi];
	}

	public function displaySauceMenu() {

		foreach ($this->sauces as $sauce) {
			echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<label class="col-3 text-right">$sauce->name&emsp;{$sauce->price}円</label>
	<span>個数：</span><input type="number" class="form-control col-1" name=$sauce->input_name min="0">
</div>
EOM;

		}

	}

	public function displaySauceOrder() {

		foreach ($this->sauces as $sauce) {
			echo <<<EOM
<div class="form-group row align-items-center justify-content-center">
	<span class="col-3 text-right">$sauce->name &emsp;{$sauce->price}円</span>
	<span class="col-1">&emsp;×<?php echo $sauce->number ?></span>
	<span><?php echo number_format($sauce->price) ?>円</span>
</div>
EOM;
		}

	}

}
