<h1><?php echo __('View %1%', array('%1%' => sfConfig::get('app_ui_label_physicalobject'))) ?></h1>

<h1 class="label"><?php echo render_title($physicalObject) ?></h1>

<ul>
  <?php foreach (QubitRelation::getRelatedObjectsBySubjectId('QubitInformationObject', $physicalObject->id, array('typeId' => QubitTerm::HAS_PHYSICAL_OBJECT_ID)) as $informationObject): ?>
    <li><?php echo link_to(render_title($informationObject), array($informationObject, 'module' => 'informationobject')) ?></li>
  <?php endforeach; ?>
</ul>

<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">
      <li><?php echo link_to(__('Edit'), array($physicalObject, 'module' => 'physicalobject', 'action' => 'edit')) ?></li>
      <li><?php echo link_to(__('Delete'), array($physicalObject, 'module' => 'physicalobject', 'action' => 'delete', 'next' => $sf_request->getReferer())) ?></li>
    </ul>
  </div>

</div>
