// JavaScript Document

// pop up boxes for admin part (usually used for pop up during deleting record in each section)
function showPopupBox(obj, message, delLink)
{
    $("#yes").attr('hreflang', delLink);
    var height = $('#popup').height();
    var width = $('#popup').width();
    var offsetVal = $("#" + obj).offset();
    var final_left = (offsetVal.left - (width / 2)) - 200;
    leftVal = final_left + "px";
    topVal = offsetVal.top - (height / 1.2) + "px";
    $('#popup_message').html(message);
    $('#popup').css({left: leftVal, top: topVal}).show();
}

function hidePopupBox(action)
{
    if (action == 'no')
        $('#popup').hide();
    else if (action == 'yes')
    {
        document.location.href = ($("#yes").attr('hreflang'));
    }
}