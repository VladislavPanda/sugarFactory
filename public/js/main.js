$(document).ready(function() {
    $('a.registerModal').click( function(event){
      event.preventDefault();
      $('#registerOverlay').fadeIn(297,	function(){
        $('#registerModal') 
        .css('display', 'block')
        .animate({opacity: 1}, 198);
      });
    });
  
    $('#registerModal__close, #registerOverlay').click( function(){
      $('#registerModal').animate({opacity: 0}, 198, function(){
        $(this).css('display', 'none');
        $('#registerOverlay').fadeOut(297);
      });
    });

    $('a.authModal').click( function(event){
        event.preventDefault();
        $('#authOverlay').fadeIn(297,	function(){
          $('#authModal') 
          .css('display', 'block')
          .animate({opacity: 1}, 198);
        });
      });
    
      $('#authModal__close, #authOverlay').click( function(){
        $('#authModal').animate({opacity: 0}, 198, function(){
          $(this).css('display', 'none');
          $('#authOverlay').fadeOut(297);
        });
      });
});