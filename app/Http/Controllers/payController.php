<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;


class payController extends Controller
{
    public function goPay(){
        return view('data.payment');
    }

    public function payment()
    {
        $data = [];
        $data['items'] = [
            [
                'name'=>'Huawei',
                'price'=> 240,
                'description'=>'nova 3i 6 inch',
                'qty'=> 1,
            ]
        ];
        $data['invoice_id'] = 1;
        $data['invoice_description'] = 'Order Invoice';
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('cancel');
        $data['total'] = 240;

        $provider = new ExpressCheckout();
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data,True);
        return redirect($response['paypal_link']);

    }

    public function cancel()
    {
        dd("you are cancel this payment");
    }


    public function success(Request $request)
    {
        $provider = new ExpressCheckout();
        $response = $provider->getExpressCheckoutDetails($request->token);

        if(in_array(strtoupper($response['ACK']), ['SUCCESS','SUCCESSWITHWARNING'] ))
        {
            dd('your payment was succefully');
        }

        dd('Please Try again later...');
        
    }

}
