<?php use_helper('Javascript') ?>

<h1><?php echo __('Edit %1% permissions', array('%1%' => sfConfig::get('app_ui_label_term'))) ?></h1>

<h1 class="label">
  <?php echo link_to(__('%1% group', array('%1%' => render_title($group))), array($group, 'module' => 'group', 'action' => 'indexTermAcl')) ?>
</h1>

<?php echo get_component('aclGroup', 'termAclForm', array('role' => $group, 'permissions' => $permissions, 'form' => $form)) ?>
