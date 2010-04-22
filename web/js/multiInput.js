// $Id$

(function ($)
  {
    Drupal.behaviors.multiInput = {
      attach: function (context)
        {
          $('ul.multiInput', context).children('li').click(function (event)
            {
              if (event.target == this)
              {
                // On click, remove <li>
                $(this).hide('fast', function ()
                  {
                    $(this).remove();
                  });
              }
            }
          )

          $('input.multiInput', context).each(function()
            {
              var thisName = this.name;

              $(this)
                // Remove @name to avoid submitting value in the "new" input field
                .removeAttr('name')

                // Catch blur, click or keypress events
                .bind('blur click keydown', function (event)
                {
                  if ($(this).data('counter') == undefined)
                  {
                    $(this).data('counter', 0);
                  }
                  var counter = $(this).data('counter');

                  // Don't fire on keypress other than Tab (9) or Enter (13) key
                  if ($(this).val() && ('keydown' != event.type || 9 == event.keyCode || 13 == event.keyCode))
                  {
                    // Cancel default action so as not to loose focus
                    if ('keydown' == event.type)
                    {
                      event.preventDefault();
                    }

                    // Add input value to multInput
                    var stem = thisName.replace('[new]', '');
                    var input = '<input id="' + stem + '_new_' + counter + '" name="' + stem + '[new' + counter + ']" value="' + this.value + '">';
                    var li = $('<li>' + input + '</li>');

                    // Bind click event to new list item
                    li.click(function (event)
                      {
                        if (event.target == this)
                        {
                          // On click, remove <li>
                          $(this).hide('fast', function ()
                            {
                              $(this).remove();
                            });
                        }
                      });

                    // Create ul if it doesn't exist
                    if (0 == $(this).prev('ul.multInput').length)
                    {
                      // Add ul element, if it doesn't exist already (new object)
                      var ul = '<ul class="multInput" name="' + stem + '"></ul>';
                      $(this).before(ul);
                    }

                    // Add li to ul
                    $(this).prev('ul.multInput').append(li);

                    // Clear <input>
                    this.value = '';

                    $(this).data('counter', ++counter);
                  }
                })
            })

        } };
  })(jQuery);
