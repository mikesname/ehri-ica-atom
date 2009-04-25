<div class="menu-browse">
  <span id="label"><?php echo __('browse by') ?></span>
  <ul>
    <li><?php echo link_to(__(sfConfig::get('app_ui_label_subject')), array('module' => 'term', 'action' => 'browse', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?></li>
    <li><?php echo link_to(__(sfConfig::get('app_ui_label_place')), array('module' => 'term', 'action' => 'browse', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?></li>
    <li><?php echo link_to(__(sfConfig::get('app_ui_label_name')), array('module' => 'actor', 'action' => 'list')) ?></li>
    <li><?php echo link_to(__('image'), array('module' => 'digitalobject', 'action' => 'browse', 'mediatype' => QubitTerm::IMAGE_ID)) ?></li>
    <?php if($multiRepository): ?>
      <li><?php echo link_to(__(sfConfig::get('app_ui_label_repository')), array('module' => 'repository', 'action' => 'list')) ?></li>
    <?php endif; ?>
  </ul>
  <span id="label"><br /></span>
</div>