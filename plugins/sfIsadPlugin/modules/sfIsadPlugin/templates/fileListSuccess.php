<h1><?php echo __('File list') ?></h1>

<?php echo get_partial('default/breadcrumb', array('objects' => $informationObject->ancestors->andSelf())) ?>

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
          <?php echo render_value($informationObject->getAccessConditions(array('cultureFallback' => true))) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
