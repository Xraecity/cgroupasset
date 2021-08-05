@extends('include.admindashboard')

@section('body')

<script>
function goBack() {
  window.history.back()
}
</script>


<div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Investment Details</h4><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Request Date</span><span class="data-details-info">{{$inv->created_at}}</span></div><div class="fake-class"><span class="data-details-title">Request Status</span>


 @if($inv->status == "yes")
            <span  class="badge  badge-pill badge-info "> Expired </span>
                                        @else
            <span class="badge  badge-pill  badge-success ">Running </span>
                                        @endif


 @php
                                                if($plan->increment_type == "Percentage")
                                                {
                                                $return = ($inv->amount*$plan->increment_amount)/100*$plan->cycle;
                                                }
                                                else
                                                {
                                                $return = $plan->increment_amount*$plan->cycle;
                                                }

                                                @endphp
</div><div class="fake-class"><span class="data-details-title">Username</span><span class="data-details-info">  <strong>{{App\User::whereId($inv->user)->first()->username}}</strong> ({{App\User::whereId($inv->user)->first()->email}})</span></div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Info</h6><ul class="data-details-list"><li><div class="data-details-head">Investment Name</div><div class="data-details-des"><strong>{{$plan->name}}</strong></div></li><!-- li --><li><div class="data-details-head">Duration</div><div class="data-details-des"><strong>{{$plan->expiration}}  </strong></div></li>

<li><div class="data-details-head">Interest</div><div class="data-details-des"><strong>{{$plan->increment_amount}} @if($plan->increment_type == "Fixed") {{$basic->currency}} @else % @endif <small>-  {{$plan->increment_interval}}</small></strong></div></li>

<li><div class="data-details-head">Interest Cycle</div><div class="data-details-des"><strong>{{$inv->cycle}} <small>-  times</small></strong></div></li>

<!-- li --><li><div class="data-details-head">Amount Invested</div><div class="data-details-des"><strong>{{$basic->currency}} {{number_format($inv->amount,2)}}
</strong></div></li><!-- li --><li><div class="data-details-head">Expected Return</div><div class="data-details-des"><span>{{$basic->currency}} {{number_format($return+$inv->amount,2)}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">Total Return</div><div class="data-details-des"><span>{{number_format(App\Tp_transactions::wherePlan_id($inv->trx)->sum("amount"),2)}}{{$basic->currency}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">TRX ID</div><div class="data-details-des">{{$inv->trx}}</div></li><!-- li --></ul><!-- .data-details --><div class="gaps-3x"></div> <div class="nk-block nk-block-lg">
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
                                </div><!-- .data-details --></div></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@endsection
