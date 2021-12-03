$(document).ready(function(){

    var header_sticky=$("header.-fix")

    $(window).scroll(function(){
        $(this).scrollTop()>5?header_sticky.addClass("is-active"):header_sticky.removeClass("is-active")
    })


    /*----Get Header Height ---*/
    function get_header_height() {
        var header_sticky=$("header.-fix").outerHeight()
        $('body').css("--header-height",header_sticky+'px')
    }

    setTimeout(function(){
        get_header_height()
    }, 500);

    $( window ).resize(function() {
      get_header_height()
    });

    // Click id a
    var jump=function(e)
    {
        if (e){
           e.preventDefault();
           var target = $(this).attr("href");
        }else{
           var target = location.hash;
        }

        $('html,body').animate({scrollTop: $(target).offset().top},2000,function(){
           location.hash = target;
        });
    }
    $(document).on('click', 'a[href^="#"], a[href*=".html#"]', function (e) {

        $(this).closest('nav').find('li').removeClass('active')
        $(this).closest('li').addClass('active')

        //Close menu mb
        $('.menu-mb__btn').removeClass('active')
        $('.nav__mobile').removeClass('active')
        $('body').removeClass('modal-open')
    });

    //-------------------------------------------------
    // Menu
    //-------------------------------------------------
    $('.nav__mobile--close').click(function(e){
        $('.nav__mobile').removeClass('active')
        $('body').removeClass('modal-open')
    });
    $('.menu-mb__btn').click(function(e){
        e.preventDefault()
        if($('body').hasClass('modal-open')){
            $('.menu-mb__btn').removeClass('active')
            $('.nav__mobile').removeClass('active')
            $('body').removeClass('modal-open')
        }else{
            $('.menu-mb__btn').addClass('active')
            $('body').addClass('modal-open')
            $('.nav__mobile').addClass('active')
        }
    });

    //back to top
    var back_to_top=$(".back-to-top"),offset=220,duration=500;
    $(document).on("click",".back-to-top",function(o){
        return o.preventDefault(),$("html, body").animate({scrollTop:0},duration),!1
    });

    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
      $('.js-slick').slick('setPosition');
    })

    //check home
    if($('body').hasClass( "home" )){

        // Switch
        $('.js-switch').on("click",function(e) {

            var stt = $(this).data('stt')
            if(stt =='on'){
                $('.js-switch-button input').prop('checked', true);

            }else{
                $('.js-switch-button input').prop('checked', false);
            }
        })

        $('.js-switch-button input').on("click",function(e) {
            var firstTabEl = document.querySelector('.js-switch-1 a')
            var secondTabEl = document.querySelector('.js-switch-2 a')
            var firstTab = new bootstrap.Tab(firstTabEl)
            var secondTab = new bootstrap.Tab(secondTabEl)


            if ($('.js-switch-button input:checked').val() !== undefined){
                firstTab.show()
            }else{
                secondTab.show()
            }
        })

        new WOW().init();

        $('.home-team__slider').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            easing: "linear",
        });

        $('.home-partner__slider').slick({
            rows: 2,
            infinite: false,
            slidesToShow: 10,
            slidesToScroll: 4,
            arrows: true,
            dots: false,
            easing: "linear",
            prevArrow: '<span class="icon-arrow-left slick-prev slick-arrow"></span>',
            nextArrow: '<span class="icon-arrow-right slick-next slick-arrow"></span>',
            responsive: [
                {
                  breakpoint: 991,
                  settings: {
                    slidesToShow: 6,
                    slidesToScroll: 4,
                    dots: false,
                    arrows: true
                  }
                },
                {
                  breakpoint: 767,
                  settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    dots: false,
                    arrows: true
                  }
                },
                {
                  breakpoint: 575,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: false,
                    arrows: true
                  }
                }
            ]
        });

    }
    if($('body').hasClass( "single" )){
        var single_share = $('.single__share')
        var share_offset = $('.single__share').offset().top

        $(window).scroll(function(){
            $(this).scrollTop()>share_offset?single_share.addClass("is-active"):single_share.removeClass("is-active")
        })

        console.log(single_share)
    }

});


