// $Id$

/**
 * Extra String methods
 */

String.prototype.trim = function ()
{
  var str = this.replace(/^\s+/g, '');
  str = str.replace(/\s+$/g, '');

  return str;
}

String.prototype.replaceAll = function (sFind, sReplace)
{
  thisString = this.valueOf();

  while (0 <= thisString.indexOf(sFind))
  {
    thisString = thisString.replace(sFind, sReplace);
  }

  return thisString;
}

/**
 * Define Qubit Dialog classes
 */

// Build object for holding dialog data
function QubitDialog(table, options, $)
{
  this.table = document.getElementById(table);
  this.form = $(this.table).parents('form').get(0); // parent form
  this.instances = 0; // Counter
  this.label = $('caption', this.table).remove().text();
  this.fields = [];
  this.initialValues = [];
  this.data = {};
  this.deletes = [];
  this.options = options;
  this.fieldNameFilter = /(\w+)\[(\w+)\]/;
  this.fieldPrefix = null;
  this.iframes = [];
  this.count = 0;

  var thisDialog = this;

  /*
   * Initialize
   */

  // Find field prefix (if there is one)
  var matches = $(':input[name]', $(thisDialog.table)).eq(0).attr('name').match(this.fieldNameFilter);
  if (null != matches)
  {
    this.fieldPrefix = matches[1];
  }

  // Build an internal representation of HTML table elements
  $(thisDialog.table).find(':input').each(function ()
  {
    if ('' == this.name || undefined != thisDialog.fields[this.name])
    {
      return;
    }

    // Store initialValue of element
    switch (this.type)
    {
      case 'radio':
      case 'checkbox':
        var input = $('input[name='+this.name+']', thisDialog.table);
        thisDialog.fields[this.name] = new Array();
        input.each(function () {
          thisDialog.fields[this.name].push(this);
        });

        thisDialog.initialValues[this.name] = input.filter(':checked').val();
        break;

      default:
        thisDialog.fields[this.name] = this;
        thisDialog.initialValues[this.name] = this.value;
    }
  } );

  // Create YUI container for dialog
  var yuiDialogWrapper = $(
'<div class="yui-skin-sam">' +
  '<div id="' + this.table.id + '">' +
    '<div class="hd">' + this.label + '</div>' +
    '<div class="bd">' +
      '<form action="" method="POST" style="border: none"></form>' +
    '</div>' +
  '</div>' +
'</div>');

  // Bind onClick event to "Add" link
  var addLink = $('<a href="#">Add new</a>');
  addLink.click(function () {
    thisDialog.open();
    return false; // Prevent default action: "go to top of page"
  });

  // Replace dialog table with "add" link and move into dialog wrapper
  $(this.table)
    .replaceWith(addLink)
    .appendTo(yuiDialogWrapper.find('form'));

  // prepend yuiDialogWrapper to document body
  $('body').prepend(yuiDialogWrapper);

  // Submit dialog data
  var handleYuiSubmit = function () {
    this.hide(); // Hide dialog
    thisDialog.submit(this.getData()); // Save dialog data
  };

  var handleYuiCancel = function () {
    this.cancel(); // Cancel yui submit
    thisDialog.clear(); // Clear dialog fields
  };

  this.yuiDialog = new YAHOO.widget.Dialog(this.table.id,
  {
    width: "480px",
    zIndex: "100",
    fixedcenter: true,
    draggable: true,
    visible: false,
    modal: true,
    constraintoviewport: true,
    postmethod: 'none',
    buttons: [ { text: "Submit", handler: handleYuiSubmit, isDefault: true },
                { text: "Cancel", handler: handleYuiCancel } ],
    effect: { effect: YAHOO.widget.ContainerEffect.FADE, duration: 0.25 }
  } );

  this.yuiDialog.render();

  // Remove all showEvent listeners to prevent default 'focusFirst' behaviour
  this.yuiDialog.showEvent.unsubscribeAll();

  // Append hidden fields to form on submit
  this.onSubmit = function (event)
  {
    event.preventDefault();
    thisDialog.appendHiddenFields();

    // Apply selector to <iframe/> contents, update value
    // of selected element with value of the autocomplete
    // <input/>, and submit selected element's form
    var iframe;
    while (iframe = thisDialog.iframes.shift())
    {
      thisDialog.count++;

      $($(iframe.selector, iframe.iframe[0].contentWindow.document).val(iframe.value)[0].form).submit();
    }

    // If no iframes, just submit
    if (0 == thisDialog.count)
    {
      thisDialog.done();
    }
  }

  // Bind onSubmit method
  $(this.form).submit(this.onSubmit);

  // Wait for all iframes to finish before submitting main form
  this.done = function()
  {
    // Decrement count of listeners and submit if all done
    if (1 > --this.count)
    {
      $(thisDialog.form)

        // Unbind submit listeners to avoid triggering again
        .unbind('submit', this.onSubmit)

        .submit();
    }
  }

  /*
   * Methods
   */
  this.renderField = function (fname)
  {
    if ($(this.fields[fname]).next().hasClass('form-autocomplete'))
    {
      // Auto-complete text
      return $(this.fields[fname]).next().val();
    }
    else if ('select-one' == this.fields[fname].type || 'select-multi' == this.fields[fname].type)
    {
      // Select box text
      return $(this.fields[fname]).children(':selected').text();
    }
    else if ('radio' == this.fields[fname].type)
    {
      return $(thisDialog.table).find('input[name='+fname+']:checked').val();
    }
    else if (undefined != this.fields[fname].value)
    {
      return this.fields[fname].value;
    }
    else
    {
      return '';
    }
  }

  /**
   * Helper to get a field that has a prefix (e.g. formname[myField]) without
   * specifying the prefix name
   */
  this.getField = function (fname)
  {
    if (null != this.fieldPrefix && null == fname.match(this.fieldNameFilter))
    {
      var fullname = this.fieldPrefix + '[' + fname + ']';
      return this.fields[fullname];
    }
    else
    {
      return this.fields[fname];
    }
  }

  this.open = function ()
  {
    if (undefined == arguments[0])
    {
      // If no 'id' passed as argument then create unique id and skip the
      // data load
      this.id = 'new' + this.instances++;
    }
    else
    {
      this.id = arguments[0];
    }

    if (0 == arguments.length)
    {
      this.yuiDialog.show();
      this.yuiDialog.focusFirst();
    }
    else
    {
      this.loadData(this.id, function () {
        thisDialog.yuiDialog.show();
      });
    }
  }

  this.loadData = function ()
  {
    if (undefined == arguments[0])
    {
      return this;
    }
    else
    {
      var id = arguments[0];
    }

    if (1 < arguments.length)
    {
      var callback = arguments[1];
    }

    if (undefined != this.data[id])
    {
      this.updateDialog(id, this.data[id], callback)
    }
    else
    {
      // TODO: Ajax call to get relation data from db
      var dataSource = new YAHOO.util.XHRDataSource(id);
      dataSource.responseType = YAHOO.util.DataSourceBase.TYPE_JSON;
      dataSource.parseJSONData = function (request, response)
      {
        if (undefined != thisDialog.options.relationTableMap)
        {
          return { results: [ thisDialog.options.relationTableMap(response) ]};
        }
        else
        {
          var dataMap = function (response) {
            for (name in response)
            {
              this[thisDialog.fieldPrefix + '[' + name + ']'] = response[name];
            }
          }

          return { results: [ new dataMap(response) ] };
        }
      }

      dataSource.sendRequest(null, function (req, res)
      {
        success: thisDialog.updateDialog(id, res.results[0], callback);
        failure: null;
      });
    }
  }

  this.updateDialog = function ()
  {
    var thisId = arguments[0];
    var thisData = arguments[1];
    var callback = arguments[2];

    if (undefined == this.data[thisId])
    {
      this.data[thisId] = thisData;
    }

    for (fieldname in this.fields)
    {
      // Set dialog field
      var thisTable = this.table;
      this.fields[fieldname].value = thisData[fieldname];

      // Get display value for autocompletes
      if ($(this.fields[fieldname]).next('input').hasClass('form-autocomplete'))
      {
        var hiddenInput = this.fields[fieldname];

        // First check if a 'Display' value is include in "thisData"
        var displayField = fieldname.substr(0, fieldname.length-1)+'Display]';
        if (undefined != thisData[displayField])
        {
          $(hiddenInput).next('input').val(jQuery.trim(thisData[displayField]));
        }
        else if (0 < hiddenInput.value.length)
        {
          // If necessary, get name via Ajax request to show page
          var dataSource = new YAHOO.util.XHRDataSource(hiddenInput.value);
          dataSource.responseType = YAHOO.util.DataSourceBase.TYPE_TEXT;
          dataSource.parseTextData = function (request, response)
          {
            var text = $('h1.label', response.toString()).text();
            return { "results": [ text ]};
          };

          var myCallback = {
            success: function (req, res, payload) {
              $(payload.hiddenInput).next('input.form-autocomplete').val(res.results[0]);
            },
            argument: { "hiddenInput": hiddenInput }
          }

          // Set visible input field of yui-autocomplete
          dataSource.sendRequest(null, myCallback);
        }
      }
    }

    if (undefined != callback)
    {
      callback();
    }
  }

  this.save = function (yuiDialogData)
  {
    $(thisDialog.table).find('input.form-autocomplete').each(function ()
      {
        $hidden = $(this).prev('input:hidden');

        // Test for existing iframe
        for (var i in thisDialog.iframes)
        {
          if (thisDialog.id == thisDialog.iframes[i].dialogId && $hidden.attr('name') == thisDialog.iframes[i].inputName)
          {
            var index = i;
          }
        }

        // Test if autocomplete has a value
        if (0 < this.value.length)
        {
          // If no URI is set, then selecting unmatched value
          if (0 == $hidden.val().length)
          {
            // Store display value
            var dname = $hidden.attr('name');
            dname = dname.substr(0, dname.length-1)+'Display]';
            yuiDialogData[dname] = this.value;

            // Allowing adding new values via iframe
            var value = $('~ .add', this).val();
            if (value)
            {
              var components = value.split(' ', 2);

              if (undefined == index)
              {
                // Add hidden <iframe/> for each new choice
                $iframe = $('<iframe src="' + components[0] + '"/>')
                  .width(0)
                  .height(0)
                  .css('border', 0)
                  .appendTo('body');

                thisDialog.iframes.push({
                  'dialogId': thisDialog.id,
                  'inputName': $(this).prev('input:hidden').attr('name'),
                  'iframe': $iframe,
                  'selector': components[1],
                  'value': this.value
                });
              }
              else
              {
                // Update existing iframe
                thisDialog.iframes[index].value = this.value;
              }
            }
          }

          // Remove iframe if selecting a pre-existing value
          else if (undefined != index && this.value != thisDialog.iframes[index].iframe.value)
          {
            delete thisDialog.iframes[index];
          }
        }
      } );

    this.data[this.id] = yuiDialogData;

    return this;
  }

  this.clear = function ()
  {
    // Remove "id" field
    $('input[name="id"]', this.table).remove();

    // Clear fields
    for (fname in this.fields)
    {
      // Radio and checkbox inputs have a length > 0
      if (0 < this.fields[fname].length)
      {
        var initVal = this.initialValues[fname];
        if ('string' == typeof initVal)
        {
          initVal = [initVal]; // Cast as array
        }

        $(this.fields[fname]).val(initVal);
      }
      else if ('select-one' == this.fields[fname].type)
      {
        // Select first option in single option select controls
        this.fields[fname].options[0].selected = true;
      }
      else
      {
        $(this.fields[fname]).val(this.initialValues[fname]);
      }
    }

    // Clear auto-complete fields
    $('input.form-autocomplete', $(this.table)).val('');

    return this;
  }

  this.remove = function (thisId)
  {
    if (undefined == this.data[thisId])
    {
      return;
    }

    var tr = $('#' + this.options.displayTable).find('tr[id="' + thisId + '"]');

    // Wrap td contents in div so the row hides nicely then hide and remove row
    tr.children('td')
      .wrapInner('<div></div>')
      .children('div').hide('normal', function () {
        tr.remove();
      });

    // If this is an existing relationship, then store id for deletion
    if ('new' != thisId.substr(0,3))
    {
      this.deletes.push(thisId.match(/\d+$/));
    }

    // Remove data for relation
    delete this.data[thisId];
  }

  this.appendDisplayRow = function ()
  {
    var displayTable = document.getElementById(this.options.displayTable);
    var newRowTemplate = this.options.newRowTemplate;

    if (undefined == displayTable || undefined == newRowTemplate)
    {
      return;
    }

    // Check for special field render handler
    if (undefined != this.options.handleFieldRender)
    {
      var render = function (fname)
      {
        return thisDialog.options.handleFieldRender(thisDialog, fname);
      }
    }
    else
    {
      var render = function (fname)
      {
        return thisDialog.renderField(fname);
      }
    }

    tr = newRowTemplate.replaceAll('{' + this.fieldPrefix + '[id]}', this.id);
    for (fname in this.fields)
    {
      if (0 < fname.length)
      {
        tr = tr.replaceAll('{' + fname + '}', render(fname));
      }
    }

    if(0 == $('tr[id="' + this.id + '"]', displayTable).length)
    {
      $(displayTable).append(tr);
    }
    else
    {
      $('tr[id="' + this.id + '"]', displayTable).replaceWith(tr);
    }

    // Bind events
    $('tr[id="' + this.id + '"] img[alt=edit]').click(function () {
      thisDialog.open($(this).parents('tr').attr('id'));
    });
    $('tr[id="' + this.id + '"] button[name=delete]').click(function () {
      thisDialog.remove($(this).parents('tr').attr('id'));
      return false;
    });
  }

  // Submit dialog
  this.submit = function (yuiDialogData)
  {
    this.save(yuiDialogData);
    this.appendDisplayRow();
    this.clear();
  }

  // Append all cached data to form
  this.appendHiddenFields = function ()
  {
    // Build hidden form input fields
    var i = 0;
    if (null != this.fieldPrefix)
    {
      // Append 's' to old prefix to indicate multiple nature
      var outputPrefix = this.fieldPrefix + 's';
    }
    else
    {
      var outputPrefix = 'dialog';
    }

    for(var id in this.data)
    {
      var thisData = this.data[id];

      // Don't include "id" if it's a "new" object
      if (null != id && 'new' != id.substr(0,3))
      {
        var name = outputPrefix + '[' + i + '][id]';
        $(this.form).append('<input type="hidden" name="' + name + '" value="' + id + '" />');
      }

      // Convert all event data into hidden input fields
      for (var j in thisData)
      {
        // Format name according to input and output name formats
        var matches = j.match(this.fieldNameFilter);
        if (null != matches)
        {
          name = outputPrefix + '[' + i + '][' + matches[2] + ']';
        }
        else
        {
          name = outputPrefix + '[' + i + '][' + name + ']';
        }

        var $hidden = $('<input type="hidden" name="' + name + '" value="' + thisData[j] + '" />');
        $hidden.appendTo(this.form);

        // Update this value from iframe
        for(var k in this.iframes)
        {
          if (id == this.iframes[k].dialogId && j == this.iframes[k].inputName)
          {
            this.iframes[k].iframe.one('load', {'hdn': $hidden}, function (e)
              {
                // Update value of hidden input with URI of new resource
                e.data.hdn.val(this.contentWindow.document.location);

                // Decrement count of listeners and submit if all done
                thisDialog.done();
              } );
          }
        }
      }
      i++;
    }

    // Delete relations that have been removed
    for (var k=0; k < this.deletes.length; k++)
    {
      $(this.form).append('<input type="hidden" name="deleteRelations[' + this.deletes[k] + ']" value="delete" />');
    }
  }

}
