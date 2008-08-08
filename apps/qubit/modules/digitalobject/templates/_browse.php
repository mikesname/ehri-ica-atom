<table class="digitalObjectBrowse">
<tr>
<?php foreach ($digitalObjects as $i => $digitalObject): ?>
  <?php $informationObject = $digitalObject->getInformationObject(); ?>
  <?php $collectionRoot = $informationObject->getCollectionRoot(); ?>
  <td class="digitalObjectBrowse"><div class="digitalObject">
      <div class="digitalObjectRep">
        <?php include_component('digitalobject', 'show', array(
          'digitalObject'=>$digitalObject,
          'usageType'=>QubitTerm::THUMBNAIL_ID,
          'link'=>'informationobject/show?id='.$digitalObject->getInformationObjectId(),
          'iconOnly'=>true
        )); ?>
      </div>
      <div class="digitalObjectDesc">
        <?php echo string_wrap($informationObject->getTitle(), 16, 3); ?><br />
        <b><?php echo __('Part of') ?>:</b>
        <?php echo link_to($collectionRoot->getTitle(array('cultureFallback' => true)), 'informationobject/show?id='.$collectionRoot->getId()); ?>
      </div>
  </div></td>
  <?php if((intval($i)%4) == 3): // New row after every 4 objects ?>
</tr>
<tr>
  <?php endif; ?>    
<?php endforeach; ?>
</tr>
</table>