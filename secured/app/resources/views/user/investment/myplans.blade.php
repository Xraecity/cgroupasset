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
                                                <h4 class="nk-block-title fw-normal">Portfolio</h4>
                                                <div class="nk-block-des"><p>Here is the list of your active and completed investment plans</p></div>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <ul class="nk-block-tools gx-3">
                                                    <li>
                                                        <a href="{{route('newinvestment')}}" class="btn btn-primary"><span>Invest More</span> <em class="icon ni ni-arrow-long-right d-none d-sm-inline-block"></em></a>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">

                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head-sm">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Active Plan <span class="count text-base">({{App\User_plans::whereActive("yes")->whereUser(Auth::user()->id)->count()}})</span></h5>
                                        </div>
                                    </div>
                                    <div class="nk-iv-scheme-list">
                                     @if(count($active) > 0)
                                    @foreach($active as $data)
                                        <div class="nk-iv-scheme-item">
                                            <div class="nk-iv-scheme-icon is-running"><em class="icon ni ni-update"></em></div>
                                            <div class="nk-iv-scheme-info">
                                                <div class="nk-iv-scheme-name">{{App\Plan::whereId($data->plan)->first()->name}} - {{App\Plan::whereId($data->plan)->first()->increment_amount}} @if(App\Plan::whereId($data->plan)->first()->increment_type == "Fixed") {{$basic->currency}} @else % @endif {{App\Plan::whereId($data->plan)->first()->increment_interval}} </div>
                                                <div class="nk-iv-scheme-name">Investment Code: {{$data->trx}} </div>
                                                <div class="nk-iv-scheme-desc">Invested Amount - <span class="amount">{{$basic->currency}} {{number_format($data->amount,2)}} </span></div>
                                            </div>
                                            <div class="nk-iv-scheme-term">
                                                <div class="nk-iv-scheme-start nk-iv-scheme-order"><span class="nk-iv-scheme-label text-soft">Startup Date</span><span class="nk-iv-scheme-value date">{!! date(' M D, Y ', strtotime($data->created_at)) !!}</span></div>
                                                <div class="nk-iv-scheme-end nk-iv-scheme-order"><span class="nk-iv-scheme-label text-soft">Last Growth</span><span class="nk-iv-scheme-value date">{!! date(' M D, Y ', strtotime($data->updated_at)) !!}</span></div>
                                            </div>
                                            <div class="nk-iv-scheme-amount">
                                                <div class="nk-iv-scheme-amount-a nk-iv-scheme-order"><span class="nk-iv-scheme-label text-soft">Investment Return</span><span class="nk-iv-scheme-value amount">{{$basic->currency}} {{number_format(App\Tp_transactions::wherePlan_id($data->trx)->sum("amount"),2)}}</span></div>
                                                <div class="nk-iv-scheme-amount-b nk-iv-scheme-order">
                                                    <span class="nk-iv-scheme-label text-soft">Net Profit Earn</span><span class="nk-iv-scheme-value amount"> <span class="amount-ex"> {{$basic->currency}} {{number_format(App\Tp_transactions::wherePlan_id($data->trx)->sum("amount"),2)}}</span></span>
                                                </div>
                                            </div>
                                            <div class="nk-iv-scheme-more">
                                                <a class="btn btn-icon btn-lg btn-round btn-trans" href="{{route('viewinv', $data->trx)}}"><em class="icon ni ni-forward-ios"></em></a>
                                            </div>
                                            <div class="nk-iv-scheme-progress"><div class="progress-bar" data-progress="{{App\Tp_transactions::wherePlan_id($data->trx)->count()/$data->cycle * 100}}"></div></div>

                                        </div>
                                        @endforeach
                                        @else
                                        No Active Investment Plan Yet
                                        @endif
                                    </div>
                                </div>
                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h5 class="nk-block-title">Recently End <span class="count text-base">({{App\User_plans::whereActive("expired")->whereUser(Auth::user()->id)->count()}})</span></h5>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <a href="#"><em class="icon ni ni-dot-box"></em> Go to Archive</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-iv-scheme-list">
                                     @if(count($expired) > 0)
                                    @foreach($expired as $data)

                                       <div class="nk-iv-scheme-item">
                                            <div class="nk-iv-scheme-icon is-running"><em class="icon ni ni-update"></em></div>
                                            <div class="nk-iv-scheme-info">
                                                <div class="nk-iv-scheme-name">{{App\Plan::whereId($data->plan)->first()->name}} - {{App\Plan::whereId($data->plan)->first()->increment_amount}} @if(App\Plan::whereId($data->plan)->first()->increment_type == "Fixed") {{$basic->currency}} @else % @endif {{App\Plan::whereId($data->plan)->first()->increment_interval}} </div>
                                                <div class="nk-iv-scheme-name">Investment Code: {{$data->trx}} </div>
                                                <div class="nk-iv-scheme-desc">Invested Amount - <span class="amount">{{$basic->currency}} {{number_format($data->amount,2)}} </span></div>
                                            </div>
                                            <div class="nk-iv-scheme-term">
                                                <div class="nk-iv-scheme-start nk-iv-scheme-order"><span class="nk-iv-scheme-label text-soft">Startup Date</span><span class="nk-iv-scheme-value date">{!! date(' M D, Y ', strtotime($data->created_at)) !!}</span></div>
                                                <div class="nk-iv-scheme-end nk-iv-scheme-order"><span class="nk-iv-scheme-label text-soft">Last Growth</span><span class="nk-iv-scheme-value date">{!! date(' M D, Y ', strtotime($data->updated_at)) !!}</span></div>
                                            </div>
                                            <div class="nk-iv-scheme-amount">
                                                <div class="nk-iv-scheme-amount-a nk-iv-scheme-order"><span class="nk-iv-scheme-label text-soft">Investment Return</span><span class="nk-iv-scheme-value amount">{{$basic->currency}} {{number_format(App\Tp_transactions::wherePlan_id($data->trx)->sum("amount"),2)}}</span></div>
                                                <div class="nk-iv-scheme-amount-b nk-iv-scheme-order">
                                                    <span class="nk-iv-scheme-label text-soft">Net Profit Earn</span><span class="nk-iv-scheme-value amount"> <span class="amount-ex"> {{$basic->currency}} {{number_format(App\Tp_transactions::wherePlan_id($data->trx)->sum("amount"),2)}}</span></span>
                                                </div>
                                            </div>
                                            <div class="nk-iv-scheme-more">
                                                <a class="btn btn-icon btn-lg btn-round btn-trans" href="{{route('viewinv', $data->trx)}}"><em class="icon ni ni-forward-ios"></em></a>
                                            </div>
                                            <div class="nk-iv-scheme-progress"><div class="progress-bar" data-progress="{{App\Tp_transactions::wherePlan_id($data->trx)->count()/$data->cycle * 100}}"></div></div>

                                        </div>
                                        @endforeach
                                        @else
                                        No Expired Investment Plan
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

@endsection
