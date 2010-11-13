<h1><?php echo __('Box list') ?></h1>

<h1 class="label"><?php echo render_title($resource) ?></h1>

<div class="section">
  <?php echo $resource->location ?>
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
    <?php foreach ($informationObjects as $item): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php $isad = new sfIsadPlugin($item); echo render_value($isad->referenceCode) ?>
        </td><td>
          <?php echo link_to(render_title($item), array($item, 'module' => 'informationobject')) ?>
        </td><td>
          <ul>
            <?php foreach ($item->getDates() as $date): ?>
              <li>
                <?php echo Qubit::renderDateStartEnd($date->getDate(array('cultureFallback' => true)), $date->startDate, $date->endDate) ?> (<?php echo $date->getType(array('cultureFallback' => true)) ?>)
                <?php if (isset($date->actor)): ?>
                  <?php echo link_to(render_title($date->actor), array($date->actor, 'module' => 'actor')) ?>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </td><td>
          <?php if ($item->getCollectionRoot()->id != $item->id): ?>
            <?php echo link_to(render_title($item->getCollectionRoot()), array('module' => 'informationobject', 'id' => $item->getCollectionRoot()->id)) ?>
          <?php endif; ?>
        </td><td>
          <?php echo render_value($item->getAccessConditions(array('cultureFallback' => true))) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
