<tr>
  <th><?php echo sfConfig::get('app_ui_label_physicalobject'); ?></th>
  <td>
    <?php if ($physicalObject->getName()): ?>
    <?php echo '<b>'.$physicalObject->getName().'</b>'; ?>
    <?php endif; ?>
    
    <?php if ($physicalObject->getLocation()): ?>
    <?php echo '<br />'.__('location').': '.$physicalObject->getLocation(); ?>
    <?php endif; ?>
    
    <?php if ($physicalObject->getType()): ?>
    <?php echo '<br />'.__('container type').': '.$physicalObject->getType(); ?>
    <?php endif; ?>
  </td>
</tr>