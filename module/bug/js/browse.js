$(document).ready(function()
{
    $("a.customFields").colorbox({width:680, height:400, iframe:true, transition:'none'});
    $('#' + browseType + 'Tab').addClass('active'); 
    $('#module' + moduleID).addClass('active'); 
    if(browseType == 'bysearch') ajaxGetSearchForm();

    /* If customed and the browse is ie6, remove the ie6.css. */
    if(customed && $.browser.msie && Math.floor(parseInt($.browser.version)) == 6)
    {
        $("#browsecss").attr('href', '');
    }
});
