<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;
use Image;
use Carbon\Carbon;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
class GatewayController extends Controller
{
    public function show()
        {
        	$gateways = Gateway::all();

            if(is_null($gateways))
            {
                $default=[
                    'gateimg' => 'paypal.png',
                    'name' => 'PayPal',
                    'minamo' => '100',
                    'maxamo' => '100000',
                    'fixed_charge' => '10',
                    'percent_charge' => '11',
                    'rate' => '21',
                    'val1' => 'JHuiqejhkjq',
                    'val2' => '24897HHd',
                    'status' => '1'
                ];

                Gateway::create($default);
                $gateways = Gateway::all();
            }
        	$page_title = "Gateway";
        	return view('admin.deposit.gateway', compact('gateways','page_title'));

        }


         public function addnew(Request $request)
    {
          $basic = GeneralSettings::first();
        if ($basic->demo == 1) {
				return back()->with('alert', 'You are not allowed to make changes to the demo script. Please make a purchase!'); }


        $this->validate($request, [
            'name' => 'required',
            'slogan' => 'required',
            'min' => 'required',
            'max' => 'required',
            'fixed' => 'required',
            'percent' => 'required',
            'type' => 'required',
            'details' => 'required',
        ]);

        $gateway['main_name'] = $request->name;
        $gateway['name'] = $request->slogan;
        $gateway['minamo'] = $request->min;
        $gateway['maxamo'] = $request->max;
        $gateway['fixed_charge'] = $request->fixed;
        $gateway['percent_charge'] = $request->percent;

        if($request->type == 1){
        $gateway['coin'] = 1;
        }
        else
        {
        $gateway['coin'] = 0;
        }
        $gateway['val1'] = $request->details;
        $gateway['status'] = 1;
        Gateway::create($gateway);


            return back()->with('success', 'Payment Gateway Added Successfully!');



    }

    public function update(Request $request)
    {
          $basic = GeneralSettings::first();
        if ($basic->demo == 1) {
				return back()->with('alert', 'You are not allowed to make changes to the demo script. Please make a purchase!'); }

        $gateway = Gateway::findorFail($request->id);
        $this->validate($request, [
            'gateimg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'name' => 'required',
            'val1' => 'nullable',
            'val2' => 'nullable',
            'val3' => 'nullable',
            'val4' => 'nullable',
            'val5' => 'nullable',
            'val6' => 'nullable',
            'val7' => 'nullable',
            'status' => 'nullable'
        ]);
        if($request->hasFile('gateimg'))
        {
            $npath = 'assets/images/gateway/'.$gateway->id.'.jpg';
            Image::make($request->gateimg)->resize(800, 800)->save($npath);
        }

        $gateway['name'] = $request->name;
        $gateway['rate'] = $request->rate;
        $gateway['minamo'] = $request->minamo;
        $gateway['maxamo'] = $request->maxamo;
        $gateway['fixed_charge'] = $request->chargefx;
        $gateway['percent_charge'] = $request->chargepc;
        $gateway['val1'] = $request->val1;
        $gateway['val2'] = $request->val2;
        $gateway['val3'] = $request->val3;
        $gateway['val4'] = $request->val4;
        $gateway['val5'] = $request->val5;
        $gateway['val6'] = $request->val6;
        $gateway['val7'] = $request->val7;
        $gateway['status'] = $request->status;
        $res = $gateway->save();

        if ($res) {
            return back()->with('success', 'Payment Gateway Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Gateway');
        }


    }
       public function act($id)
    {
        $gateway = Gateway::findorFail($id);


        $gateway['status'] = 1;
        $res = $gateway->save();

        if ($res) {
            return back()->with('success', 'Payment Gateway Activated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Gateway');
        }


    }

          public function deact($id)
    {
        $gateway = Gateway::findorFail($id);


        $gateway['status'] = 0;
        $res = $gateway->save();

        if ($res) {
            return back()->with('success', 'Payment Gateway Deactivated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Gateway');
        }


    }
}
