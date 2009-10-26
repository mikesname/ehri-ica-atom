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

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
