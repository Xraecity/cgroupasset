@extends('include.admindashboard')

@section('body')
  <div class="page-header"><div class="container"><div class="row justify-content-center"><div class="col-lg-8 col-xl-7 text-center"><h5 class="page-title">Update Card Type</h5></div></div></div><!-- .container --></div><div class="page-content"><div class="container"><div class="row"> <div class="col-lg-12"><div class="content-area card"><div class="card-innr card-innr-fix2"><div class="card-head"><h6 class="card-title"> Giftcard Type: {{$giftcard->name}}</h6></div><div class="gaps-1x"></div><!-- .gaps -->

  <form role="form" method="POST" action="{{route('postcardtype' )}}"
     name="editForm" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="row">



  <div class="col-xl-12 col-sm-12"><div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Card Name</label><input type="text" class="input-bordered"
                                           name="name"        placeholder="Card Name" value="{{$giftcardtype->name}}">
<input hidden name="id" value="{{$giftcardtype->id}}">

                                                   </div>
                                                   
                                                   
                                                   <div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Card Currency</label><input type="text" class="input-bordered"
                                           name="currency"        placeholder="Card Currency" value="{{$giftcardtype->currency}}">

                                                   </div>
                                                   <div class="input-item input-with-label"><label class="input-item-label ucap text-exlight">Card Rate</label><input type="text" class="input-bordered"
                                           name="rate"        placeholder="Card Currency" value="{{$giftcardtype->rate}}">

                                                   </div>
                                                   
                                                   
                                                   </div>
                                               
                                               
                                               
                                               
                                               </div>  </div><!-- .card-innr -->

    <div class="form-group col-md-12 ">
                                        <button class="btn btn-primary btn-lg">Update Giftcard</button></form>
                                    </div>
</div><!-- .card -->

                                                   </div> </div><!-- .card-innr --></div><!-- .card --></div></div></div><!-- .container --></div>
@stop
