





$(document).ready(function () {


    setTimeout(() => {
        $(".my-toast.show").removeClass("show");
    }, 3000)


    wow = new WOW(
        {
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 0,          // default
            mobile: true,       // default
            live: true,
            offset: 70,     // default
        }
    )
    wow.init();












    // $('#carousel1').owlCarousel({
    //     loop: true,
    //     margin: 0,
    //     nav: true,
    //     dots: true,
    //     autoplay: true,


    //     responsive: {
    //         0: {
    //             items: 2,
    //             margin: 10,
    //         },

    //     }
    // });




    $('#carousel1').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        autoplay: false,


        responsive: {
            0: {
                items: 1,
                margin: 0,
                nav: true,
            },

            767: {
                items: 2,
                margin: 20,
                nav: false,
            },
            1024: {
                items: 4,
                margin: 10,
                nav: false,
            },

        }
    });





    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        asNavFor: '.slider-nav',


    });
    $('.slider-nav').slick({

        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        centerPadding: '0px',
        infinity: true,
        initialSlide: 0,
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        // centerMode: true,
        arrows: true,
        prevArrow: '<div class="btn__slick btn__slick--prev" aria-label="Next" type="button"><i class=" fs-1 my-text-orange bi bi-arrow-left-circle-fill"></i></div>',
        nextArrow: '<div class="btn__slick btn__slick--next" aria-label="Previous" type="button"><i class=" fs-1 my-text-orange bi bi-arrow-right-circle-fill"></i></div>',


        responsive: [

            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },


        ]

    });




    if ($(window).width() < 576) {


        $(".footer .list-menu").each(function (i, val) {
            $(val).addClass("collapse")

        })


        $(".owl-carousel-item").each(function (index, val) {
            $(val).addClass("owl-carousel owl-theme ");
            $(val).owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoWidth: true,
                responsive: {
                    0: {
                        items: 1
                    },

                }
            })
        })



    }
    else {
        // $('#carousel1').removeClass("owl-carousel owl-theme ");




        $(".owl-carousel-item").each(function (index, val) {
            $(val).removeClass("owl-carousel owl-theme ");

        })

        $(".footer .list-menu").each(function (i, val) {
            $(val).removeClass("collapse")

        })
    }

















    $(".scroll-top").click(function () {



        $("html, body").animate({
            scrollTop: 0
        }, 100);



        return false;
    })







    $(".product .nav-tabs button").click(function (index, val) {

        let pos_left_btn = $(this).offset().left;
        $(".product .nav-tabs").animate({
            scrollLeft: pos_left_btn - 50
        }, 500, "swing")

        // console.log(pos_left_btn);


    })



    $(window).scroll((e) => {

        let pos_body = $(" html,body").scrollTop();
        let header_body = $(".header").outerHeight();




        //     if (pos_body >= header_body) {
        //         $(".header").addClass("sticky")
        //     }
        //     else {
        //         $(".header").removeClass("sticky")
        //     }




        if (pos_body >= 1200) {
            $(".scroll-top").slideDown()
        }
        else {
            $(".scroll-top").slideUp()
        }










        // 
    })







});