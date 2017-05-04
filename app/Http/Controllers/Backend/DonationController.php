<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Stripe;
use Stripe\Error\Card;
use App\Models\Dashboard\Payment\Customer;
use App\Notifications\DonationMade;
use App\Models\Dashboard\Total;
use App\Models\Dashboard\Event;
use Auth;


class DonationController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $team_id = Auth::user()->currentTeam->id;
        $customers = Customer::orderBy('id','desc')->where('user_id', $id)->take(5)->get();
        $team_donations = Customer::orderBy('id','desc')->where('team_id', $team_id)->simplePaginate(5);

          return view('backend.donations.index', compact('customers','team_donations'));
//        $event = Event::all();
//        return $event;
//


    }

    public function collect(Request $request, Customer $customers)
    {


        $stripe = Stripe::make(env('STRIPE_SECRET'), '2016-07-06');
        try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request->get('cardNumber'),
                        'exp_month' => $request->get('cardExpiryMonth'),
                        'exp_year'  => $request->get('cardExpiryYear'),
                        'cvc'       => $request->get('cardCVC'),
                        'name'      => $request->get('name')

                    ],
                ]);

                if (!isset($token['id'])) {
                    \Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->back();
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'CAD',
                    'amount'   => $request->input('amount'),
                    'receipt_email' => $request->input('email'),
                ]);

                if($charge['status'] == 'succeeded') {

                    $customer = new $customers;
                    $customer->team_id = $request->team_id;
                    $customer->user_id = $request->user_id;
                    $customer->event_id = 5;
                    $customer->name = $request->name;
                    $customer->email = $request->email;
                    $customer->address = $request->address;
                    $customer->city = $request->city;
                    $customer->postal = $request->postal;
                    $customer->comment = $request->comment;
                    $customer->stripe_id = $charge['id'];
                    $customer->balance_transaction = $charge['balance_transaction'];
                    $customer->amount = $request->amount;
                    $customer->last_four = $charge['source']['last4'];
                    $customer->save();
                    /**
                    * Send Email to Customer and Admin using mailable.
                    */

                    /**
                    * Send Email to Admin using notification.
                    */


                    if($customer)
                    {
                      $event_total = Customer::orderBy('id','desc')->where('team_id', $customer->team_id)->get();

                      \DB::table('totals')
                      ->where('event_id',  $customer->event_id)
                      ->update(['total_donations' => $event_total->sum('amount')]);
                    }


                    \Session::put('success','Donation was successful');
                    return redirect()->back();
                } else {
                    \Session::put('error','Donation was unsuccessful!!');
                    return redirect()->back();
                }
            /**
            * Start to Catch Errors
            */
             } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }

    }
}



//                           $sum = $customers->sum('amount');
//        $total = 0;
//        $total += $customers->amount;
 //       $entry->view_count = $entry->view_count +1;
//        dd($sum);
