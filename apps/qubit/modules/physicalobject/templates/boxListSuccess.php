<h1><?php echo __('Box list') ?></h1>

<h1 class="label"><?php echo render_title($physicalObject) ?></h1>

<div class="section">
  <?php echo $physicalObject->location ?>
</div>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Reference code') ?>
      </th><th>
        <?php echo __('Title') ?>
      </th><th>
        <?php echo __('Date(s)') ?>
      </th><th>
        <?php echo __('Part of') ?>
      </th><th>
        <?php echo __('Conditions governing access') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($informationObjects as $informationObject): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo render_value(QubitIsad::getReferenceCode($informationObject)) ?>
        </td><td>
          <?php echo link_to(render_title($informationObject), array($informationObject, 'module' => 'informationobject')) ?>
        </td><td>
          <ul>
            <?php foreach ($informationObject->getDates() as $date): ?>
              <li>
                <?php echo date_display($date) ?> (<?php echo $date->getType(array('cultureFallback' => true)) ?>)
                <?php if (isset($date->actor)): ?>
                  <?php echo link_to(render_title($date->actor), array($date->actor, 'module' => 'actor')) ?>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </td><td>
          <?php if ($informationObject->getCollectionRoot()->id != $informationObject->id): ?>
            <?php echo link_to(render_title($informationObject->getCollectionRoot()), array('module' => 'informationobject', 'id' => $informationObject->getCollectionRoot()->id)) ?>
          <?php endif; ?>
        </td><td>
          <?php echo render_value($informationObject->getAccessConditions(array('cultureFallback' => true))) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
