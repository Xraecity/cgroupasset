@extends('include.dashboard')

@section('content')
 <div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head text-center">
                                    <div class="nk-block-head-content">
                                        <div class="nk-block-head-sub"><span>Choose an Option</span></div>
                                        <div class="nk-block-head-content">
                                            <h2 class="nk-block-title fw-normal">Investment Plan</h2>
                                            <div class="nk-block-des"><p>Choose your investment plan and start earning.</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">

                                        <div class="plan-iv-currency text-center">
                                            <ul class="nav nav-switch nav-tabs bg-white">
                                                <li class="nav-item"><a href="#" class="nav-link active">{{$basic->currency}}</a></li>
                                            </ul>
                                        </div>
                                        <div class="plan-iv-list nk-slider nk-slider-s2">
                                            <ul
                                                class="plan-list slider-init"
                                                data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite":false, "responsive":[						{"breakpoint": 992,"settings":{"slidesToShow": 2}},						{"breakpoint": 768,"settings":{"slidesToShow": 1}}					]}'
                                            >
                                               @foreach($plan as $data)
                                                <form action="{{route('selectinv')}}" method="post" class="plan-iv">
                                                @csrf
                                                <li class="plan-item">
                                                    <input type="radio" id="plan-iv-{{$data->id}}" value="{{$data->id}}" name="id"  class="plan-control" />
                                                    <div class="plan-item-card">
                                                        <div class="plan-item-head">
                                                            <div class="plan-item-heading">
                                                                <h4 class="plan-item-title card-title title">{{$data->name}}</h4>
                                                                <p class="sub-text">Enjoy entry level of invest & earn money.</p>
                                                            </div>
                                                            <div class="plan-item-summary card-text">
                                                                <div class="row">
                                                                    <div class="col-6"><span class="lead-text">{{$data->increment_amount}} @if($data->increment_type == "Fixed"){{$basic->currency_sym}} @else % @endif</span><span class="sub-text">{{$data->increment_interval}} Interest</span></div>
                                                                    <div class="col-6"><span class="lead-text">{{$basic->currency_sym}}{{number_format($data->gift, $basic->decimal)}}</span><span class="sub-text">Welcome Bonus</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="plan-item-body">
                                                            <div class="plan-item-desc card-text">
                                                                <ul class="plan-item-desc-list">
                                                                    <li><span class="desc-label">Min Investment</span> - <span class="desc-data">{{$basic->currency_sym}}{{number_format($data->min_price, $basic->decimal)}}</span></li>
                                                                    <li><span class="desc-label">Max Investment</span> - <span class="desc-data">{{$basic->currency_sym}}{{number_format($data->max_price, $basic->decimal)}}</span></li>
                                                                    <li><span class="desc-label">Investment Duration</span> - <span class="desc-data">{{$data->expiration}}</span></li>
                                                                   <li><span class="desc-label">Plan Referral Bonus</span> - <span class="desc-data">{{$data->referral}}%</span></li>
                                                                   
                                                                </ul>
                                                                <div class="plan-item-action">
                                                                    <label for="plan-iv-{{$data->id}}" class="plan-label"><span class="plan-label-base">Choose this plan</span><span class="plan-label-selected">Plan Selected</span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="plan-iv-actions text-center">
                                            <button type="submit" class="btn btn-primary btn-lg"><span>Continue to Invest</span> <em class="icon ni ni-arrow-right"></em></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
