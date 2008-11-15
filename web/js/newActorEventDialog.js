// $Id$

function removeRow(index)
{
  $('tr#newRow'+index+' div').hide('normal', function() { $('tr#newRow'+index).remove() });
  $('input.addedHidden'+index).remove();
}

function editActorEventDialog(eventId)
{
  // Check for a local data cache for this event
  var actorEventData = $('body').data('actorEvent'+eventId);

  if (actorEventData != undefined)
  {
    // Populate actorEvent dialog with cached data, then show it
    populateActorEventDialog(actorEventData);
    Qubit.newActorEventDialog.show();
  }
  else
  {
    // If no local data cache found, do ajax call
    getActorEventAjax(eventId);
  }
}

function getActorEventAjax(eventId)
{
  $.getJSON( Qubit.paths.eventShow+'?id='+eventId+'&returnFormat=json',
  function(data) {
    // cache data locally so we don't have to hit the database again
    $('body').data('actorEvent'+eventId, data);

    // Populate and show the dialog form
    populateActorEventDialog(data);
    Qubit.newActorEventDialog.show();
  } );
}

function populateActorEventDialog(data)
{
  var dialog = $('table#newActorEvent');

  // Set fields
  dialog.find('input[name="newActorEvent[year]"]').val(data.year);
  dialog.find('input[name="newActorEvent[endYear]"]').val(data.endYear);
  dialog.find('input[name="newActorEvent[dateDisplay]"]').val(data.dateDisplay);
  dialog.find('input[name="newActorEvent[description]"]').val(data.description);

  // Select correct actor in selectbox
  var actorIdOption = dialog.find('select[name="newActorEvent[actorId]"] option[value='+data.actorId+']');
  if (actorIdOption.length > 0)
  {
    actorIdOption.get(0).selected = true;
  }

  // Select correct place in selectbox
  var eventTypeIdOption = dialog.find('select[name="newActorEvent[eventTypeId]"] option[value='+data.eventTypeId+']');
  if (eventTypeIdOption.length > 0)
  {
    eventTypeIdOption.get(0).selected = true;
  }

  // Select correct place in selectbox
  var placeIdOption = dialog.find('select[name="newActorEvent[placeId]"] option[value='+data.placeId+']');
  if (placeIdOption.length > 0)
  {
    placeIdOption.get(0).selected = true;
  }
}

function clearActorEventDialog()
{
  var actorSelector = $('table#newActorEvent select[name="newActorEvent[actorId]"]');
  var eventTypeSelector = $('table#newActorEvent select[name="newActorEvent[eventTypeId]"]');
  var placeSelector = $('table#newActorEvent select[name="newActorEvent[placeId]"]');

  // Clear data out of yui dialog
  $('table#newActorEvent input[name="newActorEvent[newActorAuthorizedName]"]').val('');
  $('table#newActorEvent input[name="newActorEvent[year]"]').val('');
  $('table#newActorEvent input[name="newActorEvent[endYear]"]').val('');
  $('table#newActorEvent input[name="newActorEvent[dateDisplay]"]').val('');
  $('table#newActorEvent input[name="newActorEvent[description]"]').val('');
  actorSelector.get(0).options[0].selected = true;
  eventTypeSelector.get(0).options[0].selected = true;
  placeSelector.get(0).options[0].selected = true;

  return true;
}

function submitNewActorEventDialog(thisData, i)
{
  var actorSelector = $('table#newActorEvent select[name="newActorEvent[actorId]"]');
  var eventTypeSelector = $('table#newActorEvent select[name="newActorEvent[eventTypeId]"]');
  var placeSelector = $('table#newActorEvent select[name="newActorEvent[placeId]"]');

  // Build hidden form input fields
  var newHiddens = '';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][actorId]" value="'+thisData['newActorEvent[actorId]']+'" />\n';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][newActorAuthorizedName]" value="'+thisData['newActorEvent[newActorAuthorizedName]']+'" />\n';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][eventTypeId]" value="'+thisData['newActorEvent[eventTypeId]']+'" />\n';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][placeId]" value="'+thisData['newActorEvent[placeId]']+'" />\n';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][year]" value="'+thisData['newActorEvent[year]']+'" />\n';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][endYear]" value="'+thisData['newActorEvent[endYear]']+'" />\n';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][dateDisplay]" value="'+thisData['newActorEvent[dateDisplay]']+'" />\n';
  newHiddens += '<input class="addedHidden'+i+'" type="hidden" name="newActorEvents['+i+'][description]" value="'+thisData['newActorEvent[description]']+'" />\n';

  // Append hidden input fields
  $('table#actorEvents').append(newHiddens);

  // Determine the actor name to show in the creation events table
  var actorId = thisData['newActorEvent[actorId]'];
  var nameDisplay = '';
  if (actorId > 0)
  {
    nameDisplay = actorSelector.find('option:selected').text();
  }
  else if (thisData['newActorEvent[newActorAuthorizedName]'].length > 0)
  {
    nameDisplay = thisData['newActorEvent[newActorAuthorizedName]'];
  }

  // Determine the date(s) to show in the creation events table
  var dateDisplay = thisData['newActorEvent[dateDisplay]'];
  if (dateDisplay.length == 0 && thisData['newActorEvent[year]'].length > 0)
  {
    dateDisplay = thisData['newActorEvent[year]'];
    if (thisData['newActorEvent[endYear]'].length > 0)
    {
      dateDisplay += ' - '+thisData['newActorEvent[endYear]'];
    }
  }

  // Get event type text
  var eventTypeId = thisData['newActorEvent[eventTypeId]'];
  var eventTypeDisplay = '';
  if (eventTypeId.length > 0)
  {
    eventTypeDisplay = eventTypeSelector.find('option:selected').text()
  }

  // Build visible row to append to the creationEvents Table
  var newRow = $('<tr id="newRow'+i+'">'+
   '<td><div>'+nameDisplay+'</div></td>'+
   '<td><div>'+eventTypeDisplay+'<div></td>'+
   '<td><div>'+dateDisplay+'<div></td>'+
   '<td style="text-align: right"><div><a href="javascript:removeRow('+i+')"><img src="'+$('img#imagesDeletePng').attr('src')+'" align="top" /></a></div></td>'+
   '</tr>'
  );

  // Append visible row showing actor name and event note
  $('div', newRow).hide();
  newRow.insertBefore('table#actorEvents tr#addActorEventLink');
  $('div', newRow).show('normal');
}

function renderActorEventDialog(context)
{
  var i = 0; // Counter

  // Write data from dialog to informationobject/edit form for submission.
  var handleSubmit = function() {
    submitNewActorEventDialog(this.getData(), i++); // Save the data to the main form
    this.hide(); // Hide dialog
    clearActorEventDialog(); // Clear the dialog form
  };

  var handleCancel = function() {
    this.cancel();
    clearActorEventDialog();
  };

  // Move newActorEvent table contents into yui dialog container.
  // Why? So the standard form still works if javascript is disabled
  var newActorEventTable = $('table#newActorEvent');
  newActorEventTable.clone().appendTo('div#newActorEventDialog div.bd form');
  newActorEventTable.remove();
  $('label[for=newActorEvent]').remove();
  $('fieldset#newActorEventFields').remove();

  // Instantiate the Dialog
  Qubit.newActorEventDialog = new YAHOO.widget.Dialog("newActorEventDialog",
  {
    width : "480px",
    zIndex : "100",
    fixedcenter : true,
    visible : false,
    modal : true,
    constraintoviewport : true,
    postmethod : 'none',
    buttons : [ { text:"Submit", handler:handleSubmit, isDefault:true },
                { text:"Cancel", handler:handleCancel } ],
    effect : { effect:YAHOO.widget.ContainerEffect.FADE,duration:0.25 }
  } );

  Qubit.newActorEventDialog.render();
}