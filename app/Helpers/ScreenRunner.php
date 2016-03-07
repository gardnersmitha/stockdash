<?php

namespace app\Helpers;

use Log;
use App\Helpers\Contracts\ScreenRunnerContract;
use Curl\Curl as Curl;
use App\Instance as Instance;
use App\Symbol as Symbol;

class ScreenRunner implements ScreenRunnerContract
{

	protected $defer = true;


	public function runScreens()
	{

		$curl = new Curl;

		//Firebase
		$screen_url = "https://ags-kimono.firebaseio.com//kimono/api/35bdu1uw/latest.json?auth=VKh5rXMRpnmqDwea6eKvsLUZKGEuJ9CxFIUHdZdQ";
		
		//Kimonolabs.com
		// $screen_url = "https://www.kimonolabs.com/api/8274ypaa?apikey=2ondRRZjyBiPoBdmrDQCqMAUSLOfR8Pn";


		$curl->get($screen_url);


		if ($curl->error) {

		    Log::info('Screener fetch failed: '.$screen_url.$curl->error_code);
		    return $curl->error_code;
		}
		else {

			Log::info('Screener processed: '.$screen_url);
		    return $this->processScreens($curl->response);
		}


	}

	public function processScreens($screen_response)
	{

		$screen_response = json_decode($screen_response);

		$screen_tickers = collect($screen_response->results->symbols);

		$screen_instances = $screen_tickers->map(function($screener_symbol){
			
			$instance = new Instance;
			$symbol = new Symbol;

			//Transform to an instance
			$symbol = $symbol->firstOrCreate(['symbol' => $screener_symbol->symbol->text]);
			$instance->source_type = 'screener';
			$instance->source_name = 'Finviz New Highs on 2x Volume';

			//Save new instances
			$symbol->instances()->save($instance);

			return $instance;

		});

		return($screen_instances);
	}

}