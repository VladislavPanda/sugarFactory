var forms = document.querySelectorAll( "form" );




function formstylerAfterRequest(obj) {

    var $ = jQuery;
    if (obj && obj.length) {
        obj.each( function() {
            if ( !$( this ).html() ) {
                var new_placeholder = $( this ).parent().parent().data("placeholder");
                if (new_placeholder) {
                    $( this ).html(new_placeholder);
                    $( this ).addClass("placeholder");
                }
            }
        });
    }
};
jQuery(function ($) {
    $('body')
        .prepend(
            '<div class="access">' +
            '<dl class="a-fontsize">' +
            '<dt>Размер шрифта:</dt>' +
            '<dd><a href="#" rel="fontsize-small" class="a-fontsize-small">А</a></dd>' +
            '<dd><a rel="fontsize-normal" href="#" class="a-fontsize-normal">А</a></dd>' +
            '<dd><a href="#" rel="fontsize-big" class="a-fontsize-big">А</a></dd>' +
            '</dl>' +
            '<dl class="a-colors">' +
            '<dt>Цвет:</dt>' +
            '<dd><a href="#" rel="color1" class="a-color1"><i class="fa fa-eye" aria-hidden="true"></i></a></dd>' +
            '<dd><a href="#" rel="color2" class="a-color2"><i class="fa fa-eye" aria-hidden="true"></i></a></dd>' +
            '</dl>' +
            '<dl class="a-images">' +
            '<dt>Изображения</dt>' +
            '<dd><a rel="imagesoff" href="#" class="a-imagesoff">' +
            '<span class="icon-off">выкл</span><span class="icon-on">вкл</span><span class="image-bar"></span>' +
            '</a></dd>' +
            '</dl>' +




            '<div class="access-up"></div>' +
            '<div class="popped">' +
            '<div class="h2">Настройки шрифта:</div>' +
            '<p class="choose-font-family">Выберите шрифт <a class="font-family" id="sans-serif" rel="sans-serif" href="#">Arial</a>' +
            '<a class="font-family" rel="serif" id="serif" href="#">Times New Roman</a></p>' +
            '<p class="choose-letter-spacing">Интервал между буквами <span>(Кернинг)</span>: <a class="letter-spacing" id="spacing-small" rel="spacing-small" href="#">Стандартный</a>' +
            '<a rel="spacing-normal" class="letter-spacing" id="spacing-normal" href="#">Средний</a>' +
            '<a rel="spacing-big" class="letter-spacing" id="spacing-big" href="#">Большой</a></p>' +
            '<div class="h2">Выбор цветовой схемы:</div>' +
            '<ul class="choose-colors">' +
            '<li id="color1"><a rel="color1" href="#"><span>—</span>Черным по белому</a></li>' +
            '<li id="color2"><a rel="color2" href="#"><span>—</span>Белым по черному</a></li>' +
            '<li id="color3"><a rel="color3" href="#"><span>—</span>Темно-синим по голубому</a></li>' +
            '<li id="color4"><a rel="color4" href="#"><span>—</span>Коричневым по бежевому</a></li>' +
            '<li id="color5"><a rel="color5" href="#"><span>—</span>Зеленым по темно-коричневому</a></li>' +
            '</ul>' +
            '<p class="saveit"><a class="closepopped" href="#"><span>Закрыть панель</span></a>' +
            '<a class="default" href="#"><span>Вернуть стандартные настройки</span></a>' +
            '</p>' +
            '</div>' +
            '</div>'
        );
    $obj = $('.version-blind');

    var to_sv = true; //need to sv switch
    sv_theme_cookie = $.cookie('sv_theme');
    if (sv_theme_cookie)  {
        sv_theme_cookie = parseInt(sv_theme_cookie);

        to_sv = (sv_theme_cookie!=1) ;
    }
    else {
        sv_theme_cookie = 0;
    }

    if (sv_theme_cookie) {
        $obj.addClass('sv_theme');
        $('html').addClass('sv_theme');
    }

    var text_sv = $obj.data('sv');
    var text_normal = $obj.data('normal');
    ///var text = to_sv ? 'Версия для слабовидящих' : 'Обычная версия';
    var text = to_sv ? text_sv : text_normal;
    $obj.text(text);

    $obj.click( function(event) {
        event.preventDefault();
        $(this).toggleClass('sv_theme');
        $('html').toggleClass('sv_theme');

        $.cookie('sv_theme', 1-sv_theme_cookie, { path: '/' });

        //Не знаю, нужна ли перезагрузка страницы, чтобы применились классы sv_theme
        location.reload();
    });

    $('.access-up').click(function(){
        var svAccess = $('.access'),
            speed    = 200;
        if (svAccess.hasClass('access--down')) {
            svAccess.removeClass('access--down')
            sv_access_resize(false, speed);
        } else {
            svAccess.addClass('access--down')
            svAccess.children('[class^="a-"]').show(speed)
        }

    })

    sv_page_resize();

    $(window).on('resize', sv_page_resize);

    function sv_page_resize() {

        if ($('html').hasClass('sv_theme')) {

            sv_access_resize();
        }
    }
    function sv_access_resize(recuerse = false, speed = 0, size = 0) {
        var svAccess = $('.access'),
            items    = svAccess.children('[class^="a-"]'),
            visible  = svAccess.children('[class^="a-"]:visible')
        if (!recuerse) {
            // console.log($('.access > [class^="a-"]:visible').size())
            items.show();
            svAccess.addClass('access--oversize')
        } else {

        }
        if (svAccess.height() > 65) {
            visible.eq(-1).hide()
            size = sv_access_resize(true, 0, size+1);
        }
        if (size > 0) {
            items.show()
            svAccess.addClass('access--oversize')
            items.slice(-size).hide(speed);
        } else {
            svAccess.removeClass('access--oversize')
        }
        return size;
    }
});;
jQuery(function($) {

///addCopyright('https://emcmos.ru', 'источник - https://emcmos.ru');

    function emc_is_correct_date(field_value) {
        var arrDate = field_value.split(/\D+/g);
        if (arrDate.length == 3) {
            var date = new Date(arrDate[2], arrDate[1] - 1, arrDate[0]);
            if (date) return true;
        }
        return false;
    }

    function emc_get_age(field_value) {
        var age = 0;
        var arrDate = field_value.split(/\D+/g);
        if (arrDate.length == 3) {
            var date = new Date(arrDate[2], arrDate[1] - 1, arrDate[0]);
            var now = new Date();
            age = now.getFullYear() - date.getFullYear();
            if (now.setFullYear(1972) < date.setFullYear(1972)) {
                age = age - 1;
            }
        }
        return age;
    }

    function emc_is_now(field_value) {
        var arrDate = field_value.split(/\D+/g);
        if (arrDate.length == 3) {
            var date = new Date(arrDate[2], arrDate[1] - 1, arrDate[0]);
            var now = new Date();
            var date2 = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            var time1 = date.getTime();
            var time2 = date2.getTime();
            return time1 == time2;
        }
        return false;
    }


    function emc_count_points() {
        var count = 0;
        $('.webform-client-form input[type="radio"].points:checked').each(function() {
            var point = parseInt($(this).val(), 10);
            count = count + point;
        });
        return count;
    }








    var has_points = $('#points_count').length;
    if (has_points) {
        $("#edit-submitted-count-points").hide();
        $("#edit-submitted-count-points").parent().hide();
        var count = emc_count_points();
        $('#points_count').text(count);
        $("#edit-submitted-count-points").val(count);
    };

    $('.webform-client-form input.points').change(function() {
        var count = emc_count_points();
        $('#points_count').text(count);
        $("#edit-submitted-count-points").val(count);
    });

    var back_url = $('#webform-client-form-8589 #webform-component-navigaciya a').eq(1).attr('href');
    var back_input = '';
    $('#webform-client-form-8589 div.form-actions').append(back_input);
    $('#back_configurator').bind('click', function() {
        window.location = back_url;
    });



    $('.pop dt').click(function() {
        $(this).toggleClass('opened').next().slideToggle('slow');
        return false;
    });

    $('.pop .pop_link').click(function() {
        var url = $(this).data('href');
        var $container = $(this).next('dd').find('.pop_content');
        if (!$container.children().length) {
            $.get(url).done(function(data) {
                var $data = $($.parseHTML(data));
                var selector = '.page';
                var $html = $data.find(selector);
                if (!$html.length) {
                    $html = $data.filter(selector).html();
                }
                // adding class to the block with a person link
                var person = $html.find('.person_tag');
                person.each(function(index, element) {
                    $(element).parent('b').parent('p').addClass('with_person_tag').wrapInner('<span></span>');
                });
                $container.html($html);
            }).fail(function() {
                $(this).removeClass('is-loading');
            });
        }
    });
    $('.departments .dep-close').click(function() {
        $(this).parent().parent().slideToggle('slow').prev().toggleClass('opened');
        return false;
    });
    $('.closeme a').click(function() {
        $(this).parent().parent().slideToggle('slow').prev().toggleClass('opened');
        return false;
    });

    $('.a-settings, .closepopped').click(function() {
        $('.popped').slideToggle('slow');
        return false;
    });

    $('.default').click(function() {
        $('html').removeClass().addClass('fontsize-normal color1 imageson spacing-small serif');
        $.cookie('blind-font-size', 'fontsize-normal', {path: '/'});
        $.cookie('blind-colors', 'color1', {path: '/'});
        $.cookie('blind-font', 'serif', {path: '/'});
        $.cookie('blind-spacing', 'spacing-small', {path: '/'});
        $.cookie('blind-images', 'imagesoff', {path: '/'});

        set_font_size();
        set_colors();
        set_font_family();
        set_letter_spacing();
        set_image_view()
        return false;
    });

    function set_font_size() {
        $('html').removeClass('fontsize-small fontsize-normal fontsize-big').addClass($.cookie('blind-font-size'));
    }

    $('.a-fontsize a').click(function() {
        fontsize = $(this).attr('rel');
        $.cookie('blind-font-size', fontsize, {path: '/'});
        set_font_size();
        return false;
    });

    function set_colors() {
        $('html').removeClass('color1 color2 color3 color4 color5').addClass($.cookie('blind-colors'));
    }

    $('.a-colors a, .choose-colors a').click(function() {
        colors = $(this).attr('rel');
        $.cookie('blind-colors', colors, {path: '/'});
        set_colors();
        return false;
    });

    function set_font_family() {
        $('html').removeClass('serif sans-serif').addClass($.cookie('blind-font'));
    }

    $('.font-family').click(function() {
        font = $(this).attr('rel');
        $.cookie('blind-font', font, {path: '/'});
        set_font_family();
        return false;
    });

    function set_letter_spacing() {
        $('html').removeClass('spacing-normal spacing-big spacing-small').addClass($.cookie('blind-spacing'));
    }
    function set_image_view() {
        $('html').removeClass('imagesoff imageson').addClass($.cookie('blind-images'));
    }

    $('.letter-spacing').click(function() {
        spacing = $(this).attr('rel');
        $.cookie('blind-spacing', spacing, {path: '/'});
        set_letter_spacing();
        return false;
    });

    $('.a-images a').click(function() {
        images = $.cookie('blind-images');
        if (images == 'imagesoff') {

            images = 'imageson';
        }
        else {

            images = 'imagesoff';
        }
        $.cookie('blind-images', images, {path: '/'});
        set_image_view();
        return false;
    });

    ///$('input[title!=""],textarea[title!=""]').hint();

    if (!$.cookie('blind-font-size')) {
        $.cookie('blind-font-size', 'fontsize-normal', {path: '/'});
    }

    if (!$.cookie('blind-colors')) {
        $.cookie('blind-colors', 'color1', {path: '/'});
    }

    if (!$.cookie('blind-font')) {
        $.cookie('blind-font', 'sans-serif', {path: '/'});
    }

    if (!$.cookie('blind-spacing')) {
        $.cookie('blind-spacing', 'spacing-small', {path: '/'});
    }
    if (!$.cookie('blind-images')) {
        $.cookie('blind-images', 'imagesoff', {path: '/'});
    }

    set_font_size();
    set_colors();
    set_font_family();
    set_letter_spacing();
    set_image_view()

});


jQuery.fn.hint = function() {
    return this.each(function() {
        var t = jQuery(this);
        var title = t.attr('title');
        if (title) {
            t.blur(function() {
                if (t.val() == '') {
                    t.val(title);
                    t.addClass('blur');
                }
            });
            t.focus(function() {
                if (t.val() == title) {
                    t.val('');
                    t.removeClass('blur');
                }
            });
            t.blur();
        }
    });
};

function getDaysAgoDate(days){
    var now = new Date();
    return new Date(now - 1000 * 60 * 60 * 24 * days);
}

jQuery(function($) {

    $('#blind_alltime').click(function() {
        $('#since').val('');
        $('#mainsearch').submit();
        return false;
    });
    $('#blind_7days').click(function() {
        var date = getDaysAgoDate(7);
        $('#since').val(date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear());
        $('#mainsearch').submit();
        return false;
    });
    $('#blind_7days').ready(function() {
        var date = getDaysAgoDate(7);
        var param = 'since=' + date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear();
        if(document.URL.indexOf(param) != -1){
            $('#blind_7days').addClass('here')
        }
    });

    $('#blind_30days').click(function() {
        var date = getDaysAgoDate(30);
        $('#since').val(date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear());
        $('#mainsearch').submit();
        return false;
    });
    $('#blind_30days').ready(function() {
        var date = getDaysAgoDate(30);
        var param = 'since=' + date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear();
        if(document.URL.indexOf(param) != -1){
            $('#blind_30days').addClass('here')
        }
    });

    $('#blind_365days').click(function() {
        var date = getDaysAgoDate(365);
        $('#since').val(date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear());
        $('#mainsearch').submit();
        return false;
    });
    $('#blind_365days').ready(function() {
        var date = getDaysAgoDate(365);
        var param = 'since=' + date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear();
        if(document.URL.indexOf(param) != -1){
            $('#blind_365days').addClass('here')
        }
    });

    $('#s-submit').click(function() {
        $('#mainsearch').submit();
        return false;
    });

    $('#id-recieve_by_post-2').change(function() {
        if ($(this).is(':checked')) {
            $('#user_adress').show();
        } else {
            $('#user_adress').hide();
        }
    });
    $('#id-recieve_by_post-1').change(function() {
        if ($(this).is(':checked')) {
            $('#user_adress').hide();
        } else {
            $('#user_adress').show();
        }
    });
    $('.selectBox').change(function(e) {
        e.preventDefault();
        var $options = $(this.selectedOptions);
        var url = $options.attr('href');
        window.location = url;
    });

});

