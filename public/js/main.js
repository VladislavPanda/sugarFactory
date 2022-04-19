$(document).ready(function() {
    $("#make_order_btn").click(function() {
        // Получаем данные из формы
        var id = $('#good_id').text();

        var obj = {};
        $("table > tbody").each(function () {
            var tr = $(this).find('tr').eq(0).text() + " " + $(this).find('tr').eq(1).text();
                obj[tr] = tr;
        });

        var popup_id = $('#' + $(this).attr("rel")); // Связываем rel и popup_id
        $(popup_id).show(); // Открываем окно
        $('.overlay_popup').show(); // Открываем блок заднего фона
  
        $.each(obj, function(key, value) {   
            $('#packs')
                .append($("<option></option>")
                           .attr("value", key)
                           .text(value)); 
        });     
    });  

    $('.overlay_popup').click(function() { // Обрабатываем клик по заднему фону
        $('.overlay_popup, .popup').hide(); // Скрываем затемнённый задний фон и основное всплывающее окно
    })
});