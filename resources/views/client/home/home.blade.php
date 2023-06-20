@extends('client.layout_main')


@section('content')
    <style>
        .big-bg-item .item__img::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);



        }

        .big-bg .content__title {
            min-height: 140px;
        }

        .big-bg .content__title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .big-bg .content__desc {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }





        @media (min-width: 768px) and (max-width: 1023px) {

            .big-bg-item .item__content {
                text-align: center !important;
                top: unset !important;
                bottom: 50% !important;
            }

            .big-bg-item .item__content .content__desc {
                margin-top: 0px !important;
            }





            .slider-subject {
                top: unset !important;
                bottom: 15% !important;
            }

            .slider-subject .btn__slick.btn__slick--prev {
                right: 55% !important;
            }

            .slider-subject .btn__slick.btn__slick--next {
                left: 55% !important;
            }


            @media (max-width: 767px) {

                /* ///big-bg item */
                .big-bg-item .item__content {
                    text-align: center !important;

                    top: 50% !important;
                    transform: translateY(-50%);
                }

                .big-bg-item .item__content .content__title {
                    min-height: 120px !important;
                }

                .big-bg-item .item__content .content__desc {
                    margin-top: 0px !important;
                }

                .big-bg-item .item__content .content__btn {
                    padding-top: 2px !important;
                    padding-bottom: 2px !important;

                }


                .slider-subject {
                    display: none;
                }
            }
        }
    </style>




    <section class="big-bg position-absolute top-0 start-0 bottom-0 end-0 " style="">
        <div class="slider-for " style="">

            @php
                $firstItem = true;
            @endphp

            @foreach ($categories as $index => $category)
                <div class="big-bg-item  ">
                    <div class="item__img position-relative" style="height:100vh;">
                        <img src="{{ $category->images }}" class="w-100   d-block object-fit-cover h-100 text-center wow"
                            data-wow-duration="2s" style="z-index: -1;" alt="">
                        <div class="row z-2 ">
                            <div class=" item__content position-absolute start-0 top-50 col-xl-5">
                                <div class="my-container-1 ">
                                    <div class="content__title text-uppercase  display-3 my-font-1" style="">
                                        {{ $category->name }}
                                    </div>
                                    <div class="content__desc fs-15 lh-base mt-2">
                                        {{ $category->description }}
                                    </div>

                                    <a class="content__btn d-inline-block  " href={{ url("/document/$category->slug") }}>
                                        <div
                                            class="hover-link text-white mt-3
                                     fw-bolder 
                                     d-flex
                                     align-items-center
                                     text-center mx-auto
                                   fs-15 content__btn btn bg-transparent
                                    border-1 border-white rounded-5 px-4 py-2">

                                            <span>
                                                <lord-icon src="https://cdn.lordicon.com/fmnowuba.json" trigger="morph"
                                                    colors="primary:#08a88a,secondary:#f24c00"
                                                    style="width:30px;height:30px">
                                                </lord-icon>
                                            </span>
                                            <span> LẤY TÀI LIỆU</span>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach










        </div>
        <section class="slider-subject position-absolute  w-100 end-0  " style="top:40%;">

            <div class="row w-100 justify-content-end px-0 mx-0">

                <div class="col-xl-6">
                    <div class="content__right w-100 slider-nav position-relative ">

                        @foreach ($categories as $category)
                            <a class="px-2 item__img d-flex justify-content-center "
                                href={{ url("/document/$category->slug") }} style="height: 290px;">
                                <img src="{{ $category->images }}" class="rounded-4 w-100 h-100 object-fit-cover"
                                    alt="">
                            </a>
                        @endforeach














                    </div>
                </div>
            </div>


            <!-- <div class="slider-subject-animated position-absolute " style="right: 30%;top: 103%;">
                                                                                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                                                                                                        <lord-icon src="https://cdn.lordicon.com/fdkhkbvx.json" trigger="loop"
                                                                                                                                                                                                                                                                                                                            colors="primary:#b26836,secondary:#f24c00,tertiary:#3a3347" style="width:60px;height:60px">
                                                                                                                                                                                                                                                                                                                        </lord-icon>
                                                                                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                                                                                                    </div> -->




        </section>


    </section>
@endsection
