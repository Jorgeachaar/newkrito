<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalService  {

	private $_api_context;

	function __construct()
	{
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function getString()
	{
		return "api";
	}

	public function paymentByPayPal(String $description, User $user, Array $cart)
	{
		$payerInfo = new PayerInfo();
		$payerInfo->setEmail($user->email);
		$payerInfo->setExternalRememberMeId($user->id);
		$payerInfo->setFirstName($user->name);
		$payerInfo->setLastName($user->name);
		$payerInfo->setphone($user->phone);

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$payer->setPayerInfo($payerInfo);

		$items = array();
		$subtotal = 0;
		$currency = 'EUR';

		foreach ($cart as $product) {
			$item = new Item();
			$item->setName($product['name'])
			->setSku($product['id'])
			->setCurrency($currency)
			->setDescription($product['name'])
			->setQuantity($product['qty'])
			->setPrice($product['price']);
 
			$items[] = $item;
			$subtotal += $product['qty'] * $product['price'];
		}

		$item_list = new ItemList();
		$item_list->setItems($items);
 
		$details = new Details();
		$details->setSubtotal($subtotal);
		// ->setShipping(0); //COSTO DE ENVIO
 
		$total = $subtotal + 0;

		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription($description);
 
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
		} catch(Exception $ex) {
		}
 
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
 
		return \Redirect::route('cart-show')
			->with('message', 'Ups! Error desconocido.');
	}

	public function payPalCallBack($token, $payerId)
	{
		$payment_id = Session::get('paypal_payment_id');
		// $payment_id = $request->input('paymentId');
 
		if (empty($payerId) || empty($token)) {
			return \Redirect::route('index')
				->with('message', 'Have a problem with Paypal, please try again later.');
		}
 
		$payment = Payment::get($payment_id, $this->_api_context);

		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);
 
		$result = $payment->execute($execution, $this->_api_context);
 
		if ($result->getState() == 'approved') {
 
			$newOrder = $this->saveOrder($payment);

			// Mail::to('krito.love.forever@gmail.com', 'Web KritoLove - New Order!!!')
   //          ->send(new NewOrder($newOrder));

            $users = User::where('role', 'admin')->get();
            Notification::send($users, new NewOrder($newOrder));
 
 			Cart::destroy();

			Session::forget('paypal_payment_id');
			
			return \Redirect::route('index')
				->with('message', 'The purchase was successful!! =)');
		}


		return \Redirect::route('index')
			->with('message', 'The sale was canceled');
	}

	function saveOrder($payment) {
    	
    	$user = Auth::check() ? Auth::user()->id : null;

    	$order = Order::create([
			'user_id' => $payment->getPayer()->getExternalRememberMeId(),
			'payment_id' => $payment->id,
			'name' => $payment->getPayer()->getFirstName(),
			'email' => $payment->getPayer()->getEmail(),
			'phone' => Session::get('paypal_payment_phone', ''),
			'address' => '',
			'subtotal' => $payment->transactions[0]->amount->total,
    	]);	

    	foreach (Cart::content() as $product) {
			$item = new OrderItem;
			$item->order_id = $order->id;
			$item->product_id = $product->id;
			$item->qty = $product->qty;
			$item->price = $product->price;
 
			$item->save();
		}

		return $order;
    }
	
}