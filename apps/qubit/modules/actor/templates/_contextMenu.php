<?php foreach ($relatedInfoObjects as $role => $informationObjects): ?>
  <div>
    <h3><?php echo __('%1% of', array('%1%' => $role)) ?></h3>
    <div>
      <ul>
        <?php foreach ($informationObjects as $informationObject): ?>
          <li><?php echo link_to(render_title($informationObject), array($informationObject, 'module' => 'informationobject')) ?><?php if (QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $informationObject->getPublicationStatus()->status->id): ?> <span class="publicationStatus"><?php echo $informationObject->getPublicationStatus()->status ?></span><?php endif; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
<?php endforeach; ?>

<?php echo get_partial('actor/format', array('resource' => $resource)) ?>
