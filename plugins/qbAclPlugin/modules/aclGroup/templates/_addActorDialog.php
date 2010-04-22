<!-- form for yui dialog -->
<div id="myDialog">
  <div class="hd"><?php echo __('Add a person or organization') ?></div>
  <div class="bd">
    <form name="actorAcl" method="POST">
      <div class="form-item">
        <label for="addActor"><?php echo __('Actor name') ?></label>
        <select name="addActor" id="addActor" class="form-autocomplete"></select>
        <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>"/>
      </div>
    </form>
  </div>
</div>
<?php
$actionLabel = __('Action');
$permissionsLabel = __('Permissions');

$tableTemplate = <<<EOL
<div class="form-item">
<table id="actorPermission_{objectId}" class="inline">
<caption />
<thead>
<tr>
<th scope="col">$actionLabel</th>
<th scope="col">$permissionsLabel</th>
</tr>
</thead>
<tbody>
EOL;

$row = 0;
foreach ($basicActions as $action => $label)
{
  $tableTemplate .= '<tr class="'.((0 == $row++ % 2) ? 'even' : 'odd').'">';
  $tableTemplate .= '<td>'.__($label).'</th>';
  $tableTemplate .= '<td><ul class="radio inline">';
  $tableTemplate .= '<li><input type="radio" name="updatePermission[{objectId}_'.$action.']" value="'.QubitAcl::GRANT.'" />'.__('Grant').'</li>';
  $tableTemplate .= '<li><input type="radio" name="updatePermission[{objectId}_'.$action.']" value="'.QubitAcl::DENY.'" />'.__('Deny').'</li>';
  $tableTemplate .= '<li><input type="radio" name="updatePermission[{objectId}_'.$action.']" value="'.QubitAcl::INHERIT.'" checked />'.__('Inherit').'</li>';
  $tableTemplate .= '</ul></td>';
  $tableTemplate .= "</tr>\n";
}
  
$tableTemplate .= <<<EOL
</tbody>
</table>
</div>
EOL;

$tableTemplate = str_replace("\n", '', $tableTemplate); 
?>

<?php echo javascript_tag(<<<EOL
var handleCancel = function() {
    this.cancel();
};
var handleSubmit = function() {
  var actorInput = jQuery('input[name="addActor"]');
  var objectUri = actorInput.val().split('/');
  var objectId = objectUri.pop();

  // Don't duplicate an existing table
  if (0 < jQuery('table#actorPermission_'+objectId).length)
  {
    // Highlight caption of duplicate table
    var caption = jQuery('table#actorPermission_'+objectId+' caption');
    caption.css('background', 'yellow');
    
    this.hide(); // Hide dialog

    setTimeout(function () {
      caption.css('background', 'none');
    }, 1000);
  }
  else if ('null' != actorInput.val())
  {
    var newTable = '$tableTemplate';
    
    // Search and replace '{objectId}'
    while (0 <= newTable.indexOf('{objectId}'))
    {
      newTable = newTable.replace('{objectId}', objectId);
    }
      
    newTable = jQuery(newTable);
    newTable.find('caption').text(actorInput.next('input').val());
    newTable.hide();
    jQuery('a#addActorLink').parent('div').before(newTable);
    newTable.slideDown();
  }

  // Hide dialog
  this.hide();

  // Clear dialog values
  actorInput.val('null');
  actorInput.next('input').val(null);
};
var myButtons = [
    { text: "Submit", handler: handleSubmit, isDefault: true },
    { text: "Cancel", handler: handleCancel }
];

var config = {
  width: "480px",
  zIndex: "100",
  fixedcenter: true,
  draggable: true,
  visible: false,
  modal: true,
  constraintoviewport: true,
  postmethod: "none",
  effect: { effect: YAHOO.widget.ContainerEffect.FADE, duration: 0.25 }
}

var myDialog = new YAHOO.widget.Dialog('myDialog', config);
myDialog.cfg.queueProperty("buttons", myButtons);
myDialog.render();

// Remove all showEvent listeners to prevent default 'focusFirst' behaviour
myDialog.showEvent.unsubscribeAll();

// Focus on 'addActor' (visible) field
myDialog.showEvent.subscribe(function () { 
  document.getElementById('addActor').focus();
}, this, true);
 
EOL
) ?>

