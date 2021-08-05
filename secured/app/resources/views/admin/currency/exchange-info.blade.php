@extends('include.admindashboard')

@section('body')


<script>
function goBack() {
  window.history.back()
}
</script>

   <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Transaction Details</h4><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{{date('d M Y',strtotime($exchange->created_at))}}</span></div><div class="fake-class"><span class="data-details-title">Tranx Status</span> @if( $exchange->status == 1 )
                                                <span class="badge badge-success">Success</span>
                                            @elseif( $exchange->status == 2 )
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif</div><div class="fake-class"><span class="data-details-title">Tranx Time</span><span class="data-details-info"> {{$exchange->created_at}}</span></div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Info</h6><ul class="data-details-list"><li><div class="data-details-head">Customer</div><div class="data-details-des"><strong>{{isset($exchange->user->username) ? $exchange->user->username : 'No User Available'}}</strong></div></li><!-- li --><li><div class="data-details-head">Amount</div><div class="data-details-des"><strong>{{number_format($exchange->amount, $basic->decimal)}} {{$exchange->country}}</strong></div></li><!-- li --><li><div class="data-details-head">Giftcard</div><div class="data-details-des"><strong>{{App\Giftcard::whereId($exchange->card_id)->first()->name}}</strong></div></li><!-- li -->
                                            <li><div class="data-details-head">Giftcard Type</div><div class="data-details-des"><strong>{{App\Giftcardtype::whereId($exchange->currency)->first()->name}}</strong></div></li><!-- li --><li><div class="data-details-head">Value In {{$basic->currency}}</div><div class="data-details-des"><span>{{$basic->currency_sym}}{{number_format($exchange->amount*$exchange->rate, $basic->decimal)}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">Transaction ID</div><div class="data-details-des"><span>{{$exchange->trx}} </span> <span></span></div></li><!-- li --></ul><!-- .data-details --><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Details</h6><ul class="data-details-list"> <!-- li --><li>






<li><div class="data-details-head">Gift Card Number</div><div class="data-details-des"><span><strong>{{isset($exchange->code) ? $exchange->code : 'Not Available Fot This Trade'}}</strong></span></div></li>
 @if($exchange->image)
<li><br><div class="data-details-head">Front View</div><div class="data-doc-item data-doc-item-lg"><div class="data-doc-image"><img src="{{asset('giftcards/'.$exchange->image)}}" alt="passport"></div><ul class="data-doc-actions"><li><a href="{{asset('giftcards/'.$exchange->image)}}" download><em class="ti ti-import"></em></a></li></ul></div></li>
@endif
 @if($exchange->image2)
<li><br><div class="data-details-head">Back View</div><div class="data-doc-item data-doc-item-lg"><div class="data-doc-image"><img src="{{asset('giftcards/'.$exchange->image2)}}" alt="passport"></div><ul class="data-doc-actions"><li><a href="{{asset('giftcards/'.$exchange->image2)}}" download><em class="ti ti-import"></em></a></li></ul></div></li>
@endif
<!-- li --></ul><!-- .data-details --></div></div><!-- .card --></div><!-- .container --></div>
@endsection
@section('script')
@endsection
