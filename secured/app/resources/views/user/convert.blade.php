@extends('include.dashboard')


@section('content')
     <div class="nk-content nk-content-fluid">
                        <div class="container-xl wide-lg">
                            <div class="nk-content-body">

                                    <div class="buysell-title text-center"><h4 class="title">Convert Bonus</h4>
                                    <p class="lead text-primary">You currently have  <strong>{{$basic->currency}} {{number_format(Auth::user()->bonus, $basic->decimal)}} </strong> in your bonus wallet but this is non-spendable. </p>
<div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>To convert bonus for withdrawal, enter the amount you wish to convert for withdrawal, this will be credited to your fiat balance.</p></div>

<div class="note note-plane note-danger mgb-1x"><em class="fas fa-info-circle"></em><p>Please note that the minimum conversion amount is {{$basic->currency}}{{number_format($basic->minbonus, $basic->decimal)}}. Ensure you have earned atleast the amount stated to attempt this process.</p>
                                    </div>
                                    <div class="buysell-block">

                                        <form method="post"  class="buysell-form" action="{{route('update.convert') }}">
                                        @csrf

                                            <div class="buysell-field form-group">
                                                <div class="form-label-group"><label class="form-label" for="buysell-amount">Amount to Convert</label></div>
                                                <div class="form-control-group">
                                                    <input type="number" class="form-control form-control-lg form-control-number" name="amount" placeholder=" 0.00" id="mySelect3" onkeyup="myFunction1()" />
                                                    <div class="form-dropdown">

                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-indicator-caret" data-toggle="dropdown" data-offset="0,2">{{$basic->currency}}</a>

                                                        </div>
                                                    </div>
                                                </div>
                                                 </div>

                                            <div class="buysell-field form-action"><button  type="submit" class="btn btn-lg btn-block btn-primary" >Convert Bonus</button></div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@stop
