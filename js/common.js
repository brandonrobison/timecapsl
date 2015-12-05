// Initializes common plugins used across the site.
$(document).ready(function() {
  $('.fancybox').fancybox({
    helpers: {
      overlay: {
        locked: false
      }
    }
  });
  $('.js-fancybox-close').click($.fancybox.close);
});
