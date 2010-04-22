<table class="compound_digiobj">

  <tr>
    <td>
      <?php if (null !== $representation = $leftObject->getCompoundRepresentation()): ?>
        <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject') || QubitTerm::TEXT_ID == $digitalObject->mediaType->id, image_tag($representation->getFullPath()), public_path($leftObject->getFullPath(), array('title' => __('View full size')))) ?>
      <?php endif; ?>
    </td><td>
      <?php if (null !== $rightObject && null !== $representation = $rightObject->getCompoundRepresentation()): ?>
        <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject') || QubitTerm::TEXT_ID == $digitalObject->mediaType->id, image_tag($representation->getFullPath()), public_path($rightObject->getFullPath(), array('title' => __('View full size')))) ?>
      <?php endif; ?>
    </td>
  </tr>

  <?php if (SecurityPriviliges::editCredentials($sf_user, 'informationObject')): ?>
    <tr>
      <td colspan="2" class="download_link">
        <?php echo link_to(__('Download %1%', array('%1%' => $digitalObject)), public_path($digitalObject->getFullPath())) ?>
      </td>
    </tr>
  <?php endif; ?>

</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
