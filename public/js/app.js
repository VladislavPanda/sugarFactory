window.addEventListener('DOMContentLoaded', () => {
    "use strict";


    AOS.init({
        once: true,
        offset: 300,
        duration: 500
    });


(function() {
    $('.category-item').mouseenter(function() {
        $('.category-item').addClass("item-disable");
    }).mouseleave(function () {
        $('.category-item').removeClass("item-disable");
    });
})();

// (function() {
//     const chekBox = document.querySelector('.checkbox');
//     if(chekBox){
//         chekBox.addEventListener('click', (e) => {
//             e.target.classList.toggle('active');
//         })
//     }
// })();


// tabs main page

        const tabLink = document.querySelectorAll('.tab-item');
        const tabContent = document.querySelectorAll('.tab-content');

        function loadTabs(e) {
            Array.from(tabContent).forEach((cont) => {
                cont.style.display = 'none';
            });
            tabLink.forEach(n => n.classList.remove('active'));
            this.classList.add('active');
            document.querySelector(this.getAttribute('data-target')).style.display = 'block';
            document.querySelector(this.getAttribute('data-target')).animate([
                    { opacity: 0 },
                    { opacity: 1},
                ],
                { duration: 700 }
            );
        }

        tabLink.forEach((link)=> {
            link.addEventListener('click', loadTabs)
        });




///////////////////////////

// tabs search page
    const searchLink = document.querySelectorAll('.search-filter-item');
    const searchTabContent = document.querySelectorAll('.search-tab');

    function loadSearchTabs(e) {
        e.preventDefault();
        searchTabContent.forEach((cont) => {
            cont.style.display = 'none';
        });
        searchLink.forEach(n => n.classList.remove('active'));
        this.classList.add('active');
        document.querySelector(this.getAttribute('data-target')).style.display = 'block';
        document.querySelector(this.getAttribute('data-target')).animate([
                { opacity: 0 },
                { opacity: 1},
            ],
            { duration: 200 }
        );
    }

    searchLink.forEach((link)=> {
        link.addEventListener('click', loadSearchTabs)
    });



    // const lang = document.getElementById('lang');
    // const langCur = document.querySelector('.lang-current');
    // langCur.addEventListener('click', (e) =>{
    //
    //     e.preventDefault();
    // })
    //
    // lang.addEventListener('click', (e) =>{
    //
    //     lang.classList.toggle('active')
    // })
// const showLang = (toggleId) =>{
//     const toggle = document.querySelector(toggleId);

//     	if(toggle) {
//     		this.addEventListener('click', () =>{
//             toggle.classList.toggle('active');

//             if(toggle.classList.contains('active')) {
// 				menu.style.opacity = 1;
// 				menu.style.visibility ='visible';
// 				body.style.overflowY = 'hidden';
// 				body.style.marginRight = 17 + 'px';
//             }else{
//             	header.style.background = '';
// 				menu.style.opacity = 0;
// 				menu.style.visibility ='hidden';
// 				body.style.overflowY = '';
// 				body.style.marginRight = 0 + 'px';
//             }

//         })
//     }
// }
// showMenu('.toggle-menu');



// Toggle Menu
// Toggle Menu
    let header = document.querySelector('.header'),
        menu = document.querySelector('.section-menu'),
        headerHeight = header.clientHeight,
        body = document.querySelector('body'),
        mainMenu = document.querySelector('.header-wrap-menu'),
        toggle = document.querySelector('.toggle-menu'),
        toggleClosed = document.querySelector('.toggle-closed'),
        closeToggle = document.querySelector('.toggle-close'),
        toggleEl = document.querySelectorAll('.header__toggle-element span'),
        toggleOpenFirst = document.querySelector('.header__toggle-element-open span:nth-child(1)'),
        toggleOpenTwo = document.querySelector('.header__toggle-element-open span:nth-child(2)'),
        langs = document.querySelectorAll('.lang-current'),
        popUpBtn = document.querySelector('.section-menu-wrap .header__group-buttons')



    function getWindowWidth() {
        return window.innerWidth || document.body.clientWidth;
    }

    langs.forEach(item =>{
        if(getWindowWidth() >= 1024){
           item.parentNode.classList.remove('active-lang');
            item.addEventListener('mouseenter', (e) =>{
                e.preventDefault()
                item.parentNode.classList.add('active-lang')
            }) 
            document.addEventListener('mouseover', (e) => {
            if(!item.parentNode.contains(e.target)){
                item.parentNode.classList.remove('active-lang')
            }
         })
        }else{
            item.addEventListener('click', (e) =>{
                e.preventDefault()
                item.parentNode.classList.add('active-lang')
            }) 
            document.addEventListener('click', (e) => {
            if(!item.parentNode.contains(e.target)){
                item.parentNode.classList.remove('active-lang')
            }
         })
        }

        
        
    })



    // langs.forEach(item =>{

    //     document.addEventListener('click', (e) => {
    //         if(!item.contains(e.target)){
    //             item.parentNode.classList.remove('active-lang')
    //         }
    //     })

    //     item.parentNode.classList.remove('active-lang');
    //     item.addEventListener('mouseenter', (e) =>{
    //         e.preventDefault()
    //         item.parentNode.classList.add('active-lang')
    //     })
    // })


    toggle.addEventListener('click', (e) =>{
        toggle.classList.add('active')
        toggleClosed.classList.add('active-toggle')
        menu.classList.add('active');
        menu.style.visibility ='visible';
        body.style.overflowY = 'hidden';
        popUpBtn.style.overflow = 'hidden';
        // body.style.paddingRight = 17 + 'px';
        langs.forEach(item => {
            item.classList.remove('active-lang');
        })
        // document.querySelector('.header__toggle-element-open span:nth-child(1)').animate([
        //   { height: '0'},
        //   { height: '100%' }
        // ], {
        //   // timing options
        //   duration: 400,
        // });
        setTimeout(() => {

            menu.classList.add('animate');
            popUpBtn.style.overflow = '';
        },2000)



    })


    toggleClosed.addEventListener('click', (e) =>{
        toggleClosed.classList.remove('active-toggle')
        toggle.classList.add('close-toggle');
        header.classList.remove('header-active');
        menu.classList.remove('animate');
        body.style.overflowY = '';
        popUpBtn.style.overflow = 'hidden';
        body.style.paddingRight = 0 + 'px';

        setTimeout(() => {
            toggle.classList.remove('close-toggle');
        },2500)
        setTimeout(() => {
            menu.classList.remove('active');
            toggle.classList.remove('active');
        },1000);

    })


    let search = document.querySelectorAll('.searh-btn'),
        sectionSearch = document.querySelector('.section-search'),
        searchClose = document.querySelector('.search-close')

    search.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            sectionSearch.classList.add('active')
            body.style.overflowY = 'hidden';
            // menu.style.overflowY = 'hidden';
            // menu.style.opacity = '0';
            // setTimeout(() => {
            //     menu.classList.remove('active');
            //     menu.classList.remove('animate');
            //     menu.style.opacity = '1';
            //
            // },1000)

        })
    })

    if(searchClose){
        searchClose.addEventListener('click', () => {
            sectionSearch.classList.remove('active')
            body.style.marginRight = 0 + 'px';
            toggle.classList.remove('active');
            body.style.overflowY = '';
        })
    }



    //Куки

let cookieBlock = document.querySelector('.cookie-wrapper'),
		cookieClose = document.querySelector('.cookie-wrap__accept'),
        bodyClass = document.querySelector('body');

  let cookie = $.cookie( 'cookie' );
    if ( typeof cookie === 'undefined' ) {

        // No cookie
        setTimeout(() => {
    cookieBlock.classList.add('active');
    bodyClass.classList.add('background');
    // bodyClass.style.overflowY = 'hidden';

    },2000);
        // Create cookie
        var in30Minutes = 1/48
        cookieClose.addEventListener('click', () => {
        cookieBlock.classList.remove('active');
        bodyClass.classList.remove('background');
        // bodyClass.style.overflowY = 'auto';
        $.cookie( 'cookie', true, { expires: 3, path: '/' } );
    });
   
    }else{
        cookieBlock.classList.remove('active');
        bodyClass.classList.remove('background');

     
    };


$(window).scroll(function() {
        let header = document.querySelector('.header');
        let nav = document.querySelector('.toggle-menu');
        let headerLogo = document.querySelector('.header-logo');
    
        let scroll = $(window).scrollTop();
    
        if(scroll > 100){
            nav.classList.add('toggle-hide');
            header.classList.add('header-hiden');
        }else{
            nav.classList.remove('toggle-hide');
            header.classList.remove('header-hiden');
        }
    
        if(scroll > 300){
            header.classList.add('header-fixed');
            nav.classList.remove('toggle-hide');
            nav.classList.add('toggle-fixed');
            headerLogo.classList.add('logo-fixed');
        } else{
            header.classList.remove('header-fixed');
            nav.classList.remove('toggle-fixed');
            headerLogo.classList.remove('logo-fixed');
        }
    })




// document.querySelector('.checkbox').onclick = (e) => e.target.classList.toggle('active')

    // Custom JS



    /*
     Time line histpry page
    */
    var items = document.querySelectorAll(".history__item");

    function isItemInView(item){
        var rect = item.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
           // rect.top >= window.innerHeight - (window.innerHeight / 2)
            // rect.bottom <= (window.innerHeight - (window.innerHeight / 2) || document.documentElement.clientHeight)
        );
    }

    function callbackFunc() {
        for (var i = 0; i < items.length; i++) {
            items[i].classList.remove('active')
            if (isItemInView(items[i])) {


                items[i].classList.add("active");
            }
        }
    }

    // listen for events
    // window.addEventListener("load", callbackFunc);
    // window.addEventListener("resize", callbackFunc);
    window.addEventListener("scroll", callbackFunc);




    function tabTrigger(itelink, tabContent ) {
        if(itelink == tabContent) {
            tabContent.classList.add('active')
        }
        return
    }

    let fileInput  = document.querySelector( "#file" ),
        labelReturn = document.querySelector(".form-file label");
    if(fileInput){
        fileInput.addEventListener( "change", function(event) {
            labelReturn.innerHTML = event.target.value;
            labelReturn.style.color = '#000';
        });
    }
    
    

    const searchElements = document.querySelectorAll('.search-field');
    const searchLabel = document.querySelectorAll('.search-input label');
    searchElements.forEach(item =>{
        
         item.addEventListener('keyup', (e) => {
    
        if(e.target.value != ''){
            searchLabel[0].style.display = 'none';
        }else{
           searchLabel[0].style.display = 'block'; 
        }
        })
    
   

});


    $('.form-callback').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var callbackUrl = window.location.protocol + '//' + window.location.hostname + '/callback-submit';

        $.ajax({
            type: 'post',
            url: callbackUrl,
            data: form.serialize()
        }).done(function() {
            $('#modal-success').modal('show');
            setTimeout(function(){
                $('#modal-success').modal('hide');
            }, 3500);
        }).fail(function() {
            $('#modal-error').modal('show');
            setTimeout(function(){
                $('#modal-error').modal('hide');
            }, 3500);
        });
        setTimeout(function(){
            form.trigger('reset');
        },4000)
    });


    $('.vacancy-form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var vacancyUrl = window.location.protocol + '//' + window.location.hostname + '/vacancy-submit';
        var formData = new FormData(this);

        $.ajax({
            type: 'post',
            url: vacancyUrl,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
        }).done(function() {
            $('#modal-success').modal('show');
            setTimeout(function(){
                $('#modal-success').modal('hide');
            }, 3500);
        }).fail(function() {
            $('#modal-error').modal('show');
            setTimeout(function(){
                $('#modal-error').modal('hide');
            }, 3500);
        });
        setTimeout(function(){
            form.trigger('reset');
        },4000)
    });

    $('.partner-form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var vacancyUrl = window.location.protocol + '//' + window.location.hostname + '/partner-submit';
        var formData = new FormData(this);

        $.ajax({
            type: 'post',
            url: vacancyUrl,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
        }).done(function() {
            $('#modal-success').modal('show');
            setTimeout(function(){
                $('#modal-success').modal('hide');
            }, 3500);
        }).fail(function() {
            $('#modal-error').modal('show');
            setTimeout(function(){
                $('#modal-error').modal('hide');
            }, 3500);
        });
        setTimeout(function(){
            form.trigger('reset');
        },4000)
    });
    
    
    $('.appeal-form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var appealUrl = window.location.protocol + '//' + window.location.hostname + '/appeal-submit';
        var formData = new FormData(this);

        $.ajax({
            type: 'post',
            url: appealUrl,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
        }).done(function() {
            $('#modal-success').modal('show');
            setTimeout(function(){
                $('#modal-success').modal('hide');
            }, 3500);
        }).fail(function() {
            $('#modal-error').modal('show');
            setTimeout(function(){
                $('#modal-error').modal('hide');
            }, 3500);
        });
        setTimeout(function(){
            form.trigger('reset');
        },4000)
    });
    

    $('[name="phone"]').mask('+375 (99) 999-99-99');

    //Form Privacy
    // function checkPrivacy(checkbox){
    //     if(checkbox.prop('checked') == true)
    //     {
    //         checkbox.closest('.checkbox').addClass('active');
    //         checkbox.closest('form').find('[type="submit"]').prop('disabled', false);
    //     }
    //     else
    //     {
    //         checkbox.closest('.checkbox').removeClass('active');
    //         checkbox.closest('form').find('[type="submit"]').prop('disabled', true);
    //     }
    // }

    // $('[name="privacy"]').each(function(){
    //     checkPrivacy($(this));

    //     $(this).change(function(){
    //         checkPrivacy($(this));
    //     });
    // });

});

$(document).ready(function(){   
    var $element = $('.section-footer');
    let counter = 0;
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      var offset = $element.offset().top
    
      if (scroll > 1000 && counter == 0) {
        $('.back-top').css({'opacity': 1, 'pointer-events': 'auto'});
      }else{
         $('.back-top').css({'opacity': 0,'pointer-events': 'none'}); 
      }
    });
    $('.back-top').click(function () {
              $('body,html').animate({
                  scrollTop: 0
              }, 600);
              return false;
        });

   });

