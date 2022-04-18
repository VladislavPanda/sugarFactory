$(document).ready(function() {
    $("#make_order_btn").click(function() {
        var id = $('#good_id').text();

        $.ajax({
            method: "POST",
            url: "http://nesh/record_check",
            data: { appointment_id: id, _token: $('meta[name="csrf-token"]').attr('content') }
        })
        .done(function( response ) {
            window.location.href = "https://n139367.yclients.com/company:147450";
        });
    });  
});