/**
 * Created by keef on 30/05/15.
 */
$(function(){
    $('#container').masonry({
        // options
        itemSelector : '.item',
        isAnimated: true
    });
});



$('.item').click(function () {
    if(!$(this).hasClass('selected')) {
        $('.item').each(function () {
            $(this).removeClass('selected');
        });
        $(this).addClass('selected').delay(230).queue(function () {
            $('#container').masonry();
        });
    }
});
