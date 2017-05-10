<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use URL;
use Session;
use Redirect;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Dashboard\Payment\Customer;
/*
* PayPal
*/
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

class PaypalController extends Controller
{
    private $_api_context;
    public function __construct()
    {


        // setup PayPal api context
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
//
//        parent::__construct();
    }

    public function postPaypalPayment(Request $request)
    {
        $payee = new Payer();
        $payee->setPaymentMethod('Paypal');

        $donation_1 = new Item();
        $donation_1->setName('Donation 1')
                   ->setCurrency('CAD')
                   ->SetQuantity(1)
                   ->setPrice($request->amount);
        $donation_list = new ItemList();
        $donation_list->setItems(array($donation_1));
        $amount = new Amount();
        $amount->setCurrency('CAD')
               ->setTotal($request->amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($donation_list)
            ->setDescription('Make a donation to charity of choice');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('admin.paypal.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('admin.paypal.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payee)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('donations');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('donations');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        /** add requests to session **/
        Session::put('team_id', $request->team_id);
        Session::put('user_id', $request->user_id);
        Session::put('user_message', $request->comment);
        Session::put('event_id', $request->event_id);



        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return Redirect::route('admin.donations');
    }

         public function getPaypalSatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** Get Request before session clears**/
        $team_id = Session::get('team_id');
        $user_id = Session::get('user_id');
        $event_id = Session::get('event_id');
        $comment = Session::get('user_message');


        /** Clear the session  **/
        Session::forget('paypal_payment_id');
        Session::forget('user_id');
        Session::forget('event_id');
        Session::forget('user_message');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('admin.donations');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {
            /** Loop Through Transaction **/
            foreach($result->transactions as $transaction)
            {
                $total_amount = $transaction->amount->total;
            }
            /** it's all right **/
            /** Database logic  **/
            $customer = new Customer;
            $customer->team_id = $team_id;
            $customer->user_id = $user_id;
            $customer->event_id = $event_id;
            $customer->name = $result->payer->payer_info->first_name.' '.$result->payer->payer_info->last_name;
            $customer->email = $result->payer->payer_info->email;
            $customer->address = $result->payer->payer_info->shipping_address->line1;
            $customer->city = $result->payer->payer_info->shipping_address->city;
            $customer->postal = $result->payer->payer_info->shipping_address->postal_code;
            $customer->comment = $comment;
            $customer->stripe_id = $result->payer->payer_info->payer_id;
            $customer->payment_type = $result->payer->payment_method;
            $customer->balance_transaction = $result->id;
            $customer->amount = $total_amount;

            $customer->save();

            /**
                * Send Email to Customer and Admin using mailable.
                */

                /**
                * Send Email to Admin using notification.
                */

             if($customer)
            {
              $event_total = Customer::where('team_id', $customer->team_id)->get();
              // ->orwhere('team_id', $customer->team_id)

               \DB::table('totals')
              ->where('event_id',  $customer->event_id)
              ->update(['total_donations' => $event_total->sum('amount')]);
            }

            \Session::put('success','Paypal Payment Successful');
            return Redirect::route('admin.donations');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('admin.dashboard');
    }

}
