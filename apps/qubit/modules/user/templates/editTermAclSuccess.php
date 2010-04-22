<?php use_helper('Javascript') ?>

<h1><?php echo __('Edit %1% permissions', array('%1%' => sfConfig::get('apps_ui_label_term'))) ?></h1>

<h1 class="label">
  <?php echo link_to(__('%1% profile', array('%1%' => $user->username)), array($user, 'module' => 'user', 'action' => 'indexTermAcl')) ?>
</h1>

<?php echo get_component('aclGroup', 'termAclForm', array('role' => $user, 'permissions' => $permissions, 'form' => $form)) ?>
