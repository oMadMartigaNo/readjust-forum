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
        "padding"                 :   0,
        "modal"                   :   true,
        "loop"                    :   true
    });
    
});
