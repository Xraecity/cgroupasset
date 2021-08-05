@extends('include.dashboard')

@section('content')
  <div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                          <div class="nk-block-between-md g-4">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title fw-normal">{{$plan->name}} - {{$plan->increment_amount}} @if($plan->increment_type == "Fixed") {{$basic->currency}} @else % @endif {{$plan->increment_interval}} for {{$plan->expiration}}</h4>
                                                <div class="nk-block-des">
                                                    <p>INV-{{$inv->trx}} @if($inv->active == "yes")<span class="badge badge-outline badge-primary">Running</span> @else <span class="badge badge-outline badge-success">Finished</span> @endif</p>
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <ul class="nk-block-tools gx-3">
                                                    <li>
                                                        <a href="" class="btn btn-icon btn-light"><em class="icon ni ni-reload"></em></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row gy-gs">
                                                <div class="col-md-6">
                                                    <div class="nk-iv-wg3">
                                                        <div class="nk-iv-wg3-group flex-lg-nowrap gx-4">
                                                            <div class="nk-iv-wg3-sub">
                                                                <div class="nk-iv-wg3-amount"><div class="number">{{$basic->currency}} {{number_format($inv->amount,2)}}</div></div>
                                                                <div class="nk-iv-wg3-subtitle">Invested Amount</div>
                                                            </div>
                                                            <div class="nk-iv-wg3-sub">
                                                                <span class="nk-iv-wg3-plus text-soft"><em class="icon ni ni-plus"></em></span>
                                                                <div class="nk-iv-wg3-amount">
                                                                    <div class="number">{{$basic->currency}} {{number_format(App\Tp_transactions::wherePlan_id($inv->trx)->sum("amount"),2)}} <span class="number-up">{{$plan->increment_amount}} @if($plan->increment_type == "Fixed") {{$basic->currency}} @else % @endif</span></div>
                                                                </div>
                                                                <div class="nk-iv-wg3-subtitle">Profit Earned</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4 offset-lg-2">
                                                    <div class="nk-iv-wg3 pl-md-3">
                                                        <div class="nk-iv-wg3-group flex-lg-nowrap gx-4">
                                                            <div class="nk-iv-wg3-sub">
                                                                <div class="nk-iv-wg3-amount">
                                                                    <div class="number">
                                                                        {{$basic->currency}} {{number_format(App\Tp_transactions::wherePlan_id($inv->trx)->sum("amount"),2)}} <span class="number-down"><em class="icon ni ni-info-fill" data-toggle="tooltip" data-placement="right" title="Total Investment Returns"></em></span>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-iv-wg3-subtitle">Total Return</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="schemeDetails" class="nk-iv-scheme-details">
                                            <ul class="nk-iv-wg3-list">
                                                <li>
                                                    <div class="sub-text">Term</div>
                                                    <div class="lead-text">{{$plan->expiration}}</div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">Expected Cycle</div>
                                                    <div class="lead-text">{{$inv->cycle}} Time(s)</div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">Cycle Rounds</div>
                                                    <div class="lead-text">{{$plan->increment_interval}}</div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">{{$plan->increment_interval}} interest</div>
                                                    <div class="lead-text">{{$plan->increment_amount}} @if($plan->increment_type == "Fixed") {{$basic->currency}} @else % @endif</div>
                                                </li>
                                            </ul>
                                            <ul class="nk-iv-wg3-list">
                                                <li>
                                                    <div class="sub-text">Time Activated</div>
                                                    <div class="lead-text">{{ Carbon\Carbon::parse($inv->created_at)->diffForHumans() }}</div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">Last Growth</div>
                                                    <div class="lead-text">{{ Carbon\Carbon::parse($inv->last_growth)->diffForHumans() }}</div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">Term Start at</div>
                                                    <div class="lead-text">{!! date(' M D, Y ', strtotime($inv->updated_at)) !!}</div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">Last Growth</div>
                                                    <div class="lead-text">{!! date(' M D, Y ', strtotime($inv->last_growth)) !!}</div>
                                                </li>
                                            </ul>
                                            <ul class="nk-iv-wg3-list">
                                                <li>
                                                    <div class="sub-text">Captial invested</div>
                                                    <div class="lead-text"><span class="currency currency-usd">{{$basic->currency}} {{number_format($inv->amount,2)}}</span> </div>
                                                </li>
                                                <li>
                                                @php
                                                if($plan->increment_type == "Percentage")
                                                {
                                                $return = ($inv->amount*$plan->increment_amount)/100;
                                                }
                                                else
                                                {
                                                $return = $plan->increment_amount*$plan->cycle;
                                                }

                                                @endphp

                                                    <div class="sub-text">Expected profit</div>
                                                    <div class="lead-text"><span class="currency currency-usd">{{$basic->currency}} {{number_format($return*$inv->cycle,2)}}</span></div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">Net profit</div>
                                                    <div class="lead-text"><span class="currency currency-usd">{{$basic->currency}} </span> {{number_format(App\Tp_transactions::wherePlan_id($inv->trx)->sum("amount"),2)}}</div>
                                                </li>
                                                <li>
                                                    <div class="sub-text">Total return</div>
                                                    <div class="lead-text"><span class="currency currency-usd">{{$basic->currency}} </span> {{number_format(App\Tp_transactions::wherePlan_id($inv->trx)->sum("amount"),2)}}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head"><h5 class="nk-block-title">Investment Returns</h5></div>
                                    <div class="card card-bordered">
                                        <table class="table table-iv-tnx">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="tb-col-type"><span class="overline-title">Type</span></th>
                                                    <th class="tb-col-date"><span class="overline-title">Date</span></th>
                                                    <th class="tb-col-time tb-col-end"><span class="overline-title">Amount</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @if(count($roi) >0)
                                             @foreach($roi as $k=>$data)
                                                <tr>
                                                    <td class="tb-col-type"><span class="sub-text">{{$data->type}}</span></td>
                                                    <td class="tb-col-date"><span class="sub-text">{{ Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}</span></td>
                                                    <td class="tb-col-time tb-col-end"><span class="lead-text text-success">{{$basic->currency}}  {{number_format($data->amount,2)}}</span></td>
                                                </tr>
                                            @endforeach
                                            @endif

                                            </tbody>
                                        </table>
                                         @if(count($roi) < 1)
                                        <center> No Investment Yield Yet</center>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
