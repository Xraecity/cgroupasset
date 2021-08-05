@extends('include.admindashboard')

@section('body')


<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">Withdrawal Methods</h4></div>
<a href="#" class="btn btn-auto btn-primary btn-xs"  data-toggle="modal" data-target="#myModal"><span>Create <span class="d-none d-xl-inline-block">New Method</span></span><em class="ti ti-plus"></em></a>

   <table class="data-table dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Name</th><th class="data-col dt-token">Min Amount</th><th class="data-col dt-amount">Max Amount</th> <th class="data-col dt-account">Charges</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>

@foreach($withdarws as $data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center"><div class="data-state data-state-approved"><span class="d-none">Pending</span></div><div class="fake-class"><span class="lead tnx-id"><a href="#">
                                            {{$data->name}}
                                        </a></span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{!! number_format($data->withdraw_min, $basic->decimal)  !!}</span><span class="sub sub-symbol">{{$basic->currency}}</span></td><td class="data-col dt-amount"><span class="lead amount-pay">{!! number_format($data->withdraw_max, $basic->decimal)  !!}</span><span class="sub sub-symbol">{{$basic->currency}} <em class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="1 ETH = 100 TWZ"></em></span></td><td class="data-col dt-account"><span class="lead user-info">{!! number_format($data->withdraw_percent, $basic->decimal)  !!}% & {{$basic->currency}}{!! number_format($data->fix, $basic->decimal)  !!}</span> </td><td class="data-col dt-type">

@if($data->status == 1)
<span class="dt-type-md badge badge-outline badge-success badge-md">Active</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
           @else
<span class="dt-type-md badge badge-outline badge-danger badge-md">Inactive</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">I</span>
@endif

</td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="#" data-toggle="modal" data-target="#my{{$data->id}}Modal"><em class="ti ti-pencil"></em> Edit Details</a></li><li><a href="{{route('del.withdraw.method',$data->id)}}"><em class="ti ti-trash"></em> Delete</a></li> </ul></div></div></td></tr><!-- .data-item -->






                                        <!-- Modal for Edit button -->
    <div class="modal fade" id="my{{$data->id}}Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong>Edit {{$data->name}} Withdrawal Method </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
              <form method="post" action="{{route('update.wsettings')}}">
              <div class="modal-body">
               <input name="id" value="{{$data->id}}" hidden>
							<label>Method name</label><br/>
							<input class="form-control form-control-solid h-auto"  placeholder="Enter Method name" type="text" name="name" value="{{$data->name}}" required><br/>
								 <label>Slogan</label><br/>
								 <input class="form-control form-control-solid h-auto"  placeholder="Enter Slogan" type="text" name="slogan" value="{{$data->slogan}}" required><br/>
								 <label>MIN. Request</label><br/>
            					  <input class="form-control form-control-solid h-auto"  placeholder="Enter minimum request" value="{{$data->withdraw_min}}" class="form-control" type="text" name="withdraw_min" required><br/>
            					  <label>MAX Request</label><br/>
								  <input class="form-control form-control-solid h-auto"  placeholder="Enter maximum request" value="{{$data->withdraw_max}}"type="text" name="withdraw_max" required><br/>

								<label>Fixed Charge</label><br/>
								<input class="form-control form-control-solid h-auto"   placeholder="Enter Fixed Charge" value="{{$data->fix}}" type="text" name="fix" required><br/>
							<label>Percentage Charge</label><br/>
								<input class="form-control form-control-solid h-auto"   placeholder="Enter Percetage Charge" type="text" value="{{$data->percent}}" name="percent" required><br/>
								 <!-- <label>Plan expected return (ROI)</label><br/>
								 <input style="padding:5px;" class="form-control" placeholder="Enter expected return for this plan" type="text" name="return" required><br/> -->


															 <label>Processing Duration <small>(days)</small></label><br/>
															 <input class="form-control form-control-solid h-auto"  placeholder="Enter Duration" type="text" value="{{$data->duration}}" name="duration" required><br/>

															 <label>Status</label><br/>
                               <select class="form-control" name="status">
									 <option value="1">Activate</option>
									<option value="0">Deactivate</option>
								</select><br>

					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<button type="submit" class="btn btn-primary">Update Method</button>
					   </form>
					   </div>
            </div>
        </div>
    </div>
@endforeach

<!-- .data-item --></tbody></table>

   </div></div></div></div></div>






   <!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong>Create New Method </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
              <form method="post" action="{{route('add.withdraw.method')}}">
              <div class="modal-body">

							<label>Method name</label><br/>
							<input class="form-control form-control-solid h-auto"  placeholder="Enter Method name" type="text" name="name" required><br/>
								 <label>Slogan</label><br/>
								 <input class="form-control form-control-solid h-auto"  placeholder="Enter Slogan" type="text" name="slogan" required><br/>
								 <label>MIN. Request</label><br/>
            					  <input class="form-control form-control-solid h-auto"  placeholder="Enter minimum request" class="form-control" type="text" name="withdraw_min" required><br/>
            					  <label>MAX Request</label><br/>
								  <input class="form-control form-control-solid h-auto"  placeholder="Enter maximum request" type="text" name="withdraw_max" required><br/>

								<label>Fixed Charge</label><br/>
								<input class="form-control form-control-solid h-auto"   placeholder="Enter Fixed Charge" type="text" name="fix" required><br/>
							<label>Percentage Charge</label><br/>
								<input class="form-control form-control-solid h-auto"   placeholder="Enter Percetage Charge" type="text" name="percent" required><br/>
								 <!-- <label>Plan expected return (ROI)</label><br/>
								 <input style="padding:5px;" class="form-control" placeholder="Enter expected return for this plan" type="text" name="return" required><br/> -->


															 <label>Processing Duration <small>(days)</small></label><br/>
															 <input class="form-control form-control-solid h-auto"  placeholder="Enter Duration" type="text" name="duration" required><br/>

					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<button type="submit" class="btn btn-primary">Create Method</button>
					   </form>
					   </div>
            </div>
        </div>
    </div>
@endsection
