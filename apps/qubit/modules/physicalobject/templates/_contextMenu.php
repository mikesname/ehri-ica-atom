<div>
  <h3><?php echo sfConfig::get('app_ui_label_physicalobject') ?></h3>
  <div>
    <ul>
      <?php foreach($physicalObjects as $physicalObject): ?>
        <li>
          <?php if (isset($physicalObject->type)): ?>
            <?php echo $physicalObject->type ?>:
          <?php endif; ?>
          <?php echo link_to_if(QubitAcl::check($informationObject, 'update'), render_title($physicalObject), array($physicalObject, 'module' => 'physicalobject')) ?>
          <?php if (isset($physicalObject->location)): ?>
            - <?php echo $physicalObject->getLocation(array('cultureFallback' => 'true')) ?>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
