@extends('include.front')
@section('content')

<!-- .header-main @e --><!-- Banner @s --><div class="header-banner bg-theme-grad-s2"><div class="nk-banner"><div class="banner banner-page"><div class="banner-wrap"><div class="container"><div class="row justify-content-center align-items-center"><div class="col-xl-6 col-lg-9"><div class="banner-caption cpn tc-light text-center"><div class="cpn-head"><h2 class="title ttu">Privacy & Policies</h2></div></div></div></div></div></div></div></div><!-- .nk-banner --><div class="nk-ovm shape-z6-sm"></div></div><!-- .header-banner @e --></header><main class="nk-pages"><section class="section pb-0 bg-light"><div class="container"><div class="nk-block"><div class="row justify-content-center"><div class="col-lg-8 col-mb-10"><div class="nk-block-text text-center"><h2 class="title">Terms & Condition</h2><p>{{$basic->terms}}. </p></div></div></div></div></div></section><!-- // --><section class="section bg-light"><div class="container"><div class="nk-block nk-block-text-wrap"><div class="row align-items-center gutter-vr-30px justify-content-lg-between justify-content-center"><div class="col-lg-5 col-mb-10"><div class="nk-block-img gfx-re-mdl py-5 py-lg-0"><img src="{{asset('assets/images/privacy.jpg')}}" alt="app"></div></div><div class="col-lg-6 col-mb-10"><div class="nk-block-text"><div class="pb-5"><h2 class="title title-regular">Privacy</h2><p class="lead lead-regular">{{$basic->privacy}}</p></div></div></div></div><!-- .row --></div><!-- .block @e --></div></section><!-- // --><section class="section pt-0 bg-light"><div class="container"><div class="nk-block nk-block-text-wrap"><div class="row align-items-center gutter-vr-30px justify-content-lg-between justify-content-center"><div class="col-lg-5 col-mb-10 order-lg-last"><div class="nk-block-img gfx-re-lg"><img src="{{asset('assets/images/policy.jpg')}}" alt="app"></div></div><div class="col-lg-6 col-mb-10"><div class="nk-block-text"><div class="pb-5"><h2 class="title title-regular">Policy</h2><p class="lead lead-regular">{{$basic->policy}}</p></div></div></div></div><!-- .row --></div><!-- .block @e --></div></section><!-- // --></main>
@endsection


