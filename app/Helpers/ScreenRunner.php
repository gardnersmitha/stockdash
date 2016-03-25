<?php

namespace app\Helpers;

use Log;
use App\Helpers\Contracts\ScreenRunnerContract;
use Curl\Curl as Curl;
use App\Instance as Instance;
use App\Symbol as Symbol;

//TODO - make camel case variable names snake case for consistency.

class ScreenRunner implements ScreenRunnerContract
{

	protected $defer = true;

	protected $startScreensUrl = "https://api.apifier.com/v1/iZfmBeHRjjoy3yeuS/crawlers/Finviz/execute?token=4EY4R3e5djBWBiapzf3zxJSYc";

	protected $fetchScreenResultsUrl = 'https://api.apifier.com/v1/iZfmBeHRjjoy3yeuS/crawlers/Finviz?token=reZcs5KaFJSbTdBnPsP7y56DB';


	public function startScreens()
	{
		$curl = new Curl;

		$curl->get($this->startScreensUrl);

		if ($curl->error) {

		    Log::info('Screener run initation failed: '.$curl->error_code);
		    return;
		}
		else {

			Log::info('Screener run successfully intiated');
		    return;
		}
	}

	public function fetchScreenResults()
	{

		$curl = new Curl;

		//Get our metadata
		$curl->get($this->fetchScreenResultsUrl);

		if ($curl->error) {

		    Log::info('Screener fetch failed: '.$curl->error_code);
		    return;
		}
		else {

			Log::info('Screener processed');

			$screenMetaData = json_decode($curl->response);

			$lastRunResultsUrl = $screenMetaData->lastExecution->resultsUrl;

			$resultsCurl = new Curl;

			$resultsCurl->get($lastRunResultsUrl);

			$this->processScreenResults($resultsCurl->response);

			Log::info('Most recent results URL: '.$lastRunResultsUrl);

		    return;
		}
	}

	public function processScreenResults($screen_response)
	{
		//dd(json_decode($screen_response));
		$screen_response = json_decode($screen_response);
		$screen_symbols = array();

		foreach ($screen_response as $page) {

			$page_symbols = $page->pageFunctionResult;

			array_push($screen_symbols, $page_symbols);

		}

		$screen_symbols  = collect(array_collapse($screen_symbols));

		$screen_instances = $screen_symbols->map(function($screen_symbol){
			
			$instance = new Instance;
			$symbol = new Symbol;

			//Transform to an instance
			$symbol = $symbol->firstOrCreate(['symbol' => $screen_symbol->symbol]);
			$instance->source_type = 'screener';
			$instance->source_name = $screen_symbol->source_name;

			//Save new instances
			$symbol->instances()->save($instance);

			return $instance;

		});

		return($screen_instances);
	}

}