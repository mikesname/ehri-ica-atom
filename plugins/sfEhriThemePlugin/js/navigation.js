// $Id$

(function ($)
  {
    // Hack to avoid changing the default logo but
    // still keeping a clickable header...
    $(document).ready(function() {
        $("#header").click(function(event) {
          window.location = "/index.php/";
        });  
    });


    Drupal.behaviors.navigation = {
      attach: function (context)
        {
          var time = 0;
          var timeout;

          $('#navigation li:not(.links .links li)', context)
            .focusin(function ()
              {
                $('#navigation .links .links:not(.links .links .links)', context)
                  .not($('.links', this))
                  .hide();

                $('.links:not(.links .links .links)', this).show();
              })
            .focusout(function ()
              {
                $('.links:not(.links .links .links)', this).hide();
              })
            .hover(function ()
              {
                clearTimeout(timeout);

                $('#navigation .links .links:not(.links .links .links)', context)
                  .not($('.links', this))
                  .hide();

                var li = this;
                timeout = setTimeout(function ()
                  {
                    $('.links:not(.links .links .links)', li).show();
                  }, 256);
              }, function ()
              {
                clearTimeout(timeout);

                var li = this;
                timeout = setTimeout(function ()
                  {
                    $('.links:not(.links .links .links)', li).hide();

                    time = 0;
                  }, time);
              });

          $('#navigation .links .links:not(.links .links .links)', context).mouseenter(function ()
            {
              time = 1024;
            });
        } };
  })(jQuery);
