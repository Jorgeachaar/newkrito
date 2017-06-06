<?php

namespace App\Services;

use PayPal\Api\ItemList;
use PayPal\Api\Payer;

class PayPalService  {

	private $api;

	function __construct()
	{
		$this->api = 'Hola';
	}

	public function getString()
	{
		return $this->api;
	}

	public function payment(String $description, Payer $payer, ItemList $item)
	{
		# code...
	}
	
}