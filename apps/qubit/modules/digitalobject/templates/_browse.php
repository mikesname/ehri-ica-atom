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
<?php if ($digitalObjects->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $digitalObjects->getLinks(); ?>
  <?php if ($digitalObjects->getPage() != $digitalObjects->getFirstPage()): ?>
    <?php echo link_to('< '.__('previous'), 'digitalobject/browse?mediatype='.$mediaTypeId.'&page='.($digitalObjects->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $digitalObjects->getPage()) ? $page : link_to($page, 'digitalobject/browse?mediatype='.$mediaTypeId.'&page='.$page) ?>
    <?php if ($page != $digitalObjects->getCurrentMaxLink()): ?> <?php endif ?>
  <?php endforeach ?>
  <?php if ($digitalObjects->getPage() != $digitalObjects->getLastPage()): ?>
    <?php echo link_to(__('next').' >', 'digitalobject/browse?mediatype='.$mediaTypeId.'&page='.($digitalObjects->getPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $digitalObjects->getFirstIndice(), '%2%' => $digitalObjects->getLastIndice(), '%3%' => $digitalObjects->getNbResults())) ?>
</div>
