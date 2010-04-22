<?php use_helper('Javascript') ?>

<h1><?php echo __('Edit archival description permissions') ?></h1>

<h1 class="label">
  <?php echo link_to(__('%1% group', array('%1%' => render_title($group))), array($group, 'module' => 'group', 'action' => 'indexInformationObjectAcl')) ?>
</h1>

<form method="post" action="<?php echo url_for(array($group, 'module' => 'aclGroup', 'action' => 'editInformationObjectAcl')) ?>" id="editForm">

<fieldset class="collapsible" id="allInfoObjectsArea">
  <legend><?php echo __('Permissions for all %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))) ?></legend>

<div class="form-item">
  <table class="inline" id="allInfoObjects" class="inline">
    <caption><em><?php echo __('All %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))) ?></em></caption> 

    <thead>
      <tr>
        <th scope="col"><?php echo __('Action') ?></th>
        <th scope="col"><?php echo __('Permission') ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($basicActions as $action => $label): ?>
      <tr class="<?php echo (0 == $row++ % 2) ? 'even' : 'odd' ?>">
        <td><?php echo __($label) ?></td>
        <td>
          <ul class="radio inline">
          <?php if (isset($root[$action])): ?>
            <li><?php echo radiobutton_tag('informationObjectAcl['.$root[$action]->id.']', QubitAcl::GRANT, 1 == $root[$action]->grantDeny) ?><?php echo __('Grant') ?></li>
            <li><?php echo radiobutton_tag('informationObjectAcl['.$root[$action]->id.']', QubitAcl::DENY, 0 == $root[$action]->grantDeny) ?><?php echo __('Deny') ?></li>
            <li><?php echo radiobutton_tag('informationObjectAcl['.$root[$action]->id.']', QubitAcl::INHERIT, false) ?><?php echo __('Inherit') ?></li>
          <?php else: ?>
            <li><?php echo radiobutton_tag('informationObjectAcl['.$action.'_'.url_for(array('module' => 'informationObject', 'id' => QubitInformationObject::ROOT_ID)).']', QubitAcl::GRANT, false) ?><?php echo __('Grant') ?></li>
            <li><?php echo radiobutton_tag('informationObjectAcl['.$action.'_'.url_for(array('module' => 'informationObject', 'id' => QubitInformationObject::ROOT_ID)).']', QubitAcl::DENY, false) ?><?php echo __('Deny') ?></li>
            <li><?php echo radiobutton_tag('informationObjectAcl['.$action.'_'.url_for(array('module' => 'informationObject', 'id' => QubitInformationObject::ROOT_ID)).']', QubitAcl::INHERIT, true) ?><?php echo __('Inherit') ?></li>
          <?php endif; ?>
          </ul>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</fieldset>

<fieldset class="collapsible collapsed" id="informationObjectArea">
  <legend><?php echo __('Permissions by archival description') ?></legend>

  <?php if (0 < count($informationObjects)): ?>
    <?php foreach ($informationObjects as $informationObjectId => $actions): ?>
    <div class="form-item">
    <table class="inline" id="informationObjectAcl_<?php echo $informationObjectId ?>" class="inline">
      <caption><?php echo render_title(QubitInformationObject::getById($informationObjectId)) ?></caption>

      <thead>
        <tr>
          <th scope="col"><?php echo __('Action') ?></th>
          <th scope="col"><?php echo __('Permission') ?></th>
        </tr>
      </thead>

      <tbody>
      <?php foreach ($basicActions as $action => $label): ?>
        <tr class="<?php echo (0 == $row++ % 2) ? 'even' : 'odd' ?>">
          <td><?php echo __($label) ?></td>
          <td id="<?php echo 'repo_'.$informationObjectId.'_'.$action ?>">
            <ul class="radio inline">
            <?php if (isset($actions[$action])): ?>
              <li><?php echo radiobutton_tag('informationObjectAcl['.$actions[$action]->id.']', QubitAcl::GRANT, 1 == $actions[$action]->grantDeny) ?><?php echo __('Grant') ?></li>
              <li><?php echo radiobutton_tag('informationObjectAcl['.$actions[$action]->id.']', QubitAcl::DENY, 0 == $actions[$action]->grantDeny) ?><?php echo __('Deny') ?></li>
              <li><?php echo radiobutton_tag('informationObjectAcl['.$actions[$action]->id.']', QubitAcl::INHERIT, false) ?><?php echo __('Inherit') ?></li>
            <?php else: ?>
              <li><?php echo radiobutton_tag('informationObjectAcl['.$action.'_'.url_for(array('module' => 'informationObject', 'id' => $informationObjectId)).']', QubitAcl::GRANT, false) ?><?php echo __('Grant') ?></li>
              <li><?php echo radiobutton_tag('informationObjectAcl['.$action.'_'.url_for(array('module' => 'informationObject', 'id' => $informationObjectId)).']', QubitAcl::DENY, false) ?><?php echo __('Deny') ?></li>
              <li><?php echo radiobutton_tag('informationObjectAcl['.$action.'_'.url_for(array('module' => 'informationObject', 'id' => $informationObjectId)).']', QubitAcl::INHERIT, true) ?><?php echo __('Inherit') ?></li>
            <?php endif; ?>
            </ul>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>

<?php
// Build dialog for adding new table
$tableTemplate  = '<div class="form-item">';
$tableTemplate .= '<table id="informationObjectAcl_{objectId}" class="inline">';
$tableTemplate .= '<caption />';
$tableTemplate .= '<thead>';
$tableTemplate .= '<tr>';
$tableTemplate .= '<th scope="col">'.__('Action').'</th>';
$tableTemplate .= '<th scope="col">'.__('Permissions').'</th>';
$tableTemplate .= '</tr>';
$tableTemplate .= '</thead>';
$tableTemplate .= '<tbody>';

$row = 0;
foreach ($basicActions as $action => $label)
{
  $tableTemplate .= '<tr class="'.((0 == $row++ % 2) ? 'even' : 'odd').'">';
  $tableTemplate .= '<td>'.__($label).'</th>';
  $tableTemplate .= '<td><ul class="radio inline">';
  $tableTemplate .= '<li><input type="radio" name="informationObjectAcl['.$action.'_{objectId}]" value="'.QubitAcl::GRANT.'" />'.__('Grant').'</li>';
  $tableTemplate .= '<li><input type="radio" name="informationObjectAcl['.$action.'_{objectId}]" value="'.QubitAcl::DENY.'" />'.__('Deny').'</li>';
  $tableTemplate .= '<li><input type="radio" name="informationObjectAcl['.$action.'_{objectId}]" value="'.QubitAcl::INHERIT.'" checked />'.__('Inherit').'</li>';
  $tableTemplate .= '</ul></td>';
  $tableTemplate .= "</tr>";
  $tableTemplate .= "</div>";
}

$tableTemplate .= '</tbody>';
$tableTemplate .= '</table>';

echo javascript_tag(<<<EOL
Drupal.behaviors.dialog = {
  attach: function (context)
  {
    Qubit.infoObjectDialog = new QubitAclDialog('addInformationObject', '$tableTemplate', jQuery);
  }
}
EOL
);

?>

    <!-- Add info object div - cut by aclDialog.js -->
    <div class="form-item" id="addInformationObject">
      <label for="addInformationObject"><?php echo __('Archival description name') ?></label>
      <select name="addInformationObject" id="addInformationObject" class="form-autocomplete"></select>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'informationobject', 'action' => 'autocomplete')) ?>"/>
    </div>

    <div class="form-item">
      <label for="addInformationObjectLink"><?php echo __('Add permissions by archival description') ?></label>
      <a id="addInformationObjectLink" href="javascript:Qubit.infoObjectDialog.show()"><?php echo __('Add archival description') ?></a>
    </div>

</fieldset>

<fieldset class="collapsible collapsed" id="repositoryArea">
  <legend><?php echo __('Permissions by archival institution') ?></legend>

  <?php if (0 < count($repositories)): ?>
    <?php foreach ($repositories as $repositoryId => $actions): ?>
    <div class="form-item">
    <table class="inline" id="repositoryAcl_<?php echo $repositoryId ?>" class="inline">
      <caption><?php echo render_title(QubitRepository::getById($repositoryId)) ?></caption>

      <thead>
        <tr>
          <th scope="col"><?php echo __('Action') ?></th>
          <th scope="col"><?php echo __('Permission') ?></th>
        </tr>
      </thead>

      <tbody>
      <?php foreach ($basicActions as $action => $label): ?>
        <tr class="<?php echo (0 == $row++ % 2) ? 'even' : 'odd' ?>">
          <td><?php echo __($label) ?></td>
          <td id="<?php echo 'repo_'.$repositoryId.'_'.$action ?>">
            <ul class="radio inline">
            <?php if (isset($actions[$action])): ?>
              <li><?php echo radiobutton_tag('repositoryAcl['.$actions[$action]->id.']', QubitAcl::GRANT, 1 == $actions[$action]->grantDeny) ?><?php echo __('Grant') ?></li>
              <li><?php echo radiobutton_tag('repositoryAcl['.$actions[$action]->id.']', QubitAcl::DENY, 0 == $actions[$action]->grantDeny) ?><?php echo __('Deny') ?></li>
              <li><?php echo radiobutton_tag('repositoryAcl['.$actions[$action]->id.']', QubitAcl::INHERIT, false) ?><?php echo __('Inherit') ?></li>
            <?php else: ?>
              <li><?php echo radiobutton_tag('repositoryAcl['.$action.'_'.url_for(array('module' => 'repository', 'id' => $repositoryId)).']', QubitAcl::GRANT, false) ?><?php echo __('Grant') ?></li>
              <li><?php echo radiobutton_tag('repositoryAcl['.$action.'_'.url_for(array('module' => 'repository', 'id' => $repositoryId)).']', QubitAcl::DENY, false) ?><?php echo __('Deny') ?></li>
              <li><?php echo radiobutton_tag('repositoryAcl['.$action.'_'.url_for(array('module' => 'repository', 'id' => $repositoryId)).']', QubitAcl::INHERIT, true) ?><?php echo __('Inherit') ?></li>
            <?php endif; ?>
            </ul>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>

<?php
// Build dialog for adding new table
$tableTemplate  = '<div class="form-item">';
$tableTemplate .= '<table id="repositoryAcl_{objectId}" class="inline">';
$tableTemplate .= '<caption />';
$tableTemplate .= '<thead>';
$tableTemplate .= '<tr>';
$tableTemplate .= '<th scope="col">'.__('Action').'</th>';
$tableTemplate .= '<th scope="col">'.__('Permissions').'</th>';
$tableTemplate .= '</tr>';
$tableTemplate .= '</thead>';
$tableTemplate .= '<tbody>';

$row = 0;
foreach ($basicActions as $action => $label)
{
  $tableTemplate .= '<tr class="'.((0 == $row++ % 2) ? 'even' : 'odd').'">';
  $tableTemplate .= '<td>'.__($label).'</th>';
  $tableTemplate .= '<td><ul class="radio inline">';
  $tableTemplate .= '<li><input type="radio" name="repositoryAcl['.$action.'_{objectId}]" value="'.QubitAcl::GRANT.'" />'.__('Grant').'</li>';
  $tableTemplate .= '<li><input type="radio" name="repositoryAcl['.$action.'_{objectId}]" value="'.QubitAcl::DENY.'" />'.__('Deny').'</li>';
  $tableTemplate .= '<li><input type="radio" name="repositoryAcl['.$action.'_{objectId}]" value="'.QubitAcl::INHERIT.'" checked />'.__('Inherit').'</li>';
  $tableTemplate .= '</ul></td>';
  $tableTemplate .= "</tr>";
  $tableTemplate .= "</div>";
}

$tableTemplate .= '</tbody>';
$tableTemplate .= '</table>';

echo javascript_tag(<<<EOL
Drupal.behaviors.dialog2 = {
  attach: function (context)
  {
    Qubit.repoDialog = new QubitAclDialog('addRepository', '$tableTemplate', jQuery);
  }
}
EOL
);

?>

    <!-- Add repository div - cut by aclDialog.js -->
    <div class="form-item" id="addRepository">
      <label for="addRepository"><?php echo __('Archival institution name') ?></label>
      <select name="addRepository" id="addRepository" class="form-autocomplete"></select>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'repository', 'action' => 'autocomplete')) ?>"/>
    </div>

    <div class="form-item">
      <label for="addRepositoryLink"><?php echo __('Add permissions by archival institution') ?></label>
      <a id="addRepositoryLink" href="javascript:Qubit.repoDialog.show()"><?php echo __('Add archival institution') ?></a>
    </div>

</fieldset>

  <div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($group, 'module' => 'aclGroup', 'action' => 'indexInformationObjectAcl')) ?></li>
        <li><?php echo submit_tag(__('Save')) ?></li>
      </ul>
    </div>
  </div>
    

</form>
