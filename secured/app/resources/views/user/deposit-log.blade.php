@extends('include.dashboard')
@section('content')
    <div class="nk-content">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Deposit Log</h3>
                                                @php
                                                 $count = \App\Deposit::whereUser_id(Auth::user()->id)->count();
                                                 @endphp
                                                <div class="nk-block-des text-soft"><p>You have a total of {{$count}} deposit{s}</p></div>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                    <div class="toggle-expand-content" data-content="pageMenu">
                                                        <ul class="nk-block-tools g-3">
                                                            <li>
                                                                <a href="#" class="btn btn-white btn-dim btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="card card-bordered card-stretch">
                                            <div class="card-inner-group">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title"><h5 class="title">All Deposits</h5></div>
                                                        <div class="card-tools mr-n1">
                                                            <ul class="btn-toolbar gx-1">
                                                                <li>
                                                                    <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
                                                                </li>
                                                                <li class="btn-toolbar-sep"></li>

                                                            </ul>
                                                        </div>
                                                        <div class="card-search search-wrap" data-search="search">
                                                            <div class="search-content">
                                                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction" />
                                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-tnx">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col"><span>Details</span></div>
                                                            <div class="nk-tb-col tb-col-xxl"><span>Source</span></div>
                                                            <div class="nk-tb-col"><span>Order ID</span></div>
                                                            <div class="nk-tb-col text-right"><span>Amount</span></div>
                                                            <div class="nk-tb-col text-right tb-col-sm"><span>Date</span></div>
                                                            <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Status</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools"></div>
                                                        </div>
                                                        @if(count($deposit) >0)
                                                         @foreach($deposit as $k=>$data)
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col">
                                                                <div class="nk-tnx-type">
                                                                    @if($data->status == 1)
                                                                   <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                                    @elseif($data->status == 0)
                                                                    <div class="nk-tnx-type-icon bg-secondary-dim text-secondary">
                                                                    @elseif($data->status == -2)
                                                                    <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                                   @elseif($data->status == 2)
                                                                    <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                                    @endif

                                                                    <em class="icon ni ni-wallet"></em></div>
                                                                    <div class="nk-tnx-type-text"><span class="tb-lead">{{isset($data->gateway->name) ? $data->gateway->name : 'N/A'}}</span><span class="tb-date">{!! date(' d/M/Y', strtotime($data->created_at)) !!}</span></div>
                                                                </div>
                                                            </div>
                                                             <div class="nk-tb-col tb-col-dlg"><span class="tb-lead">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</span><span class="badge badge-dot badge-success">Deposit</span></div>
                                                            <div class="nk-tb-col text-right">
                                                                <span class="tb-amount">{{$data->amount}} <span>{{$basic->currency}}</span></span><span class="tb-amount-sm">{{$data->usd}} USD</span>
                                                            </div>
                                                            <div class="nk-tb-col text-right tb-col-sm">
                                                                <span class="tb-amount">{{ Carbon\Carbon::parse($data->updated_at)->diffForHumans() }} <span></span></span><span class="tb-amount-sm">{{$data->updated_at}}</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-status">
                                                                <div class="dot dot-success d-md-none"></div>
                                                                 @if($data->status == 1)
                                                                   <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">Completed</span>
                                                                    @elseif($data->status == 0)
                                                                    <span class="badge badge-sm badge-dim badge-outline-secondary d-none d-md-inline-flex">Unpaid</span>
                                                                    @elseif($data->status == -2)
                                                                    <span class="badge badge-sm badge-dim badge-outline-danger d-none d-md-inline-flex">Declined</span>
                                                                   @elseif($data->status == 2)
                                                                    <span class="badge badge-sm badge-dim badge-outline-warning d-none d-md-inline-flex">Pending</span>
                                                                    @endif



                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-2">

                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#tranxDetails{{$data->id}}" data-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>






                                                        <div class="modal fade" tabindex="-1" id="tranxDetails{{$data->id}}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    <div class="modal-body modal-body-md">
                        <div class="nk-modal-head mb-3 mb-sm-5">
                            <h4 class="nk-modal-title title">Transaction <small class="text-primary">#{{$data->trx}}</small></h4>
                        </div>
                        <div class="nk-tnx-details">
                            <div class="nk-block-between flex-wrap g-3">
                                <div class="nk-tnx-type">
                                     @if($data->status == 1)
                                                                   <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                                    @elseif($data->status == 0)
                                                                    <div class="nk-tnx-type-icon bg-secondary-dim text-warning">
                                                                    @elseif($data->status == -2)
                                                                    <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                                  @elseif($data->status == 2)
                                                                    <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                                    @endif


                                    <em class="icon ni ni-wallet"></em></div>
                                    <div class="nk-tnx-type-text">
                                        <h5 class="title">{{$basic->currency}}{{$data->amount}}</h5>
                                        <span class="sub-text mt-n1">{!! date('D, d/M, Y: h:m A', strtotime($data->created_at)) !!}</span>
                                    </div>
                                </div>
                                <ul class="align-center flex-wrap gx-3">
                                    <li>
                                     @if($data->status == 1)
                                                                   <span class="badge badge-sm badge-success">Completed</span>
                                                                    @elseif($data->status == 0)
                                                                    <span class="badge badge-sm badge-secondary">Unpaid</span>
                                                                   @elseif($data->status == 2)
                                                                    <span class="badge badge-sm badge-warning">Pending</span>
                                                                    @elseif($data->status == -2)
                                                                    <span class="badge badge-sm badge-danger">Declined</span>
                                                                    @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="nk-modal-head mt-sm-5 mt-4 mb-4"><h5 class="title">Transaction Info</h5></div>
                            <div class="row gy-3">
                                <div class="col-lg-6"><span class="sub-text">Order ID</span><span class="caption-text">{{$data->id}}</span></div>
                                <div class="col-lg-6"><span class="sub-text">Reference ID</span><span class="caption-text text-break">{{$data->trx}}</span></div>
                                <div class="col-lg-6"><span class="sub-text">Transaction Fee</span><span class="caption-text">{{$basic->currency}}{{$data->charge}}</span></div>
                                <div class="col-lg-6"><span class="sub-text">Amount</span><span class="caption-text">{{$basic->currency}}{{$data->amount}}</span></div>
                            </div>
                            <div class="nk-modal-head mt-sm-5 mt-4 mb-4"><h5 class="title">Transaction Details</h5></div>
                            <div class="row gy-3">
                                <div class="col-lg-6"><span class="sub-text">Transaction Type</span><span class="caption-text">Deposit</span></div>
                                <div class="col-lg-6">
                                    <span class="sub-text">Payment Gateway</span><span class="caption-text align-center">{{isset($data->gateway->name) ? $data->gateway->name : 'N/A'}} <span class="badge badge-primary ml-2 text-white">Online Gateway</span></span>
                                </div>
                                @if($data->status == 1)
                                <div class="col-lg-12"><span class="sub-text">Details</span><span class="caption-text">Deposit has been approved</span></div>
                                                                    @elseif($data->status == 0)
                                                                    <div class="col-lg-12"><span class="sub-text">Details</span><span class="caption-text">Deposit is unprocessed</span></div>
                                                                    @elseif($data->status == 2)
                                                                    <div class="col-lg-12"><span class="sub-text">Details</span><span class="caption-text">Deposit is still pending</span></div>
                                                                    @elseif($data->status == -2)
                                                                    <div class="col-lg-12"><span class="sub-text">Details</span><span class="caption-text">Deposit has been declined</span></div>
                                                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



                                                         @endforeach
                                                         @else
                                                         No Deposit
                                                         @endif


                                                    </div>
                                                </div>
                                                <div class="card-inner">
                                                    <ul class="pagination justify-content-center justify-content-md-start">
                                                       {{ $deposit->links() }}
                                                    </ul>
                                                </div>







                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>@stop
