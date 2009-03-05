// Add string method for removing trailing numeric characters
String.prototype.trimTrailingDigits = function()
{
  return this.replace(/\d+$/, '');
};

/**
 * Javascript to spawn new select box to create multiple relations per form submit.
 *
 * @param object thisElement dom <select> element to operate on
 * @return void
 */
function multiInstanceSelector(thisElement)
{
  var static
  var elementName = thisElement.attr('name').toString();

  // Append array braces '[]' to element name (if not present)
  if (elementName.substr(-2) != '[]')  {
    thisElement.attr('name', elementName += '[]');
  }

  // String to select all elements in this set
  var setSelector = "[name='"+elementName+"']";

  // Remove element if blank and it's not the only element in the set
  if (thisElement.children('option:selected').attr('value') == null && $(setSelector).length > 1)
  {
    thisElement.hide('normal', function () { thisElement.remove() } );
    // NOTE: rest of script executes before thisElement.remove is called due to hide('slow') delay!
  }

  // If the last element is not blank, then add a new blank element
  var lastElement = $(setSelector).eq(($(setSelector).length)-1);
  if (lastElement.children('option:selected').attr('value') != null)
  {

    // Clone lastElement and insert clone after lastElement (hidden)
    var newElement = lastElement.clone(true);
    newElement.css('display', 'none');
    newElement.insertAfter(lastElement);

    // Fancy fade-in effect (ooh, ahh!)
    newElement.show('normal');
  }

  // Build unique ids by appending array index (e.g. thisId0, thisId1, etc.)
  $(setSelector).each(function(i){
    // Remove trailing digits from "id" attribute and append array index
    var idRoot = this.id.trimTrailingDigits();
    this.id = idRoot + i.toString();
  })
}

// TODO: remove options that have already been chosen
// from subsequent select boxes
function restrictOptionList(setSelector, optionList)
{
  // alert('First option:'+fullOptionList['subject_id'][1]);
}

// On page load, link multiInstanceSelector function to "onChange" event for
// selectboxes with class="multiInstance"
var fullOptionList = new Array;
Drupal.behaviors.addMultiInstanceSelect = {
  attach: function (context)
    {
      $('select.multiInstance').change(function(event){
        multiInstanceSelector($(this));
      });

      // Store an array of intial options for each selectbox option list
      $('select.multiInstance').each(function(i){
        fullOptionList[this.name] = new Array;
        for (var j=0; j<this.options.length; j++)
        {
          fullOptionList[this.name][j] = this.options[j].value;
        }
      });
    } };
