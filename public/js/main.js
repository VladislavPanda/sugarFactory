$(document).ready(function() {
    $("#make_order_btn").click(function() {
        var id = $('#good_id').text();
        

        alert(id)

        /*$.ajax({
            method: "POST",
            url: "http://sugarFactory/goodForOrder",
            data: { good_id: id, _token: $('meta[name="csrf-token"]').attr('content') }
        })
        .done(function( response ) {
            packs = JSON.stringify(response);
            alert(packs)
        });*/
    });  
});