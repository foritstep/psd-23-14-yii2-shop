$(function() {
    $('#addImage').click(function(e) {
        var $container = $('.form-group.field-productform-images');
        var $input = $container.children('.form-control:last').clone();

        $container.append($input);

        e.preventDefault();
        e.originalEvent.cancelBubble = true;
    })
});
