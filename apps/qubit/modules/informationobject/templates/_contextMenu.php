<?php use_helper('Javascript') ?>

<div class="context-column-box">
  <div class="contextMenu">
    <?php $options = array() ?>
    <?php if (null === $repository = $informationObject->getRepository()): ?>
      <?php foreach ($informationObject->getAncestors() as $ancestor): ?>
        <?php if (null === $repository = $ancestor->getRepository()): ?>
          <?php continue ?>
        <?php endif; ?>
        <?php $sf_response->addStylesheet('yui/container/assets/skins/sam/container') ?>
        <?php $sf_response->addJavaScript('yui/yahoo-dom-event/yahoo-dom-event') ?>
        <?php $sf_response->addJavaScript('yui/container/container-min') ?>
        <?php echo javascript_tag(<<<EOF
var repositoryTooltip = new YAHOO.widget.Tooltip('repositoryTooltip', {
  context: 'repositoryLink'});
EOF
) ?>
        <?php $options['id'] = 'repositoryLink' ?>
        <?php $options['title'] = __('Inherited from %ancestor%', array('%ancestor%' => $ancestor)) ?>
        <?php break ?>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($repository)): ?>
      <div class="label">
        <?php echo sfConfig::get('app_ui_label_repository') ?>
      </div>
      <?php echo link_to($repository, 'repository/show?id='.$repository->getId(), $options) ?>
    <?php endif; ?>

    <?php $options = array() ?>
    <?php if (count($creators = $informationObject->getCreators()) < 1): ?>
      <?php foreach ($informationObject->getAncestors() as $ancestor): ?>
        <?php if (count($creators = $ancestor->getCreators()) < 1): ?>
          <?php continue ?>
        <?php endif; ?>
        <?php $sf_response->addStylesheet('yui/container/assets/skins/sam/container') ?>
        <?php $sf_response->addJavaScript('yui/yahoo-dom-event/yahoo-dom-event') ?>
        <?php $sf_response->addJavaScript('yui/container/container-min') ?>
        <?php echo javascript_tag(<<<EOF
var repositoryTooltip = new YAHOO.widget.Tooltip('creatorsTooltip', {
  context: 'creatorsLink'});
EOF
) ?>
        <?php $options['id'] = 'creatorsLink' ?>
        <?php $options['title'] = __('Inherited from %ancestor%', array('%ancestor%' => $ancestor)) ?>
        <?php break ?>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php if (count($creators) > 0): ?>
      <div class="label">
        <?php echo sfConfig::get('app_ui_label_creator') ?>
      </div>
      <ul style="margin:0; padding: 0;">
        <?php foreach ($creators as $creator): ?>
          <li style="margin:0; padding 0;"><?php echo link_to($creator, 'actor/show?id='.$creator->getId(), $options) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (count($informationObjects) > 1): ?>
      <?php include_component('digitalobject', 'imageflow', array('informationObject' => $informationObject)) ?>
    <?php endif; ?>

    <?php if (count($informationObjects) > 1): ?>
      <div class="label">
        <?php if (null === $levelOfDescription = $informationObject->getCollectionRoot()->getLevelOfDescription()) $levelOfDescription = sfConfig::get('app_ui_label_collection'); echo $levelOfDescription ?>
      </div>
      <?php include_component('informationobject', 'treeView', array('informationObjects' => $informationObjects)) ?>
    <?php endif; ?>
    
    <?php if (count($informationObjects) > 1 && $editCredentials == true): ?>
      <?php include_component('physicalobject', 'contextMenu', array('informationObjects' => $informationObjects)) ?>
    <?php endif; ?>
    
  </div>
</div>
