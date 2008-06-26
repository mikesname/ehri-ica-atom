<div class="label">
  <?php echo sfConfig::get('app_ui_label_physicalobject'); ?>
</div>

<table class="inline">
<?php foreach($physicalObjects as $physicalObject): ?>
<tr><td>
  <?php if($type = $physicalObject->getType()) echo $type.': '; ?>
  <?php echo link_to($physicalObject->getName(array('cultureFallback' => 'true')),
    'physicalobject/edit?id='.$physicalObject->getId().'&next=informationobject%2Fedit%3Fid%3D'.$currentInformationObject->getId()) ?>
  <?php if($location = $physicalObject->getLocation(array('cultureFallback' => 'true'))) echo ' - '.$location; ?>
</td></tr>
<?php endforeach; ?>
</table>
