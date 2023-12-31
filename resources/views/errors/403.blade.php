@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@include('admin.header')

<body class="app app-404-page">

    <div class="container mb-5">
        <div class="row">
            <div class="col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
                <div class="app-branding text-center mb-5">
                    <a class="app-logo" href=""><img class="logo-icon me-2"
                            src="
                        
                        {{ asset('admin/assets/images/app-logo.svg') }}"
                            alt="logo"><span class="logo-text">TAILIEUONLINE</span></a>

                </div>
                <!--//app-branding-->
                <div class="app-card p-5 text-center shadow-sm">
                    <h1 class="page-title mb-4">404<br><span class="font-weight-light"> Xin Lỗi Bạn Không Đủ Quyền
                            Hạn</span></h1>
                    <div class="mb-4">

                    </div>
                    {{-- <a class="btn app-btn-primary" href="index.html">Go to home page</a> --}}
                </div>
            </div>
            <!--//col-->
        </div>
        <!--//row-->
    </div>
    <!--//container-->


    <footer class="app-footer">
        <div class="container text-center py-3">
            <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
                    style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com"
                    target="_blank">Xiaoying Riley</a> for developers</small>

        </div>
    </footer>
    <!--//app-footer-->









</body>

</html>
