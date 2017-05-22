<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

//USUARUI De PRUEBA
// jorgeachaar-buyer@gmail.com
// secret321
class PayPalController extends Controller
{
	private $_api_context;

	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

    public function sendPayPal()
    {
    	$payer = new Payer();
		$payer->setPaymentMethod('paypal');
 
		$items = array();
		$subtotal = 0;
		$cart = \Session::get('cart');
		$currency = 'EUR';
 
		foreach (Cart::content() as $product) {
			$item = new Item();
			$item->setName($product->name)
			->setCurrency($currency)
			->setDescription($product->name)
			->setQuantity($product->qty)
			->setPrice($product->price);
 
			$items[] = $item;
			$subtotal += $product->qty * $product->price;
		}
 
		$item_list = new ItemList();
		$item_list->setItems($items);
 
		$details = new Details();
		$details->setSubtotal($subtotal)
		->setShipping(100); //COSTO DE ENVIO
 
		$total = $subtotal + 100;
 
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);
 
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Pedido de prueba en mi Laravel App Store');
 
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));
 
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
 
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Ups! Algo salió mal');
			}
		}
 
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
 
		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
 
		return \Redirect::route('cart-show')
			->with('message', 'Ups! Error desconocido.');;
    }

    public function paymentStatus(Request $request)
    {
		$payment_id = \Session::get('paypal_payment_id');

		//\Session::forget('paypal_payment_id');
 
		$payerId = $request->input('PayerID');
		$token = $request->input('token');
 
		if (empty($payerId) || empty($token)) {
			return \Redirect::route('index')
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}
 
		$payment = Payment::get($payment_id, $this->_api_context);

 
		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);
 
		$result = $payment->execute($execution, $this->_api_context);
 
		if ($result->getState() == 'approved') {
 
			// $this->saveOrder();
 
 			Cart::destroy();

			\Session::forget('cart');
 
			return \Redirect::route('index')
				->with('message', 'Compra realizada de forma correcta');
		}

		return \Redirect::route('index')
			->with('message', 'La compra fue cancelada');
    }
}
