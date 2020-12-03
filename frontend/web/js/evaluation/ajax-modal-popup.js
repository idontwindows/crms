function loadModal(url, title){
    $('#modalContainer').modal('show')
        .find('#modalContent')
        .load(url);
        //.load($(this).attr('value'));
    $('#modalHeader').html(title);
    $('.modal-header').css("background-color", "black");
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
}


//$("#modalCreditor").on("hidden.bs.modal", function () {
    // put your default event here
    //$.pjax.reload({container:'#lddap-ada-items'});
//});

$("body").on("click","#buttonCreateBusinessUnit",function () {
    loadModal($(this).attr('value'), $(this).text());
});

$("body").on("click","#buttonUpdateBusinessUnit",function () {
    loadModal($(this).attr('value'), 'Business Unit');
});

$("body").on("click","#buttonCreateAttribute",function () {
    loadModal($(this).attr('value'), $(this).text());
    //alert($(this).attr('value'));
});

$("body").on("click","#buttonUpdateAttribute",function () {
    loadModal($(this).attr('value'), 'Attribute');
        //alert($(this).attr('value'));
});