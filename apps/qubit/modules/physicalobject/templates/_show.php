<tr>
  <th><?php echo sfConfig::get('app_ui_label_physicalobject'); ?></th>
  
  <td>
    <?php foreach($physicalObjects as $i=>$physicalObject): ?>
      <?php if ($i > 0) { echo '<br /><br />'; } ?>
      <?php if ($physicalObject->getType()): ?>
      <?php echo $physicalObject->getType().': '; ?>
      <?php endif; ?>
      <?php if ($physicalObject->getName(array('cultureFallback' => 'true'))): ?>
      <?php echo link_to($physicalObject->getName(array('cultureFallback' => 'true')), 
        array('module' => 'physicalobject', 'action' => 'edit', 'id' => $physicalObject->getId()),
        array('query_string' => 'next='.url_for(array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->getId())))); ?>
      <?php endif; ?>
      <?php if ($physicalObject->getLocation(array('cultureFallback' => 'true'))): ?>
      <?php echo ' - '.$physicalObject->getLocation(array('cultureFallback' => 'true')); ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </td>
</tr>
