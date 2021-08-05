@extends('include.dashboard')

@section('content')
   <div class="nk-content nk-content-fluid">
                        <div class="container-xl wide-lg">
                            <div class="nk-content-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">

                                        <h4 class="nk-block-title fw-normal">Payment Settings</h4>
                                        <div class="nk-block-des">
                                            <p>
                                                You have full control to manage your own account payment setting.
                                                <span class="text-primary"><em class="icon ni ni-info" data-toggle="tooltip" data-placement="right" title="Tooltip on right"></em></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-nav nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link" href="{{route('profile')}}">Personal</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('security')}}">Security</a></li>
                                    <li class="nav-item"><a class="nav-link  active" href="#">Payment Account</a></li>
                                   
                                </ul>
                                <div class="nk-block">
                                @if(Auth::user()->verified == 0)
                                    <!--<div class="alert alert-warning">
                                        <div class="alert-cta flex-wrap flex-md-nowrap">
                                            <div class="alert-text"><p>Verify your account to unlock full feature and increase your limit of transaction amount.</p></div>
                                            <ul class="alert-actions gx-3 mt-3 mb-1 my-md-0">
                                                <li class="order-md-last"><a href="{{ route('user.authorization')}}" class="btn btn-sm btn-warning">Verify</a></li>
                                                <li><a href="{{ route('user.authorization')}}" class="link link-primary">Learn More</a></li>
                                            </ul>
                                        </div>
                                    </div>-->
                                @endif
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Payment Details</h5>
                                            <div class="nk-block-des"><p>Basic payment details for fund withdrawal on {{$basic->sitename}}.</p></div>
                                        </div>
                                    </div>
                                    <div class="nk-data data-list">
                                        <div class="data-head"><h6 class="overline-title">Bitcoin Wallet Details</h6></div>
                                        
                                            </div>
                                        </div>
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                            <div class="data-col">
                                                <span class="data-label">Bitcoin Address</span>
                                                <span class="data-value">
                                                    {{isset(Auth::user()->btcwallet) ? Auth::user()->btcwallet : 'N/A'}}
                                                </span>
                                            </div>
                                            <div class="data-col data-col-end">
                                                <span class="data-more"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>





        <div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                        <h5 class="title">Update Profile</h5>
                        <ul class="nk-nav nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#personal">Bitcoin Wallet Details</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#address">Wallet Address</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="address">
                             <form method="post" action="{{route('post.banky') }}">
@csrf
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        
                                    </div>
   <div class="col-md-12">
                                        <div class="form-group"><label class="form-label" for="address-l1">Bitcoin Wallet Address</label><input type="text" class="form-control form-control-lg" id="address-l1" name="btc" value="{{isset(Auth::user()->btcwallet) ? Auth::user()->btcwallet : 'N/A'}}" /></div>
                                    </div>

                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li><input name="wallet" value="wallet" hidden>
                                            <button type="submit" value="" class="btn btn-lg btn-primary">Update Wallet</button></li>
                                            <li><a href="#" data-dismiss="modal" class="link link-light">Cancel</a></li>
                                        </ul>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
