<?php use_helper('Javascript') ?>

<?php $sf_response->addJavaScript('/vendor/yui/yahoo-dom-event/yahoo-dom-event') ?>
<?php $sf_response->addJavaScript('/vendor/yui/container/container-min') ?>
<?php $sf_response->addStylesheet('/vendor/yui/container/assets/skins/sam/container') ?>

<div class="context-column-box">
  <div class="contextMenu">
    <?php if (1 < count($termTree)): ?>
      <div class="label">
        <?php echo __('taxonomy hierarchy') ?>
      </div>
      <?php include_component('term', 'treeView', array('termTree' => $termTree)) ?>
    <?php endif; ?>
  </div>
</div>
