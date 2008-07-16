<tr>
  <th><?php echo sfConfig::get('app_ui_label_physicalobject'); ?></th>
  
  <td>
    <?php foreach($physicalObjects as $i=>$physicalObject): ?>
      <?php if ($i > 0) { echo '<br /><br />'; } ?>
      <?php if ($physicalObject->getType()): ?>
      <?php echo $physicalObject->getType().': '; ?>
      <?php endif; ?>
      <?php if ($physicalObject->getName()): ?>
      <?php echo link_to($physicalObject->getName(), 
        'physicalobject/edit?id='.$physicalObject->getId(),
        array('query_string'=>'next=informationobject%2Fshow%3Fid%3D'.$informationObject->getId())); ?>
      <?php endif; ?>
      <?php if ($physicalObject->getLocation()): ?>
      <?php echo ' - '.$physicalObject->getLocation(); ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </td>
</tr>