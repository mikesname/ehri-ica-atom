<div class="digitalObjectList">
<?php foreach ($digitalObjects as $i => $digitalObject): ?>
  <?php $informationObject = $digitalObject->getInformationObject(); ?>
  <?php $collectionRoot = $informationObject->getCollectionRoot(); ?>
  <div class="digitalObject">
      <div class="digitalObjectRep">
        <?php include_component('digitalobject', 'show', array(
          'digitalObject'=>$digitalObject,
          'usageType'=>QubitTerm::THUMBNAIL_ID,
          'link'=>'informationobject/show?id='.$digitalObject->getInformationObjectId(),
          'iconOnly'=>true
        )); ?>
      </div>
      <div class="digitalObjectDesc" style="height: 84px">
        <?php echo string_wrap($informationObject->getTitle(), 18, 2); ?><br />
        <b><?php echo __('Part of') ?>:</b>
        <?php echo link_to($collectionRoot->getTitle(array('cultureFallback' => true)), 'informationobject/show?id='.$collectionRoot->getId()); ?>
      </div>
  </div>
<?php endforeach; ?>
</div>