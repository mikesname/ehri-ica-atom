<form method="post" action="<?php echo url_for(array('module' => $sf_context->getModuleName(), 'action' => 'editTermAcl', 'id' => $role->id)) ?>" id="editForm">

<fieldset class="collapsible" id="allTermsArea">
  <legend><?php echo __('Permissions for all %1%', array('%1%' => sfConfig::get('app_ui_label_term'))) ?></legend>

<div class="form-item">
  <table class="inline" id="allTerms" class="inline">
    <caption><em><?php echo __('All %1%', array('%1%' => sfConfig::get('app_ui_label_term'))) ?></em></caption> 

    <thead>
      <tr>
        <th scope="col"><?php echo __('Action') ?></th>
        <th scope="col"><?php echo __('Permission') ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($termActions as $action => $label): ?>
      <tr class="<?php echo (0 == $row++ % 2) ? 'even' : 'odd' ?>">
        <td><?php echo __($label) ?></td>
        <td>
          <ul class="radio inline">
          <?php if (isset($rootPermissions[$action])): ?>
            <li><?php echo radiobutton_tag('termAcl['.$rootPermissions[$action]->id.']', QubitAcl::GRANT, 1 == $rootPermissions[$action]->grantDeny) ?><?php echo __('Grant') ?></li>
            <li><?php echo radiobutton_tag('termAcl['.$rootPermissions[$action]->id.']', QubitAcl::DENY, 0 == $rootPermissions[$action]->grantDeny) ?><?php echo __('Deny') ?></li>
            <li><?php echo radiobutton_tag('termAcl['.$rootPermissions[$action]->id.']', QubitAcl::INHERIT, false) ?><?php echo __('Inherit') ?></li>
          <?php else: ?>
            <li><?php echo radiobutton_tag('termAcl['.$action.'_'.url_for(array('module' => 'term', 'id' => QubitTerm::ROOT_ID)).']', QubitAcl::GRANT, false) ?><?php echo __('Grant') ?></li>
            <li><?php echo radiobutton_tag('termAcl['.$action.'_'.url_for(array('module' => 'term', 'id' => QubitTerm::ROOT_ID)).']', QubitAcl::DENY, false) ?><?php echo __('Deny') ?></li>
            <li><?php echo radiobutton_tag('termAcl['.$action.'_'.url_for(array('module' => 'term', 'id' => QubitTerm::ROOT_ID)).']', QubitAcl::INHERIT, true) ?><?php echo __('Inherit') ?></li>
          <?php endif; ?>
          </ul>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</fieldset>

<fieldset class="collapsible collapsed" id="taxonomyArea">
  <legend><?php echo __('Permissions by taxonomy') ?></legend>

  <?php if (0 < count($taxonomyPermissions)): ?>
    <?php foreach ($taxonomyPermissions as $taxonomyId => $actions): ?>
    <div class="form-item">
    <table class="inline" id="taxonomyAcl_<?php echo $taxonomyId ?>" class="inline">
      <caption><?php echo render_title(QubitTaxonomy::getById($taxonomyId)) ?></caption>

      <thead>
        <tr>
          <th scope="col"><?php echo __('Action') ?></th>
          <th scope="col"><?php echo __('Permission') ?></th>
        </tr>
      </thead>

      <tbody>
      <?php foreach ($termActions as $action => $label): ?>
        <tr class="<?php echo (0 == $row++ % 2) ? 'even' : 'odd' ?>">
          <td><?php echo __($label) ?></td>
          <td id="<?php echo 'repo_'.$taxonomyId.'_'.$action ?>">
            <ul class="radio inline">
            <?php if (isset($actions[$action])): ?>
              <li><?php echo radiobutton_tag('taxonomyAcl['.$actions[$action]->id.']', QubitAcl::GRANT, 1 == $actions[$action]->grantDeny) ?><?php echo __('Grant') ?></li>
              <li><?php echo radiobutton_tag('taxonomyAcl['.$actions[$action]->id.']', QubitAcl::DENY, 0 == $actions[$action]->grantDeny) ?><?php echo __('Deny') ?></li>
              <li><?php echo radiobutton_tag('taxonomyAcl['.$actions[$action]->id.']', QubitAcl::INHERIT, false) ?><?php echo __('Inherit') ?></li>
            <?php else: ?>
              <li><?php echo radiobutton_tag('taxonomyAcl['.$action.'_'.url_for(array('module' => 'taxonomy', 'id' => $taxonomyId)).']', QubitAcl::GRANT, false) ?><?php echo __('Grant') ?></li>
              <li><?php echo radiobutton_tag('taxonomyAcl['.$action.'_'.url_for(array('module' => 'taxonomy', 'id' => $taxonomyId)).']', QubitAcl::DENY, false) ?><?php echo __('Deny') ?></li>
              <li><?php echo radiobutton_tag('taxonomyAcl['.$action.'_'.url_for(array('module' => 'taxonomy', 'id' => $taxonomyId)).']', QubitAcl::INHERIT, true) ?><?php echo __('Inherit') ?></li>
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
$tableTemplate .= '<table id="taxonomyAcl_{objectId}" class="inline">';
$tableTemplate .= '<caption />';
$tableTemplate .= '<thead>';
$tableTemplate .= '<tr>';
$tableTemplate .= '<th scope="col">'.__('Action').'</th>';
$tableTemplate .= '<th scope="col">'.__('Permissions').'</th>';
$tableTemplate .= '</tr>';
$tableTemplate .= '</thead>';
$tableTemplate .= '<tbody>';

$row = 0;
foreach ($termActions as $action => $label)
{
  $tableTemplate .= '<tr class="'.((0 == $row++ % 2) ? 'even' : 'odd').'">';
  $tableTemplate .= '<td>'.__($label).'</th>';
  $tableTemplate .= '<td><ul class="radio inline">';
  $tableTemplate .= '<li><input type="radio" name="taxonomyAcl['.$action.'_{objectId}]" value="'.QubitAcl::GRANT.'" />'.__('Grant').'</li>';
  $tableTemplate .= '<li><input type="radio" name="taxonomyAcl['.$action.'_{objectId}]" value="'.QubitAcl::DENY.'" />'.__('Deny').'</li>';
  $tableTemplate .= '<li><input type="radio" name="taxonomyAcl['.$action.'_{objectId}]" value="'.QubitAcl::INHERIT.'" checked />'.__('Inherit').'</li>';
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
    Qubit.taxonomyDialog = new QubitAclDialog('addTaxonomy', '$tableTemplate', jQuery);
  }
}
EOL
);

?>

    <!-- Add taxonomy div - cut by aclDialog.js -->
    <div class="form-item" id="addTaxonomy">
      <?php echo $form->taxonomy->
        label(__('Taxonomy name'))->
        renderRow(array('class' => 'form-autocomplete')) ?>
    </div>

    <div class="form-item">
      <label for="addTaxonomyLink"><?php echo __('Add permissions by taxonomy') ?></label>
      <a id="addTaxonomyLink" href="javascript:Qubit.taxonomyDialog.show()"><?php echo __('Add taxonomy') ?></a>
    </div>

</fieldset>

  <div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array('module' => $sf_context->getModuleName(), 'action' => 'indexTermAcl', 'id' => $role->id)) ?></li>
        <li><?php echo submit_tag(__('Save')) ?></li>
      </ul>
    </div>
  </div>

</form>
