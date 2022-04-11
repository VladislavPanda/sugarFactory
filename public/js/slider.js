$(document).ready(function(){


// $('.main__slider').slick({
//     infinite: true,
//     autoplay:true,
//     dots:true,
//     slidesToShow: 1,
//     fade: true,
//     swipe: true,
//     arrows:true,
//     appendArrows: $('.slider-arrow'),
//     autoplaySpeed:5000,
//     pauseOnFocus:false,
//     pauseOnHover:false,
//     prevArrow: '<a href="" class="arrow-slider prev-arrow box-shadow"><i class="long-arrow-left"></i></a>',
//     nextArrow: '<a href="" class="arrow-slider next-arrow box-shadow"><i class="long-arrow-right"></i></a>',
//   }).slickAnimation();


    var $bannerSlider = $('.main__slider');
    var $bannerFirstSlide = $('.main__slider-item:first-child');

    $bannerSlider.on('init', function(e, slick) {
        var $firstAnimatingElements = $bannerFirstSlide.find('[data-animation]');
        slideanimate($firstAnimatingElements);
    });
    $bannerSlider.on('beforeChange', function(e, slick, currentSlide, nextSlide) {
        var $animatingElements = $('div.slick-slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
        slideanimate($animatingElements);
    });
    $bannerSlider.slick({
        infinite: true,
        autoplay:false,
        dots:true,
        slidesToShow: 1,
        fade: true,
        swipe: true,
        arrows:true,
        appendArrows: $('.slider-arrow'),
        autoplaySpeed:5000,
        pauseOnFocus:false,
        pauseOnHover:false,
        prevArrow: '<a href="" class="arrow-slider prev-arrow box-shadow"><i class="long-arrow-left"></i></a>',
        nextArrow: '<a href="" class="arrow-slider next-arrow box-shadow"><i class="long-arrow-right"></i></a>',
    });



    function slideanimate(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function() {
            var $this = $(this);
            var $animationDelay = $this.data('delay');
            var $animationType = 'animated ' + $this.data('animation');
            $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay
            });
            $this.addClass($animationType).one(animationEndEvents, function() {
                $this.removeClass($animationType);
            });
        });
    }


    $('.company-slider').slick({
        infinite: true,
        autoplay:false,
        slidesToShow: 1,
        arrows:true,
        appendArrows: $('.slider-arrow'),
        autoplaySpeed:5000,
        pauseOnFocus:false,
        pauseOnHover:false,
        prevArrow: '<a href="" class="arrow-slider prev-arrow box-shadow"><i class="long-arrow-left"></i></a>',
        nextArrow: '<a href="" class="arrow-slider next-arrow box-shadow"><i class="long-arrow-right"></i></a>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    adaptiveHeight: true,
                }
            }

        ]
    });



    $('.slider-first').each(function() {
        $(this).slick({

            infinite: false,
            autoplay:false,
            slidesToShow: 1,
            arrows:true,
            dots: true,
            appendArrows: $(this).parents('.slider-block').find('.slider-arrow-first'),
            appendDots: $(this).parents('.slider-block').find('.slider-dots-first'),
            autoplaySpeed:5000,
            pauseOnFocus:false,
            pauseOnHover:false,
            prevArrow: '<a href="" class="arrow-slider prev-arrow box-shadow"><i class="long-arrow-left"></i></a>',
            nextArrow: '<a href="" class="arrow-slider next-arrow box-shadow"><i class="long-arrow-right"></i></a>',

        });
    });



$('.news-slider').slick({
    infinite: false,
    autoplay:false,
    arrows:false,
    slidesToShow: 1,
    dots: true,
    // appendArrows: $('.slider-arrow-first'),
    // appendDots: $('.slider-dots-first'),
    autoplaySpeed:5000,
    pauseOnFocus:false,
    pauseOnHover:false,
  });

    $('.slider-two').slick({
        infinite: false,
        autoplay:false,
        slidesToShow: 1,
        arrows:true,
        dots: true,
        appendArrows: $('.slider-arrow-two'),
        appendDots: $('.slider-dots-two'),
        autoplaySpeed:5000,
        pauseOnFocus:false,
        pauseOnHover:false,
        prevArrow: '<a href="" class="arrow-slider prev-arrow box-shadow"><i class="fal fa-chevron-left"></i></a>',
        nextArrow: '<a href="" class="arrow-slider next-arrow box-shadow"><i class="fal fa-chevron-right"></i></a>',
    });



$('.card-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        arrows: false,
        asNavFor: '.card-slider-nav'
    });

    $('.card-slider-nav').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        centerMode: true,
  focusOnSelect: true,
        infinite: false,
        asNavFor: '.card-slider',
        dots: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 580,
                settings: {
                    vertical: false,
                    slidesToShow: 2,
                }
            },

        ]
    });

    $('.card-slider-nav-item ').click(function(){
        var goToSlide = $(this).closest('.slick-slide').data('slick-index');
        $('.card-slider').slick('slickGoTo', parseInt(goToSlide));
    });



    function setProgress(index) {
        const calc = ((index + 1) / ($slider.slick('getSlick').slideCount)) * 100;

        $progressBar
            .css('background-size', `${calc}% 100%`)
            .attr('aria-valuenow', calc);

        // $progressBarLabel.text(`${calc.toFixed(2)}% completed`);
    }

    const $slider = $('.card-slider-nav');
    const $progressBar = $('.progress');// const $progressBarLabel = $('.slider__label');

    $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        setProgress(nextSlide);
    });

    setProgress(0);



});







