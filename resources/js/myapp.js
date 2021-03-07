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
    let input = $(this).siblings('[name="copies[]"]');
    input.prop('disabled', !$(this).prop('checked'));
    let checked = input.is(':checked');

    if(!checked)
        input.val('');
});

$(window).on('pageshow', function(){
    $('#my_modal').submit();
});

$(document).on('shown.bs.modal', '#my_modal', function(e) {
    $("#table > tbody").html("");
    var documents = [];
    var copies = [];
    var prices = [];
    var body = '';
    var total = 0;

    $("input[name='documents[]']:checked").each(function(){
        documents.push($(this).val());
        var price = $(this).siblings('input[name="prices[]"]').val();
        prices.push(price);
    });

    $("input[name='copies[]']:enabled").each(function(){
        copies.push($(this).val());
    });
    
    for(var i = 0; i < prices.length; i++)
        total += parseFloat(prices[i]) * parseInt(copies[i]);
    
    for(var i = 0; i < documents.length; i++){
        body += '<tr><td>' + documents[i] + '</td><td>' + 
        copies[i] + '</td><td>' + prices[i] + '</td><td>' + (parseInt(copies[i]) * parseFloat(prices[i])) + '</td></tr>'; 
    }
    body += '<tr><td></td><td></td><td></td><td>Total: ' + total + '</td></td>'
    $('#table > tbody:last-child').append(body);
})

$(document).on('click', '#okay', function(e){
    $('#request_form').submit();
});