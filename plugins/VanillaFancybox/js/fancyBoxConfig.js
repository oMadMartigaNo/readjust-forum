$(function () {
    
    function checkImageUrl(url) {
        return $("<img />")
        .bind("error", function(event){ return false; })
        .bind("load",  function(event){ return true; })
        .attr("src", url);
    }
    
    $("img, a > img").not("a.Title img, a.Photo img, a.ProfileLink img, .emoticon, div.BannerWrapper img").each(function(){
        if ($(this).parent().is("a")){
            if ( checkImageUrl($(this).parent().attr("href")) == true) {
                $(this).wrap('<a class="fancybox" href="' + $(this).parent("a").attr("href") + '" />');
            } else {
                return false;
            }
        } else {
            $(this).wrap('<a class="fancybox" href="' + $(this).attr("src") + '" />');
        }
    });
    
    $("a.fancybox").fancybox({
        "autoScale"             :   true,
        "transitionIn"          :   "elastic",
        "transitionOut"         :   "elastic",
        "speedIn"               :   600, 
        "speedOut"              :   200,
        "padding"               :   0,
        "modal"                 :   false, 
        "overlayShow"           :   true,
        "overlayOpacity"        :   0.9,
        "overlayColor"          :   "#000",
        "opacity"               :   false,
        "titleShow"             :   true,
        "titlePosition"         :   "over",
        "hideOnOverlayClick"    :   true,
        "hideOnContentClick"    :   true,
        "enableEscapeButton"    :   true,
        "cyclic"                :   true,
        "changeFade"            :   0,
        "autoDimensions"        :   false
    });
    
});
