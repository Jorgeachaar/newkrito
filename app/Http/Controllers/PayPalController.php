<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

//USUARIO De PRUEBA
// jorgeachaar-buyer@gmail.com
// secret321

// PAYPAL_CLIENT_ID=AV2eEMCSovZTGM0IpWbA8hSYIzwSDHGjrVUMH5D80vnWqNOm2vjV2ezI9Aj5lPyuieqdhUMKMppf4S2y
// PAYPAL_APP_SECRET=EHlTkjaMiskiYlDMRGpzIdjd4cUA0U0XVMvL8wT5Hh6Yunku9XwC1BvQDWObQnovzetKTXRuiF4Z71PQ
// PAYPAL_MODE=sandbox
// http://paypal.github.io/PayPal-PHP-SDK/
// http://paypal.github.io/PayPal-PHP-SDK/sample/

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
		Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
 
		return \Redirect::route('cart-show')
			->with('message', 'Ups! Error desconocido.');;
    }

    public function paymentStatus(Request $request)
    {
		$payment_id = Session::get('paypal_payment_id');

		Session::forget('paypal_payment_id');
 
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

			return \Redirect::route('index')
				->with('message', 'Compra realizada de forma correcta');
		}

		return \Redirect::route('index')
			->with('message', 'La compra fue cancelada');
    }

    public function paymentRegister()
    {
    	$payer = new Payer();
		$payer->setPaymentMethod('paypal');
 
		$items = array();
		$subtotal = 0;
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
			->setDescription('KritoLove Register - User ' . Session::get('email_register'));
 
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.register.status'))
			->setCancelUrl(\URL::route('payment.register.status'));
 
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
 
		Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			return \Redirect::away($redirect_url);
		}
 
		return \Redirect::route('cart-show')
			->with('message', 'Ups! Error desconocido.');
    }

    public function paymentRegisterStatus(Request $request)
    {
    	DB::beginTransaction();
    	try {
	    	$payment_id = Session::get('paypal_payment_id');

			// Session::forget('paypal_payment_id');
	 
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
	 
	 			$user = $this->createUser();
	 			$this->createOrder($user, $payment);

	 			Cart::destroy();

				DB::commit();
				return \Redirect::route('index')
					->with('message', 'Logined!!!');
			}


			return \Redirect::route('index')
				->with('message', 'Your order not was approved');
    		
    	} catch (Exception $e) {
    		DB::rollBack();
    	}    	
    }

    private function createUser()
    {
		$name = Session::pull('email_register');
    	$email = Session::pull('name_register');
    	$password = Session::pull('pass_register');
    	$plan = Session::pull('plan_register');

    	$user = User::create([
    		'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
    	]);

    	$this->createProfile($user, $plan);
        
        Auth::login($user);

        return $user; 
    }

    private function createProfile(User $user, $plan)
    {
    	switch ($plan) {
            case '1':
                $years = 1;
                break;
            case '2':
                $years = 2;
                break;
            case '3':
                $years = 5;
                break;
            default:
                $years = 0;
                break;
        }

    	$user->profile()->create([
            'user_id' => $user->id,
            'plan' => $plan,
            'start_plan' => Carbon::now(),
            'end_plan' => Carbon::now()->addYears($years),
        ]);
    }

    private function createOrder(User $user, $payment)
    {
    	$order = Order::create([
			'user_id' => $user->id,
			'cart_paypal' => $payment->cart,
			'name' => $user->name,
			'email' => $user->email,
			'phone' => '',
			'address' => '',
			'subtotal' => $payment->transactions[0]->amount->total,
    	]);
    }


}
