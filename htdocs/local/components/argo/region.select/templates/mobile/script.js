$(document).on("click", ".bxr-region-select", function(event) {
    if ($(event.target).closest(".bxr-region-select-items").length)
        return;        
    show = $(this).data('show');
    $('.bxr-region-select-items').hide();
    $('.bxr-region-select hr').hide();
    $(".bxr-region-select").data('show', 'hidden');
    if (show == 'hidden') {
        $(this).find('.bxr-region-select-items').show();
        $(this).find('.bxr-region-select hr').show();
        $(this).data('show', 'showed');
    } else 
        $(this).data('show', 'hidden');
    event.stopPropagation();
});

$(document).on("click", ".bxr-region-select-item", function () {
    var inner = $(this).html();

    $(".bxr-region-select").data('show', 'hidden');
    $(this).closest('.bxr-region-select').find(".bxr-region-select-chosen-inner").html(inner);
    $(this).closest('.bxr-region-select-items').hide();
});

$(document).on("click", "#bxr-region-select-country .bxr-region-select-item", function () {
    var id = $(this).data("id");
    
    $('#bxr-region-select-country .bxr-region-select-item').removeClass('active bxr-color');
    $(this).addClass('active bxr-color');
    
    $('#bxr-region-select-region .bxr-region-select-item').hide();
    $('#bxr-region-select-region .bxr-region-select-item[data-country='+id+']').show();
});

$(document).on("click", "#bxr-region-select-region .bxr-region-select-item", function () {
    var id = $(this).data("id");
    
    $('#bxr-region-select-region .bxr-region-select-item').removeClass('active bxr-color');
    $(this).addClass('active bxr-color');
    
    $('#bxr-region-select-city .bxr-region-select-item').hide();
    $('#bxr-region-select-city .bxr-region-select-item[data-region='+id+']').show();
});

$(document).on("click", "#bxr-region-select-city .bxr-region-select-item", function () {
    var id = $(this).data("id");
    
    $('#bxr-region-select-city .bxr-region-select-item').removeClass('active bxr-color');
    $(this).addClass('active bxr-color');
});