// $Id$

(function ($)
  {
    Drupal.behaviors.date = {
      attach: function (context)
        {
          function parse(value)
          {
            var min = [];
            var max = [];

            var matches = value.match(/\d+(?:[-/]0*(?:1[0-2]|\d)(?:[-/]0*(?:3[01]|[12]?\d))?(?!\d))?/g);
            if (matches)
            {
              jQuery.each(matches, function (index)
                {
                  var matches = jQuery.map(this.match(/\d+/g), function (elem)
                    {
                      return elem - 0;
                    });

                  if (0 === index)
                  {
                    min = max = matches;

                    return;
                  }

                  jQuery.each(min, function (index)
                    {
                      if (this < matches[index] && (0 !== index
                            || 31 < this || 32 > matches[index])
                          || 0 === index && 31 < this && 32 > matches[index])
                      {
                        return false;
                      }

                      if (this != matches[index])
                      {
                        min = matches;
                      }
                    });

                  jQuery.each(max, function (index)
                    {
                      if (this > matches[index])
                      {
                        return false;
                      }

                      if (this != matches[index])
                      {
                        max = matches;
                      }
                    });
                });
            }

            return [min.join('-'), max.join('-')];
          }

          $('.date', context).each(function ()
            {
              var $start = $('[id$=startDate]', this);
              var $end = $('[id$=endDate]', this);

              var components = parse($('[id$=date]', this)
                .change(function ()
                  {
                    if (components[0] === $start.val() && components[1] === $end.val())
                    {
                      components = parse($(this).val());

                      $start.val(components[0]);
                      $end.val(components[1]);
                    }
                  })
                .val());
            });
        } };
  })(jQuery);
