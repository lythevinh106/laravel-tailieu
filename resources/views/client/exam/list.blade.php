@extends('client.layout_main')


@section('content')
    @inject('carbon', 'Carbon\Carbon')
    <style>
        .modal-backdrop {
            position: relative !important;
        }



        .product-bg::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* z-index: 1 !important; */
            background-color: rgba(0, 0, 0, 0.3) !important;
        }

        .accordion * {
            background: transparent !important;
            color: var(--c__white-secondary) !important;
            border: 0px !important;
            --bs-accordion-btn-focus-box-shadow: transparent;
        }

        .accordion-button:not(.collapsed) {
            box-shadow: unset !important;
        }

        .accordion .accordion-button::after {

            background-image: url("public/images/arrow.png");
        }

        .accordion .accordion-header {
            /* border-bottom: 1px solid #fff !important; */

        }

        .accordion .accordion-header .accordion-button {
            background-color: var(--c__orange) !important;
        }


        .accordion .accordion-header span {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            width: 80%;
        }

        .accordion .page-item.active a {
            color: rgb(138, 101, 101);

        }

        .accordion .accordion-body {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            max-height: 50px !important;
            overflow: hidden;
            padding-top: 5px !important;
            line-height: 1.4;
            padding-bottom: 5px !important;


        }


        .product-main .right__path__category img {

            animation: morph 1s linear infinite;
        }



        .product-main .modal-content {
            /* background-color: azure !important; */

        }

        .product-main .modal-content * {
            color: #2e2e2e !important;
        }







        .product-main .right__path svg path {
            d: path('M37.5,186c-12.1-10.5-11.8-32.3-7.2-46.7c4.8-15,13.1-17.8,30.1-36.7C91,68.8,83.5,56.7,103.4,45	c22.2-13.1,51.1-9.5,69.6-1.6c18.1,7.8,15.7,15.3,43.3,33.2c28.8,18.8,37.2,14.3,46.7,27.9c15.6,22.3,6.4,53.3,4.4,60.2	c-3.3,11.2-7.1,23.9-18.5,32c-16.3,11.5-29.5,0.7-48.6,11c-16.2,8.7-12.6,19.7-28.2,33.2c-22.7,19.7-63.8,25.7-79.9,9.7	c-15.2-15.1,0.3-41.7-16.6-54.9C63,186,49.7,196.7,37.5,186z');
            animation: morph 5s infinite;
        }

        .product-main .right__path svg:hover path {
            d: path:hover('M51,171.3c-6.1-17.7-15.3-17.2-20.7-32c-8-21.9,0.7-54.6,20.7-67.1c19.5-12.3,32.8,5.5,67.7-3.4C145.2,62,145,49.9,173,43.4 c12-2.8,41.4-9.6,60.2,6.6c19,16.4,16.7,47.5,16,57.7c-1.7,22.8-10.3,25.5-9.4,46.4c1,22.5,11.2,25.8,9.1,42.6	c-2.2,17.6-16.3,37.5-33.5,40.8c-22,4.1-29.4-22.4-54.9-22.6c-31-0.2-40.8,39-68.3,35.7c-17.3-2-32.2-19.8-37.3-34.8	C48.9,198.6,57.8,191,51,171.3z');
        }



        .product-main .right__path .magictime {
            -webkit-animation-duration: 3s;
            animation-duration: 3s;
        }

        .product-main .modal__desc {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-height: 120px !important;

            padding-top: 5px !important;
            line-height: 1.4;

        }

        @keyframes morph {

            0%,
            100% {
                d: path('M37.5,186c-12.1-10.5-11.8-32.3-7.2-46.7c4.8-15,13.1-17.8,30.1-36.7C91,68.8,83.5,56.7,103.4,45	c22.2-13.1,51.1-9.5,69.6-1.6c18.1,7.8,15.7,15.3,43.3,33.2c28.8,18.8,37.2,14.3,46.7,27.9c15.6,22.3,6.4,53.3,4.4,60.2	c-3.3,11.2-7.1,23.9-18.5,32c-16.3,11.5-29.5,0.7-48.6,11c-16.2,8.7-12.6,19.7-28.2,33.2c-22.7,19.7-63.8,25.7-79.9,9.7	c-15.2-15.1,0.3-41.7-16.6-54.9C63,186,49.7,196.7,37.5,186z');
            }

            50% {
                d: path('M51,171.3c-6.1-17.7-15.3-17.2-20.7-32c-8-21.9,0.7-54.6,20.7-67.1c19.5-12.3,32.8,5.5,67.7-3.4C145.2,62,145,49.9,173,43.4 c12-2.8,41.4-9.6,60.2,6.6c19,16.4,16.7,47.5,16,57.7c-1.7,22.8-10.3,25.5-9.4,46.4c1,22.5,11.2,25.8,9.1,42.6	c-2.2,17.6-16.3,37.5-33.5,40.8c-22,4.1-29.4-22.4-54.9-22.6c-31-0.2-40.8,39-68.3,35.7c-17.3-2-32.2-19.8-37.3-34.8	C48.9,198.6,57.8,191,51,171.3z')
            }
        }






        @media (min-width: 768px) and (max-width: 1023px) {
            .product-main {
                margin-top: 0px !important;
            }

            .product-main .main__right {

                width: 60% !important;
                height: auto !important;
            }

            .product-main .right__path__category {
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }


            .product-main .right__path__category img {
                width: 208px !important;
                height: 208px !important;
            }

            .product-main .main__left .pagination {
                display: flex !important;
                justify-content: center !important;

            }

            .product-main .main__left .left__title {
                text-align: center !important;
            }
        }




        @media (max-width: 767px) {

            .accordion * {
                margin-top: 0px !important;
                font-size: 15px !important;
            }

            .accordion .accordion-header .accordion-button {
                padding-top: 10px !important;
                padding-bottom: 10px !important;


            }

            .product-main {
                margin-top: 0px !important;
            }

            .product-main .main__right {

                width: 200px !important;
                height: 200px !important;
            }

            .product-main .right__path__category {
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }


            .product-main .right__path__category img {
                width: 118px !important;
                height: 118px !important;
            }

            .product-main .main__left .pagination {
                display: flex !important;
                justify-content: center !important;

            }

            .product-main .main__left .left__title {
                text-align: center !important;
            }

            .product-main .pagination-wrapper {
                margin-top: 5px !important;
            }
        }
    </style>

    <section class="product-bg position-fixed top-0 start-0  w-100 h-100 z-0" style="">

        <img src="   {{ asset('client/public/images/exams.jpg') }}"
            class="w-100  top-0 w-100 position-relative  d-block object-fit-cover h-100 text-center" alt="">
    </section>
    <section class="product-main z-1 position-relative " style="margin-top: 60px;">
        <div class="row  g-sm-0 g-lg-4 justify-content-between align-items-start">
            <div class="col-sm-12 col-lg-5">
                <div class="main__left">
                    <div class="row px-0 mx-0 flex-wrap">
                        <div class="col-lg-12">
                            <div class="left__title  text-uppercase  display-4 my-font-1 ">
                                {{ $title }}
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <div class="d-flex mt-5  justify-content-center"> {{ $exams->links() }}</div>


                            {{-- <nav aria-label="Page navigation example " class="mt-3 pagination-wrapper">
                                <ul class="pagination bg-transparent">
                                    <li class="page-item px-2">
                                        <a class="page-link rounded-5 my-bg-orange" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item px-2 "><a class="page-link rounded-5 my-bg-orange"
                                            href="#">1</a>
                                    </li>


                                    <li class="page-item px-2  active"><a class="page-link rounded-5 my-bg-orange"
                                            href="#">2</a></li>
                                    <li class="page-item px-2 "><a class="page-link rounded-5 my-bg-orange"
                                            href="#">3</a>
                                    </li>

                                    <li class="page-item px-2">
                                        <a class="page-link rounded-5 my-bg-orange" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav> --}}
                            <div class="accordion left__list-subject mt-3"
                                style="color: var(--c__white-secondary) !important;" id="accordionExample">

                                @foreach ($exams as $exam)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">

                                            <button class="accordion-button d-flex align-items-center " type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $exam->id }}"
                                                aria-expanded="true" aria-controls="collapseOne{{ $exam->id }}">
                                                <span>{{ $exam->title }}</span> <a class="d-inline-block ms-auto">
                                                    <a href={{ url('exam/show/' . $exam->id) }}>


                                                        <lord-icon src="https://cdn.lordicon.com/rfbqeber.json"
                                                            trigger="hover"
                                                            colors="primary:#ebe6ef,secondary:#911710,tertiary:#4bb3fd"
                                                            style="width:35px;height:35px">
                                                        </lord-icon>

                                                    </a>
                                            </button>
                                        </h2>
                                        <div id="collapseOne{{ $exam->id }}" class="accordion-collapse collapse "
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-3">
                                                {{ $exam->description }}


                                            </div>
                                            <div class="detail__subject  px-3" style="">
                                                <a href="" class=" fs-14  d-flex align-items-center"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $exam->id }}">
                                                    <span class="" style=""> CHI TIẾT</span>

                                                    <span class="ms-2 d-inline-block hover-link">
                                                        <lord-icon src="https://cdn.lordicon.com/xzksbhzh.json"
                                                            trigger="hover" colors="primary:#08a88a,secondary:#ffffff"
                                                            style="width:35px;height:35px">
                                                        </lord-icon>
                                                    </span>


                                                </a>



                                            </div>

                                            <!-- Button trigger modal -->


                                            <!-- Modal -->
                                            <div class="modal fade " id="exampleModal{{ $exam->id }}" tabindex="-1"
                                                aria-labelledby="exampleModal{{ $exam->id }}Label" aria-hidden="true">
                                                <div class=" rounded-3 modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content rounded-4 "
                                                        style="background-image: url({{ asset('client/public/images/background.svg') }}) !important;


                                                background-size: cover;
                                                
                                                ">
                                                        <div class="modal-header text-center ">
                                                            <h1 class="modal-title text-uppercase fs-5 fw-bold text-center mx-auto w-100"
                                                                id="exampleModal{{ $exam->id }}Label">
                                                                {{ $exam->title }}
                                                            </h1>


                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <div class="modal__desc lh-base ">
                                                                {{ $exam->description }}
                                                            </div>

                                                            <div class="modal__other lh-base mt-4 ">
                                                                <div class="other__title text-uppercase  fw-bold ">
                                                                    Chi Tiết
                                                                </div>

                                                                <div class="other__list mt-3">
                                                                    <div class="row g-sm-1   justify-content-between">
                                                                        <div class="col-12 col-sm-4 col-lg-3 ">
                                                                            <div class="item rounded-2 border-1 px-1 py-2 px-sm-3 py-sm-5 my-1 my-sm-0"
                                                                                style="border:2px solid var(--c__orange) !important">
                                                                                <div class="item__img">
                                                                                    <img src="public/images/file.gif"
                                                                                        alt=""
                                                                                        class="h-auto object-fit-cover"
                                                                                        style="width: 35px ; ">
                                                                                </div>
                                                                                <div class="item__title text-uppercase">
                                                                                    Thời Gian Thi: <div class=""
                                                                                        style="color: var(--c__orange) !important;">
                                                                                        {{ $exam->time }} giây</div>
                                                                                </div>


                                                                            </div>



                                                                        </div>
                                                                        <div class="col-12 col-sm-4 col-lg-3 ">
                                                                            <div class="item rounded-2 border-1 px-1 py-2 px-sm-3 py-sm-5 my-1 my-sm-0"
                                                                                style="border:2px solid var(--c__orange) !important">
                                                                                <div class="item__img">
                                                                                    <img src="public/images/date.gif"
                                                                                        alt=""
                                                                                        class="h-auto object-fit-cover"
                                                                                        style="width: 35px ; ">
                                                                                </div>
                                                                                <div class="item__title  text-uppercase">
                                                                                    Ngày Đăng: <div class=""
                                                                                        style="color: var(--c__orange) !important;">




                                                                                        {{ $carbon::parse($exam->created_at)->format('d-m-Y') }}



                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-4 col-lg-3 ">
                                                                            <div class="item rounded-2 border-1 px-1 py-2 px-sm-3 py-sm-5 my-1 my-sm-0"
                                                                                style="border:2px solid var(--c__orange) !important">
                                                                                <div class="item__img">
                                                                                    <img src="public/images/people.gif"
                                                                                        alt=""
                                                                                        class="h-auto object-fit-cover"
                                                                                        style="width: 35px ; ">
                                                                                </div>
                                                                                <div
                                                                                    class="item__title  text-uppercase d-flex flex-column align-items-center">
                                                                                    <span> Vào thi</span>

                                                                                    <span>
                                                                                        <a
                                                                                            href={{ url('exam/show/' . $exam->id) }}>


                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/rfbqeber.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#ebe6ef,secondary:#911710,tertiary:#4bb3fd"
                                                                                                style="width:35px;height:35px">
                                                                                            </lord-icon>

                                                                                        </a>
                                                                                    </span>

                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer ">
                                                            <button type="button"
                                                                class="btn btn-secondary
                                                  
                                                    
                                                    d-flex align-items-center
                                                    "
                                                                data-bs-dismiss="modal">
                                                                <span>Đóng</span>
                                                                <span class="ms-2">
                                                                    <img src="public/images/close.gif"
                                                                        class="object-fit-cover h-auto"
                                                                        style="width: 30px;" alt="">
                                                                </span>
                                                            </button>
                                                            {{-- <a type="button" href="{{ $exam->doc }}"
                                                                class="btn btn-primary  d-flex align-items-center">

                                                                <span>Tải Xuống</span>
                                                                <span class="ms-2"><img src="public/images/download.png"
                                                                        style="width: 50px; height: auto;"
                                                                        class="object-fit-cover" alt=""></span>

                                                            </a> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach





                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div
                class="col-sm-12 col-lg-6 position-relative 
        
        
        d-flex justify-content-center justify-content-lg-end order-first order-lg-0 ">
                <div class=" main__right "
                    style=" width: 700px;height: 700px; 
                           
       transform: translateY(-12%)
            ">
                    <div class=" right__path position-relative " style=" z-index:-1">
                        <svg style="z-index:-1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            viewBox="0 0 288 288">
                            <linearGradient id="PSgrad_0" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                <stop offset="0%" stop-color="#fff" stop-opacity="1" />
                                <stop offset="100%" stop-color="#e98c2e" stop-opacity="1" />
                            </linearGradient>
                            <path fill="url(#PSgrad_0)" />
                        </svg>
                        <div class="right__path__category  position-absolute top-50 start-50 translate-middle infinity-animation "
                            style="width: 308px; height: 308px; ">
                            <img src="  {{ asset('client/public/images/exams.jpg') }}"
                                class="w-100 h-100 object-fit-cover  " style="border-radius: 50%;" alt="">

                        </div>
                    </div>


                </div>
            </div>


        </div>



    </section>
@endsection
