<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang Quản Lý Tài Liệu Online</title>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ $title }}</title> --}}




    <!-- FontAwesome JS-->

    <script defer src="{{ asset('admin/assets/plugins/fontawesome/js/all.min.js') }}"></script>

    <!-- App CSS -->

    {{-- /////botrapscss --}}


    <link rel="stylesheet" href="{{ asset('admin/assets/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}">




    <link rel="stylesheet" href="{{ asset('admin\assets\bootstrap-icons-1.10.5\font\bootstrap-icons.css') }}">


    <link rel="stylesheet" href="{{ asset('admin/assets/css/portal.css') }}">



    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- boootraps -->

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script> --}}

    <script src="{{ asset('admin/assets/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>

    <script></script>
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>


</head>

<style>
    .pointer {
        cursor: pointer !important;
    }
</style>


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
