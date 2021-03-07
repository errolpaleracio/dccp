$(document).ready(function () {
    //called when key is pressed in textbox
    $(".copies").keypress(function (e) {
       //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            return false;
        }
    });
});

$(document).on('click', '.documents', function(event){
    event.stopImmediatePropagation();
    let input = $(this).siblings();
    input.prop('disabled', !$(this).prop('checked'));
    let checked = input.is(':checked');

    if(!checked)
        input.val('');
});

$(window).on('pageshow', function(){
    $('[name="documents[]"').prop('checked', false);
});