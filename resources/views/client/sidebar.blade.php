@inject('carbon', 'Carbon\Carbon')
<style>
    @media (min-width: 768px) and (max-width: 1023px) {



        .header .item__title {
            font-size: 13px !important;
        }

        .header .nav-link lord-icon {
            width: 35px !important;
            height: 35px !important;
        }




    }






    @media (max-width: 767px) {

        .header .navbar {


            display: flex;
            justify-content: end;
        }

        .header .navbar-menu {
            position: fixed;
            top: 10%;
            left: 0;
            width: 100% !important;
        }

        .header .navbar-menu ul {

            width: 100% !important;
            color: var(--black) !important;

        }


        .header .navbar-menu ul .nav-item {
            width: 100%;

        }

        .header .navbar-menu ul .nav-item__doc {

            order: 1;

        }



        .header .navbar-menu .nav-item__search lord-icon {
            width: 50px !important;
        }



        .header .item__title {
            font-size: 13px !important;
        }

        .header .nav-link lord-icon {
            width: 35px !important;
            height: 35px !important;
        }





        .history-table tr th {
            font-size: 12px !important;
            text-align: center !important;
            font-weight: 500 !important;
        }

        .history-table tr td {
            font-size: 12px !important;
        }


    }
</style>

{{-- {{ dd($histories_loading) }} --}}


<section class="header  " style="">
    <div class="row  px-0 mx-0 d-flex justify-content-between align-items-center">
        <div class="col-3 col-sm-3 col-lg-3 ">
            <a href="{{ route('client.index') }}"
                class="header__logo text-start d-flex align-items-center  cursor justify-content-start">
                <lord-icon class="z-2" src="https://cdn.lordicon.com/gqzfzudq.json" trigger="loop" delay="2000"
                    colors="primary:#ffffff,secondary:#ffffff" style="width:40px;height:40px">
                </lord-icon>
                <div class=" header__logo__text fs-15 z-1" style="letter-spacing: 3px;font-weight: 900;">
                    TAILIEUONLINE
                </div>

            </a>
        </div>

        <!-- <div class="col-6 z-3 d-flex justify-content-end d-sm-none navbar__mobile_btn ">

            <lord-icon src="https://cdn.lordicon.com/ichfsnzs.json" trigger="morph"
                colors="primary:#fff,secondary:#e98c2e" style="width:45px;height:45px">
            </lord-icon>
        </div> -->

        <div class="col-8 col-sm-9 col-lg-7">
            <nav class="navbar navbar-expand-sm text-end fw-semibold z-3 dropdown position-relative">





                <lord-icon src="https://cdn.lordicon.com/ichfsnzs.json" class="dropdown-toggle d-block d-sm-none"
                    data-bs-toggle="dropdown" aria-expanded="false" trigger="morph"
                    colors="primary:#fff,secondary:#e98c2e" style="width:45px;height:45px">
                </lord-icon>
                <!--
                <button class="navbar-toggler z-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class=" justify-content-end w-100 text-center  navbar-menu dropdown-menu" tabindex="-1"
                    style="z-index: 3;">
                    <ul
                        class="my-text-white-secondary navbar-nav  w-100 mb-2 d-flex flex-wrap justify-content-end 
                        align-items-center mb-lg-0 fs-14 ">

                        @auth


                            <li class="nav-item mx-sm  mx-sm-1 mx-lg-3  border-link">
                                <a class="nav-link active d-flex align-items-center" data-bs-toggle="offcanvas"
                                    href="#offcanvasHistory" role="button" aria-controls="offcanvasHistory"
                                    aria-current="page" href="#">
                                    <span>
                                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="loop"
                                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                            style="width:40px;height:40px">
                                        </lord-icon>
                                    </span>
                                    <span class="item__title">LỊCH SỬ</span>


                                </a>
                            </li>
                        @endauth
                        <li class="nav-item mx-sm  mx-sm-1 mx-lg-3 border-link">
                            <a class="nav-link active d-flex align-items-center" href="{{ route('client.exam') }}">
                                <span>
                                    <lord-icon src="https://cdn.lordicon.com/ckatldkn.json" trigger="hover"
                                        colors="primary:#646e78,secondary:#08a88a,tertiary:#ebe6ef"
                                        style="width:40px;height:40px">
                                    </lord-icon>
                                </span>
                                <span class="item__title "> THI THỬ</span>
                            </a>
                        </li>

                        <li class="nav-item  mx-sm  mx-sm-1 mx-lg-3 border-link dropdown nav-item__doc">
                            <a class="nav-link active d-flex align-items-center dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false" href="#">
                                <span>
                                    <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="morph"
                                        colors="primary:#f24c00,secondary:#646e78,tertiary:#4bb3fd
                                        ,quaternary:#ebe6ef,quinary:#f9c9c0"
                                        style="width:40px;height:40px">
                                    </lord-icon>
                                </span>
                                <span class="item__title"> TÀI LIỆU</span>
                            </a>

                            <ul class="animate__animated animate__flipInX dropdown-menu position-absolute start-0
                     border-0 p-0 shadow fs-14 fw-light"
                                style="top: 120% ;color: #2e2e2e;width: 250px;">


                                @foreach ($categories_loading as $category)
                                    <li class="py-2 px-2 border-bottom"><a class="dropdown-item"
                                            href="{{ url('document') . '/' . $category->slug }}">

                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach



                            </ul>


                        </li>
                        <li class="nav-item mx-sm  mx-sm-1 mx-lg-3 border-link nav-item__auth">


                            <!-- Button trigger modal -->






                            <a class="nav-link active d-flex align-items-center">
                                <span>


                                    @auth
                                        <img src="{{ auth()->user()->avatar }}" class="rounded-5" alt=""
                                            style="width:40px;height:40px" data-bs-toggle="modal"
                                            data-bs-target="#modalInfo">
                                    @else
                                        <lord-icon data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                            src="https://cdn.lordicon.com/ajkxzzfb.json" trigger="hover"
                                            colors="primary:#ffc738,secondary:#4bb3fd" style="width:40px;height:40px">
                                        </lord-icon>



                                    @endauth



                                </span>
                                <!-- <span> ĐĂNG NHẬP</span> -->



                            </a>

                        </li>









                        <li class="nav-item  mx-0  mx-sm-1 mx-lg-3 nav-item__search">
                            <form class="d-flex " role="search" method="post">

                                <lord-icon class="cursor fw-bold" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"
                                    src="https://cdn.lordicon.com/hgbzryoa.json" trigger="hover"
                                    colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#b26836"
                                    style="width:70px;height:50px">
                                </lord-icon>

                            </form>



                        </li>



                    </ul>



                </div>

            </nav>



            {{-- ///modal-info --}}
            @auth
                <div class="modal fade" id="modalInfo" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-scrollable text-white">
                        <div class="modal-content">
                            <div class="modal-header my-bg-orange">
                                <h1 class="modal-title fs-5  fw+-bold" id="staticBackdropLabel">Thông tin đăng
                                    nhập</h1>
                                <button type="button " class="btn-close text-white bg-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body my-bg-orange">
                                <table class="table  ">


                                    <tbody class="text-white">
                                        <tr>
                                            <th scope="row">Họ Tên</th>
                                            <td>{{ auth()->user()->name }}</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{ auth()->user()->email }}</td>

                                        </tr>

                                        <tr>
                                            <th scope="row"> Đăng Nhập Lần Đầu</th>
                                            <td> {{ $carbon::parse(auth()->user()->created_at)->format('d-m-Y') }}</td>


                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer my-bg-orange">

                                <a type="button" href="{{ route('client.logout') }}" class="btn btn-primary">Đăng
                                    Xuất</a>
                            </div>
                        </div>
                    </div>
                </div>


            @endauth


            <!-- list-off-canvas -->
            <div class="offcanvas offcanvas-end " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title fw-bold" id="offcanvasScrollingLabel">TÌM KIẾM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form class="text-center" method="get" action="{{ route('client.search') }}">
                        @csrf
                        <input class="form-control me-2 border-0 rounded-0" name="search"
                            style="border-bottom:1px solid var(--c__orange) !important;" type="search"
                            placeholder="Nhập Tên Tài Liệu" aria-label="Search">
                        <button type="submit" class="btn btn-orange px-3 py-1 mt-3" style="">Tìm Kiếm</button>
                    </form>


                </div>

            </div>

            <div class="offcanvas offcanvas-start w-100" tabindex="-1" id="offcanvasHistory"
                aria-labelledby="offcanvasHistoryLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-center fw-bold w-100" style="font-size: 20px;"
                        id="offcanvasHistoryLabel text-uppercase">Lịch Sử Thi Của bạn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body  border-1" style="overflow-y: scroll;">

                    <table class="table table-striped table-hover history-table">
                        <thead>
                            <tr class="fw-bold my-bg-orange text-white">
                                <th scope="col">#</th>
                                <th scope="col">Môn Thi</th>
                                <th scope="col"> Hoàn Thành</th>


                                <th scope="col">Đánh Giá</th>
                                <th scope="col"> Ngày </th>
                            </tr>
                        </thead>
                        <tbody class="border-1">
                            @php
                                $str = 0;
                            @endphp
                            @foreach ($histories_loading->reverse() as $key => $history)
                                @php
                                    $str++;
                                @endphp
                                <tr>
                                    <th scope="row " class="fw-bold">{{ $str }}</th>

                                    <td>{{ $history->exam->title }}</td>
                                    <td>{{ $history->point }}%</td>

                                    <td>{{ $history->evaluate }}</td>
                                    <td>{{ $history->created_at }}</td>

                                </tr>
                            @endforeach











                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <!-- Modal auth-->
        <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog px-2">
                <div class="modal-content">
                    <div class="modal-header text-black">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel text-black">Đăng Nhập</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <a href="{{ route('client.redirect') }}" style="background-color: rgb(224, 64, 36) !important;"
                        class="rounded-2 pointer cursor modal-body text-white text-center d-flex justify-content-center
                        align-items-center
                    my-3
                    ">
                        <span class="mx-2 fw-semibold"> Đăng nhập với google </span> <span class="mx-2">
                            <img style="width:15px " src="{{ asset('client/public/images/gg.svg') }}"
                                alt=""></span>
                    </a>

                </div>
            </div>
        </div>
    </div>



</section>
