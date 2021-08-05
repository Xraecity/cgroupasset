@extends('include.admindashboard')

@section('body')
    <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Available Giftcards List</h4></div><table class="data-table dt-init user-list"><thead><tr class="data-item data-head"><th class="data-col dt-user">Name</th> <th class="data-col dt-token">Image</th>  <th class="data-col dt-status"><div class="dt-status-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>
  


 @foreach($currency as $k=>$data)
<tr class="data-item"><td class="data-col dt-user"><span class="lead user-name">{{$data->name }}</span><span class="sub user-id"></span></td> <td class="data-col dt-token"><span class="lead lead-btoken">
    <img src="{{asset('giftcards')}}/{{$data->image}}" width="100"
                             alt="{{$data->image}}"></span></td>

<td class="data-col dt-status">

@if($data->status == 1)
<span class="dt-status-md badge badge-outline badge-success badge-md">Active</span>
<span class="dt-status-sm badge badge-sq badge-outline badge-success badge-md">A</span>
@else
<span class="dt-status-md badge badge-outline badge-danger badge-md">Inactive</span>
<span class="dt-status-sm badge badge-sq badge-outline badge-danger badge-md">I</span>
@endif

</td><td class="data-col text-right"><div class="relative d-inline-block"><a href="{{route('editcardtype',$data->id)}}" class="btn btn-light-alt btn-xs btn-icon  "><em class="ti ti-more-alt"></em></a> </div></td></tr>
@endforeach

<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->





 
@endsection
