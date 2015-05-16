/**
 * Created by keef on 15/05/15.
 */


var i = 1;
var tracks = [];

$(document).ready(function () {
    $('#form_addTrack').click();

});

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


    $('#form_save').click(function(){

        var totalMin = 0, totalSec = 0;

        $('.trackName').each(function(){
            var trackLen = $(this).parent().next().children('.track');
            var trackStr = $(this).val() + '=>' + trackLen.children('.min').val() + ':' + trackLen.children('.sec').val();
            if($.inArray(trackStr, tracks) == -1) {
                tracks[tracks.length] = trackStr;
            }

            totalMin += parseFloat(trackLen.children('.min').val());
            totalSec += parseFloat(trackLen.children('.sec').val());
        });

        $('#form_Tracks').val(tracks.toString());
        $('#form_Length').val(calculateLength(totalMin, totalSec));

    });


    function calculateLength(totalMin, totalSec) {
        var fullLength, mins, seconds;
        totalMin *= 60; //Convert to secs
        totalSec += totalMin;
        fullLength = totalSec; // Total time in seconds
        mins = fullLength / 60;
        fullLength = mins - Math.floor(mins);
        seconds = Math.ceil(60 * fullLength);
        mins = Math.floor(mins);
        console.log(mins + ':' + seconds);

        return mins + ':' + seconds;
    }