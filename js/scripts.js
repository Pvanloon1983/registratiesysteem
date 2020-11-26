// Stops asking for form submission
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
   }

$("#btn-wwvergeten").click(function(){

    $("#loader").css("display", "inline-block");

})

