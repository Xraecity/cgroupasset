<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use App\Giftcard;
use App\Package;
use App\Gateway;
use App\Giftcardtype;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;

class GiftcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function package()
    {
        $data['page_title'] = 'Manage Packages';
        $data['currency'] = Package::orderBy('price','desc')->get();
        return view('admin.packages.index', $data);
    }

   public function index()
    {
        $data['page_title'] = 'Manage Giftcard';
        $data['currency'] = Giftcard::orderBy('name','asc')->get();
        return view('admin.giftcard.index', $data);
    }


    public function activateplan($id)
    {

    if(Auth::user()->confirmed > 0){
    return back()->with('success', 'YYou account is already confrimed.');
    }
         $data['page_title'] = 'Activate Packages';
        $data['pack'] = Package::find($id);
        $data['gate'] = Gateway::find(107);
        return view('user.payment.activateplan', $data);
    }





    public function gifttype()
    {
        $data['page_title'] = 'Manage Giftcard Type';
        $data['currency'] = Giftcard::orderBy('name','asc')->get();
        return view('admin.giftcard.type', $data);
    }


    public function deletepack($id)
    {
        $data = Package::find($id);
        $data->delete();
        $data->status= 0;
        $data->save();


        $notification =  array('message' => 'Package Deleted Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}

    public function delete($id)
    {
        $data = Giftcard::find($id);
        $data->delete();
        $data->status= 0;
        $data->save();


        $notification =  array('message' => 'Giftcard Deleted Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}
	 public function deletetype($id)
    {
        $data = Giftcardtype::find($id);
        $data->delete();
        $data->status= 0;
        $data->save();


        $notification =  array('message' => 'Giftcard TYpe Deleted Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}



    public function activate($id)
    {
        $data = Giftcard::find($id);
        $data->status= 1;
        $data->save();

        $notification =  array('message' => 'Giftcard Activated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}


    public function deactivatepack($id)
    {
        $data = Package::find($id);
        $data->status= 0;
        $data->save();

        $notification =  array('message' => 'Package Deactivated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}


    public function activatepack($id)
    {
        $data = Package::find($id);
        $data->status= 1;
        $data->save();

        $notification =  array('message' => 'Package Activated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}


    public function deactivate($id)
    {
        $data = Giftcard::find($id);
        $data->status= 0;
        $data->save();

        $notification =  array('message' => 'Giftcard Deactivated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Manage Currency';
        return view('admin.currency.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


            $image = uniqid().'.jpg';
             Giftcard::create([
                    'image' => $image,
                    'name' => $request->name,

                ]);

        $request->photo->move('giftcards',$image);
        return back()->with('success', 'New Giftcard Created Successfully!');

    }

  public function storepack(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'pvs' => 'required',
        ]);


             Package::create([
                    'price' => $request->price,
                    'name' => $request->name,
                    'pvs' => $request->pvs,

                ]);

        return back()->with('success', 'New Package Created Successfully!');

    }

 public function editpack(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'pvs' => 'required',
        ]);

    $pack = Package::find($request->id);

                    $pack->price = $request->price;
                    $pack->name = $request->name;
                    $pack->pvs = $request->pvs;
                    $pack->save();


        return back()->with('success', 'Package Updated Successfully!');

    }


     public function storetype(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required',
        ]);


             Giftcardtype::create([
                    'rate' => $request->rate,
                    'currency' => $request->currency,
                    'card_id' => $id,
                    'name' => $request->name,

                ]);


        return back()->with('success', 'New Giftcard Type Created Successfully!');

    }



    public function activatetype($id)
    {
        $data = Giftcardtype::find($id);
        $data->status= 1;
        $data->save();

        $notification =  array('message' => 'Giftcard Type Activated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}


    public function deactivatetype($id)
    {
        $data = Giftcardtype::find($id);
        $data->status= 0;
        $data->save();

        $notification =  array('message' => 'Giftcard TYpe Deactivated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}




    public function edit($id)
    {
        $data['giftcard'] = Giftcard::find($id);
        $data['page_title'] = "Manage Giftcard";
        return view('admin.giftcard.edit', $data);
    }


    public function edittype($id)
    {
         $data['giftcardtype'] = Giftcardtype::whereCard_id($id)->get();

        $data['giftcard'] = Giftcard::whereId($id)->first();

        $data['page_title'] = "Manage Giftcard";
        return view('admin.giftcard.edit-type', $data);
    }


    public function edittype2($id)
    {
        $data['giftcardtype'] = Giftcardtype::whereId($id)->first();
        $giftcard = Giftcardtype::whereId($id)->first();
        $data['giftcard'] = Giftcard::whereId($giftcard->card_id)->first();
        $data['page_title'] = "Manage Giftcardtype";
        return view('admin.giftcard.edit-type2', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request )
    {

        $request->validate([


            'name' => 'required',
        ]);

        $data = Giftcard::find($request->id);
        $data['name'] = $request->name ;
         if($request->hasFile('photo'))
            {
                $data['image'] = uniqid().'.jpg';
                $request->photo->move('giftcards',$data['image']);
            }




        $data->save();

        return back()->with('success', 'Gift Card Updated Successfully!');
    }

    public function posttype(Request $request )
    {

        $request->validate([


            'name' => 'required',
            'currency' => 'required',
            'rate' => 'required',
        ]);

        $data = Giftcardtype::whereId($request->id)->first();
        $data['name'] = $request->name ;

        $data['rate'] = $request->rate ;

        $data['currency'] = $request->currency ;


        $data->save();

        return back()->with('success', 'Giftcard Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
