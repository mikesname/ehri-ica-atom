<table class="digitalObjectBrowse">
<tr>
<?php foreach ($digitalObjects->getResults() as $i => $digitalObject): ?>
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
        <?php echo string_wrap($informationObject->getTitle(array('cultureFallback'=>true)), 16, 3); ?><br />
        <?php if ($collectionRoot->getId() != $informationObject->getId()): ?>
        <b><?php echo __('Part of') ?>:</b>
        <?php echo link_to($collectionRoot->getTitle(array('cultureFallback' => true)), 'informationobject/show?id='.$collectionRoot->getId()); ?>
        <?php endif; ?>
      </div>
  </div></td>
  <?php if((intval($i)%4) == 3): // New row after every 4 objects ?>
</tr>
<tr>
  <?php endif; ?>    
<?php endforeach; ?>
</tr>
</table>

<?php echo get_partial('default/pager', array('pager' => $digitalObjects)) ?>
