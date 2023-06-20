<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- /////fancy-box -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <!-- <link rel="stylesheet" type="text/css" href="css/reset.css" /> -->

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href=" {{ asset('client/magic-master/dist/magic.min.css') }} ">
    <link rel="stylesheet" type="text/css" href=" {{ asset('client/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('client/css/mystyle.css') }} " />


    <title>Document</title>
</head>




<div class="loading  position-fixed top-0 start-0 h-100 w-100 d-none"
    style="

background-color:rgba(0,0,0,0.1);
;z-index: 9999">

    <div class="icon position-fixed top-50 start-50 translate-middle ">
        <lord-icon class="" src="https://cdn.lordicon.com/kvsszuvz.json " trigger="loop"
            colors="primary:#c74b16,secondary:#08a88a" style="width:250px;height:250px">
        </lord-icon>
    </div>

</div>
