<?php 

namespace App\Helpers\Contracts;
use App\Instance as Instance;

Interface ScreenRunnerContract

{

	public function runScreens();

	public function processScreens($screenResponse);
	
}