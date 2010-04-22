<div class="browse section">

  <h2 class="element-invisible"><?php echo __('Browse') ?></h2>

  <div class="content">
    <ul class="links">

      <li><?php echo link_to(__(sfConfig::get('app_ui_label_informationobject')), array('module' => 'informationobject', 'action' => 'browse')) ?></li>
      <li><?php echo link_to(__(sfConfig::get('app_ui_label_name')), array('module' => 'actor', 'action' => 'browse')) ?></li>

      <?php if (sfConfig::get('app_multi_repository')): ?>
        <li><?php echo link_to(__(sfConfig::get('app_ui_label_repository')), array('module' => 'repository', 'action' => 'browse')) ?></li>
      <?php endif; ?>

      <li><?php echo link_to(__('functions'), array('module' => 'function', 'action' => 'list')) ?></li>
      <li><?php echo link_to(__(sfConfig::get('app_ui_label_subject')), array('module' => 'term', 'action' => 'browseTaxonomy', 'id' => QubitTaxonomy::SUBJECT_ID)) ?></li>
      <li><?php echo link_to(__(sfConfig::get('app_ui_label_place')), array('module' => 'term', 'action' => 'browseTaxonomy', 'id' => QubitTaxonomy::PLACE_ID)) ?></li>
      <li><?php echo link_to(__('digital objects'), array('module' => 'digitalobject', 'action' => 'list')) ?></li>

    </ul>
  </div>

</div>
