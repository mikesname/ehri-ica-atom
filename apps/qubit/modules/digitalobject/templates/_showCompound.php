<table class="compound_digiobj">
  <tr>
    <td>
    <?php if ($rep = $leftObject->getCompoundRepresentation()): ?>
      <?php if ($leftObjectLink): ?>
      <?php echo link_to(image_tag($rep->getFullPath()), $leftObjectLink, array('title'=>__('view full size'))) ?>
      <?php else: ?>
      <?php echo image_tag($rep->getFullPath()) ?>
      <?php endif; ?>
    <?php endif; ?>  
    </td>
    <td>
    <?php if (null !== $rightObject && $rep = $rightObject->getCompoundRepresentation()): ?>
      <?php if ($rightObjectLink): ?>
      <?php echo link_to(image_tag($rep->getFullPath()), $rightObjectLink, array('title'=>__('view full size'))) ?>
      <?php else: ?>
      <?php echo image_tag($rep->getFullPath()) ?>
      <?php endif; ?>
    <?php endif; ?>
    </td>
  </tr>
  <?php if($editCredentials && isset($masterDigiObjectLink)): ?>
  <tr>
    <td colspan="2" class="download_link">
      <?php echo link_to(__('download %1%', array('%1%' => $masterDigitalObject->getName())), $masterDigiObjectLink) ?>
    </td>
  </tr>
  <?php endif; ?>
</table>

<?php if ($pager->haveToPaginate()): ?>
<div class="pager compound_digiobj">
  <?php $links = $pager->getLinks(); ?>
  <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
 <?php echo link_to('< '.__('previous'), $currentObjectRoute.'&page='.($pager->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, $currentObjectRoute.'&page='.$page) ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
  <?php endforeach ?>
  <?php if ($pager->getPage() != $pager->getLastPage()): ?>
 <?php echo link_to(__('next').' >', $currentObjectRoute.'&page='.($pager->getPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif ?>

<div class="result-count compound_digiobj">
<?php if ($pager->getFirstIndice() < $pager->getLastIndice()): ?>
<?php echo __('displaying %1% to %2% of %3%', array('%1%' => $pager->getFirstIndice(), '%2%' => $pager->getLastIndice(), '%3%' => $pager->getNbResults())) ?>
<?php else: ?>
<?php echo __('displaying %1% of %3%', array('%1%' => $pager->getFirstIndice(), '%2%' => $pager->getLastIndice(), '%3%' => $pager->getNbResults())) ?>
<?php endif; ?>
</div>