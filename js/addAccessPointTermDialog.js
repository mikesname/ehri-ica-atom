/**
 * Provide modal dialog to allow adding new terms to database without requiring
 * a form submit via AJAX request.
 * 
 * @package    qubit
 * @subpackage ECMAScript
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 * @author     Jamil Atta Junior <jamil.atta@bireme.org>
 */

function removeRow(index)
{
  $('tr#newRow' + index + ' div').hide('normal', function() { $('tr#newRow' + index).remove() });
  $('input.addedHidden' + index).remove();
}

function renderAccessPointTermDialog(context)
{
  var i = 0; // Counter

  // Write data from dialog to informationobject/edit form for submission.
  var handleSubmit = function() {
    this.submit();
  };

  var handleCancel = function() {
    // Clear the Dialog fields
    $('div#addAccessPointTermDialog input#addSubjectTermName').val('');
    $('div#addAccessPointTermDialog input#addSubjectTermScope').val('');

    this.cancel();
  };

  // Instantiate the Dialog
  Qubit.addAccessPointTermDialog = new YAHOO.widget.Dialog("addAccessPointTermDialog",
  {
    width: "300px",
    fixedcenter: true,
    visible: false,
    modal: true,
    constraintoviewport: true,
    postmethod: 'async',
    buttons: [ { text: "Submit", handler: handleSubmit, isDefault: true },
                { text: "Cancel", handler: handleCancel } ],
    effect: { effect: YAHOO.widget.ContainerEffect.FADE, duration: 0.25 }
  } );

  var onSuccess = function(o) {
    var data = eval(o.responseText);
    var target = $('#addAccessPointTermDialog').data('target');
    var thisSelector = $('div#' + target + ' select:last');

    if (thisSelector.length > 0)
    {
      // Append this new term to the select list
      appendNewOption(thisSelector, data.id, data.name);

      // spawn new selector
      multiInstanceSelector(thisSelector);
    }

    // Clear the Dialog fields
    $('div#addAccessPointTermDialog input#addSubjectTermName').val('');
    $('div#addAccessPointTermDialog input#addSubjectTermScope').val('');
  }

  var onFailure = function(o) {
    alert("Your submission failed. Status: " + o.status);
  }

  Qubit.addAccessPointTermDialog.callback.success = onSuccess;
  Qubit.addAccessPointTermDialog.callback.failure = onFailure;
  Qubit.addAccessPointTermDialog.render();
}
