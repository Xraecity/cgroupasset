@extends('include.dashboard')

@section('content')


  <div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="nk-block-head-content">
                                         <div class="nk-block-head-content"><h4 class="nk-block-title fw-normal">Ready to get started?</h4></div>
                                    </div>
                                </div>

                                <div class="nk-block invest-block">
                                     <form action="{{route('postinv')}}" method="post" class="invest-form">
                                                @csrf
                                        <div class="row g-gs">
                                            <div class="col-lg-7">
                                                <div class="invest-field form-group">
                                                    <input type="hidden" value="{{$plan->id}}" name="id"  />
                                                    <div class="dropdown invest-cc-dropdown">
                                                        <a href="#" class="invest-cc-choosen " >
                                                            <div class="coin-item">
                                                                <div class="coin-icon"><em class="text-primary icon ni ni-offer-fill"></em></div>
                                                                <div class="coin-info"><span class="coin-name">{{$plan->name}}</span><span class="coin-text">Invest for {{$plan->expiration}} and get {{$plan->increment_amount}} @if($plan->increment_type == "Fixed"){{$basic->currency_sym}} @else % @endif profit  {{$plan->increment_interval}} </span></div>
                                                            </div>
                                                        </a>

                                                    </div>
                                                </div>
                                                <script>
                                                function myFunction() {
                                                var usd = $('#usd').val() ;
                                                var xch = "{{$basic->rate}}";
                                                var exch = usd/xch;
                                                var rate = "{{$plan->increment_type}}";
                                                var cycle = "{{$cycle}}";
                                                if(rate == "Percentage"){
                                                 var profit1 = {{$plan->increment_amount}}*usd/100;
                                                 var profit2 = profit1*cycle;
                                                 var profit = profit2;
                                                }
                                                else{
                                                 var profit1 = "{{$plan->increment_amount}}"*cycle;
                                                 var profit = +profit1;

                                                }

                                                document.getElementById("totalret").innerHTML = +usd + +profit.toFixed(2);
                                                document.getElementById("amount").innerHTML = usd;
                                                document.getElementById("profit").innerHTML = profit.toFixed(2);
                                                document.getElementById("cycle").value = profit;
                                                };
                                                </script>
                                                <div class="invest-field form-group">
                                                <div class="form-label-group"><label class="form-label">Choose Quick Amount to Invest</label></div>
                                                  
                                                    <div class="form-control-group">
                                                        <div class="form-info">{{$basic->currency}}</div>
                                                        <input type="text"  id="usd" onkeyup="myFunction()"  placeholder="0.00" name="amount" class="form-control form-control-amount form-control-lg"  />

                                                    </div>
                                                    <div class="text-warning form-note pt-2">Note: Minimum invest {{number_format($plan->min_price,2)}} and upto {{number_format($plan->max_price,2)}}</div>
                                                </div>
                                                <div class="invest-field form-group">
                                                    <div class="form-label-group"><label class="form-label">Payment Method</label></div>
                                                    <input type="hidden" value="wallet" name="iv-wallet" id="invest-choose-wallet" />
                                                    <div class="dropdown invest-cc-dropdown">
                                                        <a href="#" class="invest-cc-choosen   data-toggle="dropdown">
                                                            <div class="coin-item">
                                                                <div class="coin-icon"><em class="text-primary icon ni ni-wallet-alt"></em></div>
                                                                <div class="coin-info"><span class="coin-name">Deposit Wallet</span><span class="coin-text">Current balance: {{$basic->currency}}{{number_format(Auth::User()->balance,2)}} </span></div>
                                                            </div>
                                                        </a>

                                                    </div>
                                                </div>
                                                <div class="invest-field form-group">
                                                    <div class="custom-control custom-control-xs custom-checkbox">
                                                        <input type="checkbox" name="terms" class="custom-control-input" id="checkbox" /><label class="custom-control-label" for="checkbox">I agree the <a href="#">terms &amp; conditions.</a></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-5 offset-xl-1">
                                                <div class="card card-bordered ml-lg-4 ml-xl-0">
                                                    <div class="nk-iv-wg4">
                                                        <div class="nk-iv-wg4-sub">
                                                            <h6 class="nk-iv-wg4-title title">Your Investment Details</h6>
                                                            <ul class="nk-iv-wg4-overview g-2">
                                                                <li>
                                                                    <div class="sub-text">Name</div>
                                                                    <div class="lead-text">{{$plan->name}}</div>
                                                                </li>
                                                                <li>
                                                                    <div class="sub-text">Duration</div>
                                                                    <div class="lead-text">{{$plan->expiration}}</div>
                                                                </li>
                                                                <li>
                                                                    <div class="sub-text">Bonus</div>
                                                                    <div class="lead-text">{{$basic->currency}}{{number_format($plan->gift,2)}} </div>
                                                                </li>
                                                                <li>
                                                                    <div class="sub-text">{{$plan->increment_interval}} profit  @if($plan->increment_type == "Fixed"){{$basic->currency_sym}} @else % @endif</div>
                                                                    <div class="lead-text">{{$plan->increment_amount}} @if($plan->increment_type == "Fixed")(Fixed) @else (%) @endif</div>
                                                                </li>

                                                            </ul>
                                                        </div>

                                                        <div class="nk-iv-wg4-sub">
                                                            <ul class="nk-iv-wg4-list">
                                                                <li>
                                                                    <div class="sub-text">Amount to invest</div>
                                                                    <div class="lead-text">{{$basic->currency_sym}}<a id="amount">0.00</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="sub-text">Expected ROI</div>
                                                                    <div class="lead-text">{{$basic->currency_sym}} <a id="profit">0.00</a></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="nk-iv-wg4-sub">
                                                            <ul class="nk-iv-wg4-list">
                                                                <li>
                                                                    <div class="lead-text">Total Return</div>
                                                                    <div class="caption-text text-primary">{{$basic->currency_sym}} <a id="totalret">0.00</a></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <input value="{{$cycle}}" hidden name="cycle">
                                                        <div class="nk-iv-wg4-sub text-center bg-lighter"><button type="submit" class="btn btn-lg btn-primary ttu" data-toggle="modal" data-target="#invest-plan">Confirm &amp; proceed</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
