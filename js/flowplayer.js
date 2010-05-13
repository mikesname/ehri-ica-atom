// $Id$

(function ($)
  {
    Drupal.behaviors.flowplayer = {
      attach: function (context)
        {
          $('.flowplayer', context).each(function ()
            {
              flowplayer(this, Qubit.relativeUrlRoot + '/vendor/flowplayer/flowplayer-3.1.5.swf', { clip: { autoPlay: false } });
            });
        }};
  })(jQuery);
