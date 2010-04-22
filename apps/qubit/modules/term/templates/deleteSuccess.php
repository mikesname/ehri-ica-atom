<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($term))) ?></h1>

<?php if (0 < $term->getRelatedObjectCount()): ?>

  <h2><?php echo __('This term is used in %1% descriptions. The term will be deleted from these descriptions.', array('%1%' => $term->getRelatedObjectCount())) ?></h2>

  <?php echo __('The related object(s) will <strong>not</strong> be deleted') ?>

<?php endif; ?>

<?php if (0 < count($term->events)): ?>

  <h2><?php echo __('It\'s used in %1% events that will also be deleted', array('%1%' => count($term->events))) ?></h2>

  <ul>
    <?php foreach ($term->events as $event): ?>
      <li><?php echo date_display($event) ?> (<?php echo render_title($term) ?>) <?php echo link_to(render_title($event->informationObject), array($event->informationObject, 'module' => 'informationobject')) ?></li><?php endforeach; ?>
  </ul>

<?php endif; ?>

<?php if (0 < count($term->descendants)): ?>

  <h2><?php echo __('It has %1% descendants that will also be deleted', array('%1%' => count($term->descendants))) ?><h2>

  <ul>
    <?php foreach ($term->descendants as $descendant): ?>
      <li><?php echo link_to(render_title($descendant), array($descendant, 'module' => 'term')) ?></li>
    <?php endforeach; ?>
  </ul>

<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array($term, 'module' => 'term', 'action' => 'delete')), array('method' => 'delete')) ?>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($term, 'module' => 'term')) ?></li>
        <li><?php echo submit_tag(__('Confirm')) ?></li>
      </ul>
    </div>

  </div>

</form>
