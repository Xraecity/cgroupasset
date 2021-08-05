@extends('include.admindashboard')

@section('body')


<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr table-responsive"><div class="card-head"><h4 class="card-title">Running Investment</h4></div>


   <table class="data-table  dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Username</th><th class="data-col dt-token">Amount</th><th class="data-col dt-token">Plan</th> <th class="data-col dt-token">Code</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

@foreach($plans as $data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center">
<div class="data-state data-state-progress">

</div><div class="fake-class"><span class="lead tnx-id"><a href="{{route('user.single',App\User::whereId($data->user)->first()->id)}}">
                                            {{App\User::whereId($data->user)->first()->username}}
                                        </a></span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{!! number_format($data->amount, $basic->decimal)  !!}</span><span class="sub sub-symbol">{{$basic->currency}}</span></td><td class="data-col dt-token"><span class="lead dt-token">{{App\Plan::whereId($data->plan)->first()->name}}</span></td><td class="data-col dt-token"><span class="lead user-info">{{$data->trx}}</span> </td><td class="data-col dt-type"><span class="dt-type-md badge badge-outline badge-info badge-md">Running</span><span class="dt-type-sm badge badge-sq badge-outline badge-info badge-md">R</span></td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('invview',$data->trx)}}"><em class="ti ti-eye"></em> View Process</a></li><li><a href="{{route('terminateinv',$data->id)}}"><em class="ti ti-na"></em> End Process</a></li  </ul></div></div></td></tr><!-- .data-item -->
@endforeach

<!-- .data-item --></tbody></table>

   </div></div></div></div></div>
@endsection
