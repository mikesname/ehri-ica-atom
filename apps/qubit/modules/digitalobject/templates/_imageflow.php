<?php use_helper('Javascript') ?>
<div class="label">
  <?php echo sfConfig::get('app_ui_label_digitalobject'); ?>
</div>

<div id="imageflow_iewrapper">
<div id="imageflow" style="width: 235px"> 
  <div id="imageflow_loading">
    <b>Loading images</b><br/>
    <?php echo image_tag('imageflow/loading.gif', array('width'=>'203', 'height'=>'13', 'alt'=>'loading')); ?>
  </div>
  <div id="imageflow_images">
    <?php foreach($sf_data->getRaw('thumbnails') as $i => $thumbnail): ?>
    <?php echo image_tag($thumbnail->getFullPath(), array(
      'class'=>'imageflow',
      'longdesc'=>url_for('informationobject/show?id='.$informationObjects[$i]->getId()), 
      'alt'=>$informationObjects[$i]->getLabel(array('truncate' => 30))
    )) ?>
    <?php endforeach; ?>
  </div>
  <div id="imageflow_captions"></div>
  <div id="imageflow_scrollbar">
    <div id="imageflow_slider"></div>
  </div>
</div>
</div>
