@extends('include.dashboard')


@section('content')

  
  
  
     <div class="nk-content nk-content-fluid">
                        <div class="container-xl wide-lg">
                            <div class="nk-content-body">
                                <div class="buysell  ">
                                    <div class="buysell-nav text-center">

                                    </div>
                                    <div class="buysell-title text-center"><h4 class="title">Exchange Giftcard</h4></div>
                                    <div class="buysell-block">

                                       <form role="form" method="POST" action="{{ route('excard') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}

<script>
function myFunction() {
 var usd = $('#usd').val() ;
 var name = $("#single option:selected").attr('data-name');
 var rate = $("#single option:selected").attr('data-exrate');
 var cur = $("#single option:selected").attr('data-cur');
 var rate2 = usd*rate;
 document.getElementById("exrate").innerHTML = "{{$basic->currency_sym}}"+rate2;
 document.getElementById("rate").innerHTML = "Rate: 1"+cur+" = {{$basic->currency_sym}}"+rate;
 document.getElementById("name").innerHTML = name;
 

 };
</script>


                                            <div class="buysell-field form-group">
                                                <div class="form-label-group"><label class="form-label">Select Giftcard Type</label></div>
                                                
                                         <select required  class="form-control form-control-lg"  id="single" onchange="myFunction()" name="type">
                                        <option data-cur="0" selected> Select Giftcard Type</option>
                                        @foreach($type as $data)
                                        <option data-exrate="{{$data->rate}}" data-name="{{$data->name}}"data-cur="{{$data->currency}}"  value="{{$data->id}}">{{$data->name}} </option>
                                        @endforeach
                                        </select></div>

                                                <div class="dropdown buysell-cc-dropdown">
                                                    <a href="#" class="buysell-cc-choosen dropdown-indicato" >
                                                        <div class="coin-item coin-btc">
                                                            <div class="coin-icon" id="image"><img src="{{asset('giftcards')}}/{{$card->image}}" width="50"
                              ></div>
                                                            <div class="coin-info"><span class="coin-name" id="name">Please Select Card Type</span><span id="rate" class="coin-text"> No Card Type Selected</span></div>
                                                        </div>
                                                    </a>
                                                   
                                                </div>
                                            </div>
                                            
                                            
                                           <br>
                                            <div class="buysell-field form-group">
                                                <div class="form-label-group"><label class="form-label" for="buysell-amount">Amount Of Card</label></div>
                                                <div class="form-control-group">
                                                    <input type="number" id="usd" onkeyup="myFunction()"   class="form-control form-control-lg form-control-number" name="amount"  placeholder=" 0.00" />
                                                     
                                                </div>
                                                <div class="form-note-group"><span class="buysell-min form-note-alt"><a id="exrate"></a></span><span class="buysell-rate form-note-alt"></span></div>








                                                <br>
                                         <script type="text/javascript">

                                            function goDoSomething(identifier){

                                     document.getElementById("type").innerHTML = $(identifier).data('id');
                                     document.getElementById("tocard").value = $(identifier).data('id');
                                    
                                   
                                     document.getElementById("icon2").innerHTML = "<img src='"+$(identifier).data('id2')+"' width='50'>";

                                }
                              </script>

                                                <div class="buysell-field form-group">
                                                <div class="form-label-group"><label class="form-label">Select Type</label></div>

                                                <div class="dropdown buysell-cc-dropdown">
                                                    <a href="#" class="buysell-cc-choosen dropdown-indicator" data-toggle="dropdown">
                                                        <div class="coin-item coin-btc">
                                                            <div class="coin-icon" id="icon2"><em class="icon ni ni-gift"></em></div>
                                                            <div class="coin-info"><span class="coin-name" id="type">Select</span><span class="coin-text">Giftcard Type</span></div>
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
                                                        <ul class="buysell-cc-list">

                                                         <li class="buysell-cc-item"  onclick="goDoSomething(this);"  data-upload="1"  data-id="Physical" data-id2="{{asset('giftcards')}}/{{$card->image}}">
                                                                <a href="#" class="buysell-cc-opt" data-currency="eth">
                                                                    <div class="coin-item coin-eth">
                                                                        <div class="coin-icon"><div class="coin-icon" id="image"><img src="{{asset('giftcards')}}/{{$card->image}}" width="50"
                              ></div></div>
                                                                        <div class="coin-info"><span class="coin-name">Physical</span><span class="coin-text">Card</span></div>
                                                                    </div>
                                                                </a>
                                                            </li>

                                                             <li class="buysell-cc-item"  onclick="goDoSomething(this);"    data-id="Digital"  data-upload="0" data-id2="{{asset('giftcards')}}/digit.jpg">
                                                                <a href="#" class="buysell-cc-opt" data-currency="eth">
                                                                    <div class="coin-item coin-eth">
                                                                        <div class="coin-icon"><div class="coin-icon" id="image"><img src="{{asset('giftcards')}}/digit.jpg" width="50"
                              ></div></div>
                              <input name="typeofcard" hidden id="tocard">
                              <input name="card" hidden value="{{$card->id}}">
                                                                        <div class="coin-info"><span class="coin-name">&nbsp;&nbsp; Digital</span><span class="coin-text">&nbsp;&nbsp; Card</span></div>
                                                                    </div>
                                                                </a>
                                                            </li>





                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                             
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-06">Giftcard Front View <small>(Physical) </small></label></label>
                                                                <div class="form-control-wrap">
                                                                    <div class="custom-file">
                                                                        <input name='front' accept='image/*' type="file" multiple class="custom-file-input" id="customFile">
                                                                        <label class="custom-file-label" for="customFile">Upload</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                
                                             
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-067">Giftcard Back View <small>(Physical) </small></label>
                                                                <div class="form-control-wrap">
                                                                    <div class="custom-file">
                                                                        <input type="file" name='back' accept='image/*' class="custom-file-input" id="customFile1">
                                                                        <label class="custom-file-label" for="customFile1">Upload</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                        
                                        
                                        
                                        <div class='form-label-group'><label class='form-label' for='buysell-amount'>Enter Gift Card Code <small>(Digital)</small></label></div><input type='text'  placeholder='QWERTY*******' class='form-control form-control-lg form-control-number'  name='code' ></div><br>



<div class="buysell-field form-action"><button  type="submit"  class="btn btn-lg  btn-outline btn-primary" >Confirm Trade</button></div>

 </div></div></div></div></div></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
      
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $("#single").select2({
          placeholder: "Select giftcard type",
          allowClear: true
      });
    </script>                      



@stop
