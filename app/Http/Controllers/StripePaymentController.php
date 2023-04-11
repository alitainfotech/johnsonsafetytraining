<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Orderproduct;
use App\Models\Avilabledate;
use App\Models\Calendar;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Mail\StudentMail;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('user.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(StoreCustomerRequest $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $cart = session('cart');
            if ($cart == null) {
                Session::flash('error', 'Cart is Empty');
                return back();
            }
            $prod_id = array_column($cart, 'id');
            $availableId = (array_column($cart, 'availableId'));
            $availableId = decrypt($availableId[0]);

            $available = Avilabledate::where('id',$availableId)->first();
            
            foreach ($cart as $carts) {
                $total = array_sum(array_column($cart, 'price'));
            }

            $customer = $stripe->customers->create(array(
                'name' => $request->firstname,
                'description' => 'test description',
                'email' => $request->email,
                'source' => $request->stripeToken,
                "address" => [
                    "line1" => $request->custaddress,
                    "city" => $request->custcity,
                    "postal_code" => $request->custzipcode
                ]
            ));

            $paymentMethodAPI =  $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            $paymentMethodResponse = json_decode(json_encode($paymentMethodAPI));
            $paymentMethodCardType = "pm_" . strtolower($paymentMethodResponse->type) . "_" . strtolower($paymentMethodResponse->card->brand);
            $payment = $stripe->paymentIntents->create([
                'customer' => $customer['id'],
                'amount' => $total * 100,
                'currency' => 'USD',
                'description' => 'test description',
                'payment_method' => $paymentMethodCardType,
                'payment_method_types' => ['card'],
                'metadata' => ['integration_check'=>'accept_a_payment'],
                'confirm' => true,
            ]);
                
            if ($payment->status == "succeeded") {
                $user_check = User::select('id', 'email', 'address')->where('email', $request->email)->first();
                $rand_pass = '';
                if ($user_check == null) {
                    $rand_pass = Str::random(10);
                    $user = User::create([
                        'full_name' => $request->firstname . ' ' . $request->lastname,
                        'lastname' => $request->lastname,
                        'user_name' => $request->firstname,
                        'gender' => $request->gender,
                        'address' => $request->custaddress,
                        'phone' => $request->phone,
                        'date_of_birth' => $request->date_of_birth,
                        'town_of_birth' => $request->town_of_birth,
                        'country_of_birth' => $request->country_of_birth,
                        'zipcode' => $request->custzipcode,
                        'city' => $request->custcity,
                        'state' => $request->state,
                        'email' => $request->email,
                        'password' => Hash::make($rand_pass),
                        'types' => "1",
                    ]);

                    
                } else {
                    $user = $user_check;
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'payment_id' => $payment->id,
                    'total' => $total,
                    'address' => $request->custaddress,
                    'available_id' => $availableId,
                ]);

                Invoice::create([
                    'companyname' => $request->companyname,
                    'order_id' => $order->id,
                    'lastname' => $request->lastname,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'custaddress' => $request->custaddress,
                    'custzipcode' => $request->custzipcode,
                    'custcity' => $request->custcity,
                ]);

                Payment::create([
                    'order_id' => $order->id,
                ]);


                foreach ($prod_id as $prod) {
                    Orderproduct::create([
                        'order_id' => $order->id,
                        'product_id' => $prod,
                        'user_id' => $user->id,
                    ]);
                }
                $start_at = '';
                $product_id = 0;
                if(!empty($available)){
                    $start_at = $available->start_at;
                    $product_id = $available->product_id;
                }

                $event = new Calendar;
                $event->type = '1';
                $event->type_id = $product_id;
                $event->title = "Course Event";
                $event->start_at = $start_at;
                $event->location = $request->custaddress;
                // $event->duration_type = 0;
                $event->is_repeat = '1';
                $event->status = '1';
                $event->save();

                if ($user->email) {
                    $user['password'] = $rand_pass;
                    $user['url'] = route('user.enrolment',[encrypt($user->id),encrypt($order->id)]);
                    Mail::to($request->email)->send(new StudentMail($user));
                }
                
                session()->forget('cart');
                // session()->save();
                // Session::flash('success', 'Payment successful!');
                return redirect(route('user.enrolment',[encrypt($user->id),encrypt($order->id)]))->with(['type' => 'success', 'message' => 'Registration successfully. Please fill the enrolment form']);
            } else {
                Session::flash('error', 'Payment failed');
                return back();
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back()->withInput();
        }
    }
}