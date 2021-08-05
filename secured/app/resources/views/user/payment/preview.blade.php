@extends('include.dashboard')
@section('content')

                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                    <br><br>
                        <div class="nk-block-head nk-block-head-xs text-center">
                            <h5 class="nk-block-title">Confirm Deposit</h5>
                            <div class="nk-block-text">
                                <div class="caption-text">You are about to deposit <strong>{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</strong></div>
                                <span class="sub-text-sm">Exchange rate: 1 {{$basic->currency}} = {{number_format($basic->rate, $basic->decimal)}} USD</span>
                            </div>
                        </div>
                        <div class="nk-block">
                            <div class="buysell-overview">
                                <ul class="buysell-overview-list">
                                    <li class="buysell-overview-item">
                                        <span class="pm-title">Pay with</span><span class="pm-currency"><em class="icon ni ni-{{App\Gateway::whereId($data->gateway_id)->first()->val7}}"></em> <span>@if($data->gateway_id == 1)
                                        Bank Transfer
                                        @else
                                        {{App\Gateway::whereId($data->gateway_id)->first()->name}}.
                                        @endif</span></span>
                                    </li>
                                    <li class="buysell-overview-item"><span class="pm-title">Total</span><span class="pm-currency">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span></li>
                              <li class="buysell-overview-item"><span class="pm-title">USD</span><span class="pm-currency">${{number_format($data->usd, $basic->decimal)}}</span></li>
                                </ul>
                                <div class="sub-text-sm">* Payment gateway may charge you . <a href="#">transaction fee</a></div>
                            </div>

                            <div class="buysell-field form-action text-center">
                                <div>@if($data->gateway_id == 1)
<div class="card-text"><p>Make Payment To Any Of The Following Bank Account Details.<br>
<a class="text-warning"> Ensure to upload your proof of payment and transaction number once payment is done. Your deposit will be approved once payment is verified by our server</a>. </p></div>
<? $bank = DB::table('banks')->orderBy('name','asc')->get(); ?>
<div class="gaps-3x"></div>

<table class="table">
  <thead class="thead-light">
    <tr>

      <th scope="col">Bank Name</th>
      <th scope="col">Account Details</th>
    </tr>
  </thead>
  <tbody>
  @foreach($bank as $gate)
    <tr>

      <td>{{$gate->name}}</td>
      <td>{{$gate->account}}</td>
    </tr>
    @endforeach
  </tbody>
</table>


<div class="pay-buttons"><div class="pay-button">
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}




 <!--<div class="form-group">

  <small class="text-primary"> Please enter your transaction number</small>
  <input  name="code" class="form-control" required type="text">
  </div>-->


<input name="bank" value="1" hidden >


 <!--<div class="form-group">
<small class="text-primary"> Please attach a screenshot of your bank transfer of payment slip</small>

<input type="file" name="image" required class="form-control" id="file-01"><label class="badge badge-info" for="file-01">Select Screenshot</label>
</div>-->




</div></div></div>

@elseif($data->gateway_id == 513)
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}


To complete deposit, please select a cryptocurrency and proceed with your deposit. You will be redirected to Coin Payments page for your secure crypto payment process.
<select name="currency" required class="form-control form-lg" data-placeholder="Select A Cryptocurrency">
														<option>Select Currency</option>

															<option value="BTC">BTC (BitCoin) </option>
                                                            <option value="BCH">Bitcoin Cash (BCH) </option>
                                                            <option value="LTC">LiteCoin (LTC) </option>
                                                            <option value="ETH">Ethereum (ETH) </option>
                                                            <option value="ZEC">Zcash (ZEC) </option>
                                                            <option value="DASH">Dash (DASH) </option>
                                                            <option value="XRP">Ripple (XRP) </option>
                                                            <option value="XMR">Monero (XMR) </option>
                                                            <option value="NEO">NEO (NEO) </option>
                                                            <option value="ADA">Cardano (ADA) </option>
                                                            <option value="EOS">EOS (EOS) </option>
													</optgroup>
													</select><br>

@else

@endif

<div class="pay-buttons"><div class="pay-button">
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

@if($data->gateway_id == 0)
  <div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Transaction Number</label><input   name="code" class="input-bordered" required type="text"><label class="input-item-label text-exlight"><small> (Please enter your payment transaction number,)</small></label></div>

<input name="bank" value="bank" hidden >


<!--<div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label><div class="relative"><em class="input-file-icon fas fa-upload"></em><input type="file" name="image" class="input-file" id="file-01"><label for="file-01">Choose a file</label>
</div>
<small> (Please attach a screenshot of your bank transfer of payment slip)</small>
</div></div>-->
<button  type="submit" id="btn-confirm" class="btn btn-primary btn-lg">Proceed To Pay <em class="ti ti-wallet"></em></button>
</form>
@endif


@if($data->gateway_id == 100)
<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

    <script>
			const API_publicKey = "{{ $data->gateway->val1 }}";
			function payWithRave() {
			var x = getpaidSetup({
			PBFPubKey: API_publicKey,
			customer_email: "{{ Auth::user()->email }}",
			amount: "{{ round($data->amount, 2)}}",
			customer_phone: "{{ Auth::user()->mobile }}",
			currency: "NGN",
			txref: "rave-123456",
		    payment_options: "card",
			meta: [{
			metaname: "flightID",
			metavalue: "AP1234"
			}],
			onclose: function() {},
			callback: function(response) {
			var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
			console.log("This is the response returned after a charge", response);
			if (
			response.tx.chargeResponseCode == "00" ||
			response.tx.chargeResponseCode == "0"
			) {
			window.location.href = "{{route('cardpay', $data->trx)}}";
			} else {
			// redirect to a failure page.
			}

			x.close(); // use this to close the modal immediately after payment.
			}
			});
			}
			</script>


<badge  onClick="payWithRave()" class="btn btn-primary btn-lg">Pay Flutterwave<em class="ti ti-wallet"></em></badge>
@elseif($data->gateway_id == 107)

 <script>
						function payWithPaystack(){
						var handler = PaystackPop.setup({
						key: "{{ $data->gateway->val1 }}",
						email: "{{ Auth::user()->email }}",
						amount: "{{ round($data->amount+$data->charge, 2)*100 }}",
						currency: "NGN",
						ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
						firstname: '',
						lastname: '',
						// label: "Optional string that replaces customer email"
						metadata: {
						custom_fields: [
						{
						display_name: "Mobile Number",
						variable_name: "",
						value: "+2348012345678"
						}
						]
						},
						callback: function(response){
						alert('Deposit successful. transaction refference number is ' + response.reference);
						window.location.href = "{{route('cardpay', $data->trx)}}";
						},
						onClose: function(){
						alert('window closed');
						}
						});
						handler.openIframe();
						}
						</script>


<script src="https://js.paystack.co/v1/inline.js"></script>
<badge onclick="payWithPaystack()" class="btn btn-primary btn-lg">Pay Paystack <em class="ti ti-wallet"></em></badge>
@elseif($data->gateway_id == 109)
<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
<badge onclick="makePayment()"  class="btn btn-primary btn-lg">Pay Remitta <em class="ti ti-wallet"></em></badge>
@elseif($data->gateway_id > 513 && $data->gateway->coin == 1 )
<div class="pay-buttons"><div class="pay-button">
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
<div class="buysell-overview">
Exchange rate: 1 USD  = {{number_format($basic->rate, $basic->decimal)}} {{$basic->currency}}


<div class="sub-text-sm">* Please send exactly USD{{number_format($data->amount*$basic->rate, $basic->decimal)}} into our <a href="#">{{$data->gateway->name}}</a> wallet. Please click on copy button below to copy your wallet address or scan QR code to get wallet address.<br>
<small class="text-warning">Please ensure to enter the payment transaction hash number or code with a screenshot of your payment once payment is succesfull. Your deposit will be approved once payment is verified by our server.</small></div></div>

<center>
<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$data->gateway->val1}}&choe=UTF-8\" title='QR Code' style='width:200px;' />
</center>
<div class="buysell-field form-group">


<div class="form-label-group"><label class="form-label"></label><a href="#" class="link">&copy {{$data->gateway->name}} Wallet Address</a></div>

<div class="nk-refwg-url"><div class="form-control-wrap"><div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy Link</span></div> <input type="text" class="form-control copy-text" readonly id="refUrl" value="{{$data->gateway->val1}}"></div></div></div>



<!-- <div class="form-group">

  <small class="text-primary"> Please enter your payment transaction hash number</small>
  <input  name="code" class="form-control" required type="text">
  </div>-->


<input name="coin" value="1" hidden >


<!-- <div class="form-group">
<small class="text-primary"> Please attach a screenshot of your payment slip</small>

<input type="file" name="image" required class="form-control" id="file-01"><label class="badge badge-info" for="file-01">Select Screenshot</label>
</div>-->

<button  type="submit" id="btn-confirm" class="btn btn-primary btn-lg">Proceed To Pay <em class="ti ti-wallet"></em></button>
</form>


</div></div></div>
@else
<button  type="submit" id="btn-confirm" class="btn btn-primary btn-lg">Proceed To Pay <em class="ti ti-wallet"></em></button>
</form>@endif</div>
                                <div class="pt-3"><a href="{{route('deldepos', $data->id)}}" data-dismiss="modal" class="link link-danger">Cancel Deposit</a></div>
                            </div>
                        </div>
                    </div>
                </div>


@endsection
