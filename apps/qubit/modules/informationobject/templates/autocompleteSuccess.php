<h1><?php echo __('List %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))) ?></h1>

<table>
  <thead>
    <tr>
      <th>
        <?php echo __('Title') ?>
        <?php if (QubitAcl::check($informationObject, 'create')): ?>
          <?php echo link_to(__('Add new'), array('module' => 'informationobject', 'action' => 'create', 'parent' => url_for(array($informationObject, 'module' => 'informationobject')))) ?>
        <?php endif; ?>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($informationObjects as $item): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to($item->getLabel(), array($item, 'module' => 'informationobject')) ?><?php if (QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $item->getPublicationStatus()->status->id): ?> <span class="publicationStatus"><?php echo $item->getPublicationStatus()->status ?></span><?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
