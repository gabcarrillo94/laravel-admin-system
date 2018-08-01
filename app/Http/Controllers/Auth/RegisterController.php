<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Automattic\WooCommerce\Client; 
use Automattic\WooCommerce\HttpClient\HttpClientException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $woocommerce = new Client('http://foreverfitbylv.com/',
                         'ck_38cecaa0bf15480e2a33da7c594ac04786c15ef1',
                         'cs_ca3650a5742271146668e89a7373b7c76185532c',
                         ['wp_api' => true, 'version' => 'wc/v1',]);
            
        $orders = $woocommerce->get('orders');
        $rule = '';
        
        foreach($orders as $key => $order) {
            $rule = $rule.''.$order->id.',';
        }
        
        return Validator::make($data, [
            'product_code' => 'required|max:255|unique:users|in:'.$rule,
            'birthdate' => 'required',
            'sex' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $woocommerce = new Client('http://foreverfitbylv.com/',
                         'ck_38cecaa0bf15480e2a33da7c594ac04786c15ef1',
                         'cs_ca3650a5742271146668e89a7373b7c76185532c',
                         ['wp_api' => true, 'version' => 'wc/v1',]);
        
        $orderURL = 'orders/'.$data['product_code'];
            
        $orders = array($woocommerce->get($orderURL));
        
        foreach($orders as $key => $order) {
            $data['first_name'] = $order->billing->first_name;
            $data['last_name'] = $order->billing->last_name;
            $data['address'] = $order->billing->address_1.", ".$order->billing->address_2.". City: ".$order->billing->city.". State: ".$order->billing->state;
            $data['phone'] = $order->billing->phone;
            
            foreach($order->line_items as $item) {
                $data['program'] = $item->name;
            }
        }
        
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'product_code' => $data['product_code'],
            'program' => $data['program'],
            'body_type' => '',
            'whatsapp' => $data['whatsapp'],
            'instagram' => $data['instagram'],
            'sex' => $data['sex'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'type' => 'USER',
            'register' => 'FALSE',
            'password' => bcrypt($data['password']),
        ]);
    }
}
