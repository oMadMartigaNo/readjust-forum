function fancyMeSomeBox() {

  var $fancyImg = $('.Message a[href] > img').closest('a');

  $fancyImg.fancybox({
    'transitionIn': 'elastic',
    'transitionOut': 'elastic',
    'speedIn': 200,
    'speedOut': 200,
    'overlayShow': true,
    'scrolling': 'no'
  });

}

var observer = new MutationObserver(function() {

  if (document.querySelector('.ImageResized')) {
    fancyMeSomeBox();
  }

});

observer.observe(document, {
  childList: true,
  subtree: true,
  attributes: false,
  characterData: false,
});

