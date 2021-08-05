<?php

namespace App\Http\Controllers;

use App\BuyMoney;
use App\Category;
use App\Continent;
use App\Country;
use App\Currency;
use App\Coin;
use App\ExchangeMoney;
use App\Faq;
use App\Mentor;
use App\Menu;
use App\Post;
use App\User;
use Mail;
use App\Plan;
use App\GeneralSettings;
use App\User_plans;
use App\Tp_transactions;
use App\SellMoney;
use App\Service;
use App\Subscriber;
use App\Testimonial;
use Illuminate\Http\Request;






class FrontendController extends Controller
{
    public function index()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Home";
        $data['currency'] = Currency::whereStatus(1)->orderBy('symbol','asc')->get();
        $data['currency2'] = Currency::whereStatus(1)->orderBy('symbol','desc')->get();
        $data['testimonial'] = Testimonial::whereStatus(1)->get();
        $data['faq'] = Faq::all();

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('front.home', $data);
    }


	  public function autopilot(){

        //calculate top up earnings and
          //auto increment earnings after the increment time

          //get user plans
          $basic = GeneralSettings::first();
          $plans=User_plans::where('active','yes')->get();
          foreach($plans as $plan){
              //get plan
              $dplan=Plan::where('id',$plan->plan)->first();
              //get user
              $user=User::where('id',$plan->user)->first();
              //get settings


              //check if trade mode is on

              if($basic->trade == 1){
                  //get plan xpected return
                  $to_receive=$dplan->expected_return;
                  //know the plan increment interval
                  if($dplan->increment_interval=="Monthly"){
                  $togrow=\Carbon\Carbon::now()->subMonths(1)->toDateTimeString();
                  $dtme = $plan->last_growth->diffInMonths();
                }elseif($dplan->increment_interval=="Weekly"){
                  $togrow=\Carbon\Carbon::now()->subWeeks(1)->toDateTimeString();
                  $dtme = $plan->last_growth->diffInWeeks();
                }elseif($dplan->increment_interval=="Daily"){
                  $togrow=\Carbon\Carbon::now()->subDays(1)->toDateTimeString();
                  $dtme = $plan->last_growth->diffInDays();
                }elseif($dplan->increment_interval=="Hourly"){
                  $togrow=\Carbon\Carbon::now()->subHours(1)->toDateTimeString();
                  $dtme = $plan->last_growth->diffInHours();
                }

                //expiration
                if($plan->inv_duration=="One week"){
                  $condition=$plan->activated_at->diffInDays() < 7 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 7;
                }elseif($plan->inv_duration=="One month"){
                  $condition=$plan->activated_at->diffInDays() < 28 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 28;
                }elseif($plan->inv_duration=="Two months"){
                  $condition=$plan->activated_at->diffInDays() < 56 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 56;
                 }elseif($plan->inv_duration=="Three months"){
                  $condition=$plan->activated_at->diffInDays() < 80 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 80;
                }elseif($plan->inv_duration=="Four months"){
                  $condition=$plan->activated_at->diffInDays() < 112 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 112;
                 }elseif($plan->inv_duration=="Five months"){
                  $condition=$plan->activated_at->diffInDays() < 140 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 140;
                }elseif($plan->inv_duration=="Six months"){
                  $condition=$plan->activated_at->diffInDays() < 168 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 168;
                }elseif($plan->inv_duration=="Seven months"){
                  $condition=$plan->activated_at->diffInDays() < 196 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 196;
                }elseif($plan->inv_duration=="Eight months"){
                  $condition=$plan->activated_at->diffInDays() < 224 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 224;
                }elseif($plan->inv_duration=="Nine months"){
                  $condition=$plan->activated_at->diffInDays() < 252 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 252;
                }elseif($plan->inv_duration=="Ten months"){
                  $condition=$plan->activated_at->diffInDays() < 280 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 280;
                }elseif($plan->inv_duration=="Eleven months"){
                  $condition=$plan->activated_at->diffInDays() < 308 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 308;
                }elseif($plan->inv_duration=="One year"){
                  $condition=$plan->activated_at->diffInDays() < 336 && $user->trade_mode=="on";
                  $condition2=$plan->activated_at->diffInDays() >= 336;
                }

                 //calculate increment
                if($dplan->increment_type=="Percentage"){
                  $increment=($plan->amount*$dplan->increment_amount)/100;
                }else{
                  $increment=$dplan->increment_amount;
                }

                if($condition){

                 if($plan->last_growth <= $togrow){
                  $amt = intval($dtme/1);

                    User::where('id', $plan->user)
                    ->update([
                    'roi' => $user->roi + $increment,
                    'balance' => $user->balance + $increment,
                    ]);

                    //save to transactions history
                    $th = new Tp_transactions();

                    $th->plan = $dplan->name;
                    $th->plan_id = $plan->trx;
                    $th->user = $user->id;
                    $th->amount = $increment;
                    $th->type = "ROI";
                    $th->save();

                    User_plans::where('id', $plan->id)
                    ->update([
                    'last_growth' => \Carbon\Carbon::now()
                    ]);

                    //send email notification
                     $basic = GeneralSettings::first();
                    $to_name = $user->username;
                    $sitename = env('APP_NAME');
                    $to_email = $user->email;
                    $heading = "Invetsment Cashback";
                    $data = array("name"=> $user->username,"heading"=>"New Investment Yield", "body" => "Your ".$dplan->name." investment with ID numnber ".$plan->trx." have successfully yielded ".$basic->currency."".$increment." returns. Thank you for choosing ".$basic->sitename."");

                    Mail::send("mail", $data, function($message) use ($to_name,  $heading, $to_email) {
                    $message->to($to_email, $to_name,  $heading)
                    ->subject("Investment Yield");
                     $message->from(env('MAIL_USERNAME'),env('APP_NAME'));
                    });


                  //}
                  }
                }

                //release capital
            if($condition2){
                 User::where('id', $plan->user)
                    ->update([
                    'balance' => $user->balance + $plan->amount,
                ]);

                //plan expired
                User_plans::where('id', $plan->id)
                ->update([
                'active' => "expired",
                ]);

                //save to transactions history
                    $th = new tp_transactions();

                    $th->plan = $dplan->name;
                    $th->user = $plan->user;
                    $th->plan_id = $plan->trx;
                    $th->amount = $plan->amount;
                    $th->type = "Investment capital";
                    $th->save();

                    //send email notification
                    $basic = GeneralSettings::first();
                    $to_name = $user->username;
                    $sitename = env('APP_NAME');
                    $to_email = $user->email;
                    $heading = "Investment Tenure Expired";
                    $data = array("name"=> $user->username,"heading"=>"Investment Tenure Expired", "body" => "Your ".$dplan->name." investment with ID numnber ".$plan->trx." have successfully yielded ".$basic->currency."".$plan->amount." cashback. Investment Tenure Has Successfuly Expired. Thank you for choosing ".$basic->sitename."");

                    Mail::send("mail", $data, function($message) use ($to_name,  $heading, $to_email) {
                    $message->to($to_email, $to_name,  $heading)
                    ->subject("Investment Tenure Expired");
                     $message->from(env('MAIL_USERNAME'),env('APP_NAME'));
                    });


            }


              }

          }
          //do auto confirm payments
           return redirect()->back()
          ->with('message', 'Cron Job Session Completed Sucessful. System Operation has been updated');

    }


   public function about()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Home";
        $data['currency'] = Currency::whereStatus(1)->orderBy('symbol','asc')->get();
        $data['currency2'] = Currency::whereStatus(1)->orderBy('symbol','desc')->get();
        $data['testimonial'] = Testimonial::whereStatus(1)->get();
        $data['faq'] = Faq::all();

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('front.about', $data);
    }

     public function rate()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Exchange Rate";
        $data['currency'] = Currency::whereDeleted_at(Null)->orderBy('symbol','asc')->get();

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('front.rate', $data);
    }

     public function how()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Exchange Rate";
        $data['currency'] = Currency::whereDeleted_at(Null)->orderBy('symbol','asc')->get();

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('front.how', $data);
    }

   public function privacy()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Privacy & Policy";

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('front.privacy', $data);
    }

    public function maintain()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Privacy & Policy";

        return view('front.maintain', $data);
    }

    public function blog()
    {
        $data['page_title'] = "Blogs";
        $data['blogs'] = Post::where('status', 1)->whereNotify(0)->paginate(6);
        return view('front.blog', $data);
    }


    public function blogview($id)
    {
        $data['page_title'] = "Blogs";
        $data['blog'] = Post::whereId($id)->first();
        return view('front.blogview', $data);
    }

    public function categoryByBlog($id)
    {
        $cat = Category::find($id);
        $data['page_title'] = "$cat->name";
        $data['blogs'] = $cat->posts()->latest()->paginate(3);
        return view('front.blog', $data);
    }

    public function details($id)
    {
        $post = Post::find($id);
        if ($post) {
            $data['page_title'] = "Blog Details";
            $data['post'] = $post;
            return view('front.details', $data);
        }
        abort(404);
    }

    public function faq()
    {
        $data['page_title'] = "Faq";
        $data['faq'] = Faq::all();
        return view('front.faq', $data);
    }
    public function termsCondition()
    {
        $data['page_title'] = "Terms & Condition";

        return view('front.terms', $data);
    }
    public function privacyPolicy()
    {
        $data['page_title'] = "Privacy & Policy";
        return view('front.policy', $data);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $macCount = Subscriber::where('email', $request->email)->count();
        if ($macCount > 0) {
            return back()->with('alert', 'This Email Already Exist !!');
        } else {
            Subscriber::create($request->all());
            return back()->with('success', ' Subscribe Successfully!');
        }
    }

    public function contactUs()
    {
        $data['page_title'] = "Contact Us";
        return view('front.contact', $data);
    }

    public function contactSubmit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'subject' => 'required',
            'phone' => 'required',
        ]);
        $subject = $request->subject;
        $phone = "<br><br>" . "Contact Number : " . $request->phone . "<br><br>";

        $txt = $request->message . $phone;

        send_contact($request->email, $request->name, $subject, $txt);
        return back()->with('success', ' Contact Message Send Successfully!');
    }


    public function service($id)
    {
        $service = Service::find($id);
        if ($service) {
            $get['data'] = $service;
            $get['page_title'] = "Service";
            return view('front.service-info', $get);
        }
        abort(404);
    }

    public function menu($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $data['page_title'] = $menu->name;
            $data['menu'] = $menu;
            return view('front.menu', $data);
        }
        abort(404);
    }


    public function register($reference)
    {
        $page_title = "Home";
        $faq = Faq::all();

        $exist = User::where('username', $reference)->count();

        if($exist > 0){
        session()->flash('ref', 'You are about to register using '.$reference.' as your sponsor. You can Also Share Your Referral Link To Earn Bonus When You Register');
        return view('auth.register',compact('faq','reference','page_title')); }

        else {
        session()->flash('referror', 'No user with this referral link. Please check and try again later');
        return redirect()->route('main');
        }
    }




    public function cronPrice()
    {
          $basic = GeneralSettings::first();
            $baseUrl = "https://api.coingate.com";
			$endpoint = "/v2/rates/merchant/USD/".$basic->currency."";
			$httpVerb = "GET";
			$contentType = "application/json"; //e.g charset=utf-8
			$headers = array (
				"Content-Type: $contentType",

        );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $usdrate = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
        	curl_close($ch);


        	$basic['rate'] = $usdrate;
        	$basic->save();


        	$baseUrl = "https://api.alternative.me";
			$endpoint = "/v2/ticker/";
			$httpVerb = "GET";
			$contentType = "application/json"; //e.g charset=utf-8
			$headers = array (
				"Content-Type: $contentType",

        );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $rate = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
        	curl_close($ch);




        	$coinrate  = $rate['data']['1'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$btc  = Currency::find(5);
			$btc['price'] = $rrate;
        	$btc->save();

        	$btcblock  = Coin::find(3);
			$btcblock['price'] = $rrate;
        	$btcblock->save();


    	    $coinrate  = $rate['data']['2'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$ltc  = Currency::find(4);
			$ltc['price'] = $rrate;
        	$ltc->save();

        	$ltcblock  = Coin::find(2);
			$ltcblock['price'] = $rrate;
        	$ltcblock->save();

        	$coinrate  = $rate['data']['1321'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$eth  = Currency::find(1);
			$eth['price'] = $rrate;
        	$eth->save();

        	$coinrate  = $rate['data']['1831'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$bch  = Currency::find(3);
			$bch['price'] = $rrate;
        	$bch->save();

        	$coinrate  = $rate['data']['131'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$bch  = Currency::find(10);
			$bch['price'] = $rrate;
        	$bch->save();


        	$coinrate  = $rate['data']['74'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$doge  = Currency::find(112);
			$doge['price'] = $rrate;
        	$doge->save();

            $dogeblock  = Coin::find(1);
			$dogeblock['price'] = $rrate;
        	$dogeblock->save();


    }


}
