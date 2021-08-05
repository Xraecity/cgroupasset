@extends('include.dashboard')


@section('content') <div class="nk-content nk-content-fluid">
                        <div class="container-xl wide-lg">
                            <div class="nk-content-body">
                                  <div class="nk-block-head-xs">
                                                    <div class="nk-block-between g-2">
                                                        <div class="nk-block-head-content"><h6 class="nk-block-title title">Select Giftcard</h6></div>
                                                        <div class="nk-block-head-content">
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="toggle-expand-content expanded" data-content="quick-access">
                                                    
                                                    <div class="nk-files nk-files-view-grid">
                                                        <div class="nk-files-list">
                                                            
                                                             @foreach($currency as $gate)
                                                            <div class="nk-file-item nk-file">
                                                                <div class="nk-file-info">
                                                                    <a href="{{ route('selectgiftcard' , $gate->id) }}" class="nk-file-link">
                                                                        <div class="nk-file-title">
                                                                            <div class="nk-file-icon">
                                                                                <span class="nk-file-icon-type">
                                                                                    <img src="{{asset('giftcards')}}/{{$gate->image}}" width="100">
                              
                                                                                </span>
                                                                            </div>
                                                                            <div class="nk-file-name">
                                                                                <div class="nk-file-name-text"><span href="#" class="title">{{$gate->name}}</span></div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="nk-file-actions hideable">
                                                                    <a href="#" class="btn btn-sm btn-icon btn-trigger"><em class="icon ni ni-check"></em></a>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            
                                                            
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                </div>
                                            </div> 


@stop
