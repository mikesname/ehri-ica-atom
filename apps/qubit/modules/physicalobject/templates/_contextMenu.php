<div class="label">
  <?php echo sfConfig::get('app_ui_label_physicalobject'); ?>
</div>

<table class="inline">
<?php foreach($physicalObjects as $physicalObject): ?>
<tr><td>
  <?php if($type = $physicalObject->getType()) echo $type.': '; ?>
  <?php echo link_to($physicalObject->getName(array('cultureFallback' => 'true')),
    array('module' => 'physicalobject', 'action' => 'edit', 'id' => $physicalObject->getId()), 
    array('query_string' => 'next='.url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $informationObject->getId())))
  ) ?>
  <?php if($location = $physicalObject->getLocation(array('cultureFallback' => 'true'))) echo ' - '.$location; ?>
</td></tr>
<?php endforeach; ?>
</table>
