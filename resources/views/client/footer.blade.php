<script src="{{ asset('client/public/js/jquery.js') }} "></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
    integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.lordicon.com/bhenfmcm.js"></script>

<style>
    @media (max-width: 767px) {
        .slider-for .btn__slick.btn__slick--prev {

            bottom: 2% !important;
        }

        .slider-for .btn__slick.btn__slick--next {
            bottom: 2% !important;
        }
    }
</style>
<script>
    if (window.location.href.indexOf("/exam/show/") !== -1) {
        // Đường dẫn chứa "/exam/show/", bỏ qua

        console.log("co");
    } else {
        console.log("k");
        sessionStorage.removeItem("exam");
        sessionStorage.removeItem("time_exam");
    }
    setTimeout(() => {
        $(".my-toast.show").removeClass("show");
    }, 3000)

    $(document).ready(function() {
        wow = new WOW({
            boxClass: 'wow', // default
            animateClass: 'animated', // default
            offset: 0, // default
            mobile: true, // default
            live: true,
            offset: 70,

        })
        wow.init();

        let timeSliderRun = 2000;



        // slider-home
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,

            // fade: true,
            asNavFor: '.slider-nav',

            responsive: [

                {
                    breakpoint: 767,
                    autoplaySpeed: timeSliderRun,
                    autoplay: true,
                    settings: {
                        arrows: true,
                        prevArrow: '<div class="btn__slick btn__slick--prev  position-absolute   z-3  "style="bottom:20% ;left:15% " aria-label="Next" type="button"><i style="font-size:53px" class=" bi-arrow-left-circle-fill"></i></div>',
                        nextArrow: '<div class="btn__slick btn__slick--next position-absolute     z-3   " style="bottom:20% ;right:15% " aria-label="Previous" type="button"><i  style="font-size:53px" class=" bi bi-arrow-right-circle-fill"></i></div>',
                    }
                },


            ]


        });


        $('.slider-nav').slick({

            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            centerPadding: ' 0px',
            centerMode: true,


            autoplaySpeed: timeSliderRun,
            autoplay: true,
            dots: false,

            focusOnSelect: true,
            infinity: true,

            arrows: true,
            prevArrow: '<div class="btn__slick btn__slick--prev  position-absolute  z-0" style="top:103%" aria-label="Next" type="button"><i style="font-size:53px" class=" bi-arrow-left-circle-fill"></i></div>',
            nextArrow: '<div class="btn__slick btn__slick--next position-absolute   z-0 " style="left:15%;top:103%" aria-label="Previous" type="button"><i  style="font-size:53px" class=" bi bi-arrow-right-circle-fill"></i></div>',


            responsive: [

                {
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },



            ]

        });





        $('.slider-nav').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            let bg_curent = $(".slider-for .slick-current img");

            // console.log("event", event, "slick_", slick)
            bg_curent.addClass("wow animate__animated animate__zoomIn");


            $('.slider-nav .slick-slide.slick-active.slick-center').next().addClass(
                'magictime vanishIn');
            // $('.slider-nav .slick-slide').removeClass('magictime vanishIn');

            setTimeout(() => {

                $('.slider-nav .slick-slide.slick-active.slick-center').next().removeClass(
                    'magictime vanishIn');
            }, timeSliderRun);

            $(".progress").css("animation", "start_progress 2s linear forwards");

        });

        $('.slider-nav').on('afterChange', function(event, slick, currentSlide, nextSlide) {

            let bg_curent = $(".slider-for .slick-current img");










            setTimeout(() => {
                bg_curent.removeClass("wow animate__animated animate__zoomIn");
                $(".progress").css("animation", "");

            }, timeSliderRun);


            // runProgress()


        });





        ////mobile


        if ($(window).width() < 768) {


            $(".slider-nav").hide();

            $(".navbar-menu").addClass("dropdown-menu");
            // dropdown
            $('.dropdown > .dropdown-toggle').hover(function() {
                $(this).next('.dropdown-menu').show();
            });

            $('.dropdown > .dropdown-menu').mouseleave(function() {

                $(this).hide();
            });
        } else {
            $(".navbar-menu").removeClass("dropdown-menu");
            // dropdown
            $('.dropdown > .dropdown-toggle').not(".navbar-menu").hover(function() {
                $(this).next('.dropdown-menu').show();
            });

            $('.dropdown > .dropdown-menu').not(".navbar-menu").mouseleave(function() {

                $(this).hide();
            });
        }



        ////infinite animation


        setInterval(function() {
            $('.infinity-animation').toggleClass('magictime vanishIn');
        }, 3000);











        // /exam
        // var intervalID = setInterval(() => {
        //     let time = $(".exam-header .exam-time");

        //     let result_time = (Number(time.text())) - 1

        //     time.text(result_time);
        //     if (result_time == 0) {

        //         clearInterval(intervalID);
        //         const modal = $(".modal-alert-result");
        //         modal.modal('show');
        //         showToast();
        //         return;


        //     }


        // }
        //     , 1000);








        function showToast() {

            $('.my-toast').toast('show');
        };





    })
</script>
