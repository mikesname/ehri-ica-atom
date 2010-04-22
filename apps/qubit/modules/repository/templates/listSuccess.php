<h1><?php echo __('List %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Name') ?>
        <?php if (SecurityPriviliges::editCredentials($sf_user, 'repository')): ?>
          <?php echo link_to(__('Add new'), array('module' => 'repository', 'action' => 'create')) ?>
        <?php endif; ?>
      </th><th>
        <?php echo __('Type') ?>
      </th><th>
        <?php echo __('Country') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($repositories as $repository): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to(render_title($repository), array($repository, 'module' => 'repository')) ?>
        </td><td>
          <ul>
            <?php foreach ($repository->getTermRelations(QubitTaxonomy::REPOSITORY_TYPE_ID) as $relation): ?>
              <li><?php echo $relation->term ?></li>
            <?php endforeach; ?>
          </ul>
        </td><td>
          <?php echo $repository->getCountry() ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div class="search">
  <form action="<?php echo url_for(array('module' => 'repository', 'action' => 'list')) ?>">
    <?php echo input_tag('query', $sf_request->query) ?>
    <?php echo submit_tag(__('Search ').sfConfig::get('app_ui_label_repository')) ?>
  </form>
</div>
