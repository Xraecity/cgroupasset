@extends('include.admindashboard')

@section('body')
    <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head"><h4 class="card-title">Giftcards List</h4></div><table class="data-table dt-init user-list"><thead><tr class="data-item data-head"><th class="data-col dt-user">Name</th> <th class="data-col dt-token">Icon</th>  <th class="data-col dt-status"><div class="dt-status-text">Status</div></th><th class="data-col"></th></tr></thead><tbody>
<a href="#" data-toggle="modal" data-target="#createcoin" class="btn btn-sm btn-primary btn-outline"><em class="ti ti-giftcard"></em>New Giftcard</a>
 


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

</td><td class="data-col text-right"><div class="relative d-inline-block"><a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('editcard',$data->id)}}"><em class="ti ti-eye"></em> View Details</a></li>
@if($data->status != 1)
<li><a href="{{route('activatecard',$data->id)}}"><em class="ti ti-check"></em> Activate</a></li>
@endif
@if($data->status == 1)
<li><a href="{{route('deactivatecard',$data->id)}}"><em class="ti ti-na"></em> Deactivate</a></li>
@endif
<li><a href="{{route('deletecard',$data->id)}}"><em class="ti ti-trash"></em> Delete</a></li></ul></div></div></td></tr>
@endforeach

<!-- .data-item --></tbody></table></div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->





<!-- .modal-dialog --></div><!-- Modal End --><div class="modal fade" id="createcoin2" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Create New Giftcard</h4> <p>Fill the form below to create a new giftcard for the system..</p>

<div class="input-item input-with-label">

<form role="form" method="POST" action="{{route('storecard')}}" name="editForm" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight">Giftcard Name:</label>
                                        <div class="input-group">
                                            <input type="text" class="input-bordered" placeholder="Currency  Name" value="{{old('name')}}"
                                                   name="name">

                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight"> Giftcard Symbol:</label>
                                        <input type="text"class="input-bordered"  placeholder="Currency Symbol" value="{{old('image')}}"
                                               name="image">


                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label class="input-item-label text-exlight">Giftcard Charge:</label>
                                        <div class="input-group">

                                            <input type="text" name="buy"  value="{{old('price')}}" class="input-bordered"
                                                   ">
                                        </div>

                                    </div>






                                </div>




                            </div><!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit" class="btn btn-primary">Create Giftcard</button></form></li><li class="pdt-1x pdb-1x"><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#pay-online" class="link link-primary">Cancel</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->
                            
                            
                            
                            
                            
                            <!-- .modal-dialog --></div><!-- Modal End --><div class="modal fade" id="createcoin" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Create New Giftcard</h4> <p>Fill the form below to create a new giftcard for the system..</p>

<div class="input-item input-with-label">

<form role="form" method="POST" action="{{route('storecard')}}" name="editForm" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="input-item-label text-exlight">Giftcard Name:</label>
                                        <div class="input-group">
                                            <input type="text" class="input-bordered" placeholder="Currency  Name" value="{{old('name')}}"
                                                   name="name">

                                        </div>

                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="input-item-label text-exlight"> Giftcard Image:</label>
                                        <input type="file" class="input-bordered" name="photo">


                                    </div>

                                </div> 




                            </div><!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit" class="btn btn-primary">Create Giftcard</button></form></li><li class="pdt-1x pdb-1x"><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#pay-online" class="link link-primary">Cancel</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->
@endsection
