<?php 

namespace App\Helpers\Contracts;
use App\Instance as Instance;

Interface ScreenRunnerContract

{

	public function startScreens();

	public function fetchScreenResults();

	public function processScreenResults($screenResponse);
	
}