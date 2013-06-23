$(document).ready(function() {
    $("section").fadeOut('slow', function(){
        $("section").fadeIn('slow','easeOutExpo');
    })
    
    $("nav ul").find("a").hover(function() {
        $(this).find("span").fadeIn("slow");
    }, function() {
        $(this).find("span").hide();
    });
    
    /*$('.myListElement').live( 'click', function(){
        alert(' Click! ');
    });*/
 
    $('#myList').delegate( '.myListElement', 'click', function(){
        alert(' Click! ');
    });
 
 
    $('.addNewListElement').click( function(){
        $('<li class="myListElement">new</li>').appendTo('#myList');
    });
  
});