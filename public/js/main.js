$(document).ready(function() {
    $("#make_order_btn").click(function() {
        // Получаем данные из формы
        var id = $('#good_id').text();

        var obj = {};
        $(".packs_table > tbody").each(function () {
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
    });

    $("#phone").mask("+375(99) 999-99-99");

    $('#my_modal').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var bookId = $(e.relatedTarget).data('book-id');
    
        //populate the textbox
        alert($(e.currentTarget).find('input[name="bookId"]').val(bookId));

    });

    /*alert(123)
    $('.overlay_popup').click(function() { // Обрабатываем клик по заднему фону
        $('.overlay_popup, .popup').hide(); // Скрываем затемнённый задний фон и основное всплывающее окно
    });

    function sortTable(table, order) {
        var asc   = order === 'asc',
            tbody = table.find('tbody');
    
        tbody.find('tr').sort(function(a, b) {
            if (asc) {
                return $('td:first', a).text().localeCompare($('td:first', b).text());
            } else {
                return $('td:first', b).text().localeCompare($('td:first', a).text());
            }
        }).appendTo(tbody);
    }*/
});