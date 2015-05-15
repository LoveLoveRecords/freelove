/**
 * Created by keef on 15/05/15.
 */


var i = 1;

    $('#form_addTrack').click(function () {
        $(this).parent().before('' +
        '<div class="track trackNameContainer">' +
        '<label>Track '+i+'</label>' +
        '<input type="text" class="trackName"/>' +
        '</div>' +
        '<div class="trackLengthInfo">' +
        '<div class="track">' +
        '<label class="trackLengthLable">Minutes</label>' +
        '<input type="number" class="min trackLength"/>' +
        '</div>' +
        '<span>:</span>' +
        '<div class="track">' +
        '<label class="trackLengthLable">Seconds</label>' +
        '<input type="number" class="sec trackLength"/>' +
        '</div></div>');

        i++;
    });