@extends('include.admindashboard')

@section('body')
   <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Investment Plans</h4></div><table class="data-table dt-init user-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Plan Name</th><th class="data-col dt-token">Min/Max Amount</th> <th class="data-col dt-type"><div class="dt-type-text">Status</div></th> </tr></thead><tbody>

<a href="#" class="btn btn-auto btn-primary btn-xs"  data-toggle="modal" data-target="#myModal"><span>Create <span class="d-none d-xl-inline-block">New</span></span><em class="ti ti-plus"></em></a>
@foreach($plans as $plan)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center"><div class="data-state data-state-approved"><span class="d-none">Active</span></div><div class="fake-class"><span class="lead tnx-id">{{$plan->name}}</span><span class="sub sub-date">{{$plan->expiration}} Duration</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{{$basic->currency_sym}}{{number_format($plan->min_price,2)}} - {{$basic->currency_sym}} {{number_format($plan->max_price,2)}}</span> </td> <td class="data-col dt-type"><span class="dt-type-md badge badge-outline badge-success badge-md">Active</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span></td><td class="data-col text-right"><div class="relative d-inline-block d-md-none"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-center-left pd-2x"><ul class="data-action-list"><li><a href="#" class="btn btn-auto btn-primary btn-xs"  data-toggle="modal" data-target="#myModal"><span>Edit <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-pencil"></em></a></li><li><a href="{{route('admin.inv.delete',$plan->id)}}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li></ul></div></div><ul class="data-action-list d-none d-md-inline-flex"><li><a href="#" data-toggle="modal" data-target="#my{{$plan->id}}Modal" class="btn btn-auto btn-primary btn-xs"><span>Edit <span class="d-none d-xl-inline-block">Now</span></span><em class="ti ti-pencil"></em></a></li><li><a href="{{route('admin.inv.delete',$plan->id)}}" class="btn btn-danger-alt btn-xs btn-icon"><em class="ti ti-trash"></em></a></li></ul></td></tr>


 <!-- Modal for Edit button -->
    <div class="modal fade" id="my{{$plan->id}}Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong> Update {{$plan->name}} </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <form style="padding:3px;" role="form" method="post" action="{{route('updateplan')}}">
                 <div class="modal-body">

					  <label>Plan name</label><br/>
					  <input style="padding:5px;" class="form-control" value="{{$plan->name}}" type="text" name="name" required><br/>

					   <div class="form-group">
					  <label>Plan price</label><br/>
					  <input style="padding:5px;" class="form-control" value="{{$plan->price}}" type="text" name="price" required><br/>
					  </div>

					  <label>Plan MIN. Investment</label><br/>
					  <input style="padding:5px;" class="form-control" value="{{$plan->min_price}}" type="text" name="min_price" required><br/>
					  <label>Plan MAX. Investment</label><br/>
					  <input style="padding:5px;" class="form-control" value="{{$plan->max_price}}" type="text" name="max_price" required><br/>

					<label>Gift Bonus</label><br/>
					<input style="padding:5px;" class="form-control" value="{{$plan->gift}}"  placeholder="Enter Additional Gift Bonus" type="text" name="gift" required><br/>

					<label>Referral Bonus (%)</label><br/>
					<input style="padding:5px;" class="form-control" value="{{$plan->referral}}"  placeholder="Enter Plan Referral Bonus" type="text" name="referral" required><br/>


					  <!-- <label>Plan expected return (ROI)</label><br/>
					  <input style="padding:5px;" class="form-control" placeholder="Enter expected return" value="{{$plan->expected_return}}" type="text" name="return" required><br/> -->


								 <label>top up interval</label><br/>
                               <select class="form-control" name="t_interval">
									<option>{{$plan->increment_interval}}</option>
									<option>Monthly</option>
									<option>Weekly</option>
									<option>Daily</option>
									<option>Hourly</option>
								</select><br>
								<label>top up type</label><br/>
                               <select class="form-control" name="t_type">
									<option>{{$plan->increment_type}}</option>
									<option>Percentage</option>
									<option>Fixed</option>
								</select><br>
								<label>top up amount (in % or $ as specified above)</label><br/>
                               <input style="padding:5px;" class="form-control" value="{{$plan->increment_amount}}" placeholder="top up amount" type="text" name="t_amount" required><br/>
							   <label>Investment duration</label><br/>
                               <select class="form-control" name="expiration">
									<option>{{$plan->expiration}}</option>
								     	<option>One week</option>
																		<option>Three weeks</option>
																		<option>Four weeks</option>
																	    <option>Five weeks</option>
																	    <option>Four months</option>
																	    <option>Five months</option>
																	    <option>Six months</option>
																		<option>Seven months</option>
																		<option>Eight months</option>
																		<option>Nine months</option>
																		<option>Ten months</option>
																		<option>Eleven months</option>
																		<option>One year</option>
								</select><br>
							   <input type="hidden" name="id" value="{{ $plan->id }}">
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<input type="submit" class="btn btn-primary" value="Submit"></div>
					   </form>
            </div>
        </div>
    </div>

@endforeach

<!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank"></i> <strong class="abir_act"></strong>Create New Plan </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
              <form method="post" action="{{route('addplan')}}">
              <div class="modal-body">
							<label>Plan name</label><br/>
							<input class="form-control form-control-solid h-auto"  placeholder="Enter Plan name" type="text" name="name" required><br/>
								 <label>Plan price</label><br/>
								 <input class="form-control form-control-solid h-auto"  placeholder="Enter Plan price" type="text" name="price" required><br/>
								 <label>Plan MIN. Investment</label><br/>
            					  <input class="form-control form-control-solid h-auto"  placeholder="Enter Plan minimum price" class="form-control" type="text" name="min_price" required><br/>
            					  <label>Plan MAX. Investment</label><br/>
								  <input class="form-control form-control-solid h-auto"  placeholder="Enter Plan maximum price" type="text" name="max_price" required><br/>

								<label>Welcome Bonus</label><br/>
								<input class="form-control form-control-solid h-auto"   placeholder="Enter Additional Joining Bonus" type="text" name="gift" required><br/>
                                
                                	<label>Referral Bonus (%)</label><br/>
					<input style="padding:5px;" class="form-control"  placeholder="Enter Plan Referral Bonus" type="text" name="referral" required><br/>


								<label>top up interval</label><br/>
                               <select class="form-control form-control-solid h-auto"   name="t_interval">
									<option>Monthly</option>
									<option>Weekly</option>
									<option>Daily</option>
									<option>Hourly</option>
								</select><br>
								 <label>top up type</label><br/>
                               <select class="form-control form-control-solid h-auto"  name="t_type">
																		<option>Percentage</option>
																		<option>Fixed</option>
															 </select><br>
															 <label>top up amount (in % or $ as specified above)</label><br/>
															 <input class="form-control form-control-solid h-auto"  placeholder="top up amount" type="text" name="t_amount" required><br/>
															 <label>Investment duration</label><br/>
                               <select class="form-control form-control-solid h-auto"  name="expiration">
																		<option>One week</option>
																		<option>One month</option>
																		<option>Two months</option>
																	    <option>Three months</option>
																	    <option>Four months</option>
																	    <option>Five months</option>
																	    <option>Six months</option>
																		<option>Seven months</option>
																		<option>Eight months</option>
																		<option>Nine months</option>
																		<option>Ten months</option>
																		<option>Eleven months</option>
																		<option>One year</option>
															 </select><br>
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<button type="submit" class="btn btn-primary">Create Plan</button>
					   </form>
					   </div>
            </div>
        </div>
    </div>


<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->
@endsection
