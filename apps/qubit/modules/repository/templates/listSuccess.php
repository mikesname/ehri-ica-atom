<h1><?php echo __('List %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Name') ?>
      </th><th>
        <?php echo __('Type') ?>
      </th><th>
        <?php echo __('Country') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($repositories as $item): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to(render_title($item), array($item, 'module' => 'repository')) ?>
        </td><td>
          <ul>
            <?php foreach ($item->getTermRelations(QubitTaxonomy::REPOSITORY_TYPE_ID) as $relation): ?>
              <li><?php echo $relation->term ?></li>
            <?php endforeach; ?>
          </ul>
        </td><td>
          <?php echo $item->getCountry() ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div class="search">
  <form action="<?php echo url_for(array('module' => 'repository', 'action' => 'list')) ?>">
    <?php echo input_tag('query', $sf_request->query) ?>
    <?php echo submit_tag(__('Search %1%', array('%1%' => sfConfig::get('app_ui_label_repository')))) ?>
  </form>
</div>

<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">
      <?php if (SecurityPriviliges::editCredentials($sf_user, 'repository')): ?>
        <li><?php echo link_to(__('Add new'), array('module' => 'repository', 'action' => 'create')) ?></li>
      <?php endif; ?>
    </ul>
  </div>

</div>
