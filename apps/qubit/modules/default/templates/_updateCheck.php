<?php if ($sf_request->getCookie('has_js')): ?>

  <?php $data = json_encode($sf_data->getRaw('updateCheckData')) ?>
  <?php $notificationMessage = __('A release %1% upgrade is available.') ?>

  <?php use_helper('Javascript') ?>

  <?php echo javascript_include_tag('/vendor/yui/cookie/cookie-min') ?>
  <?php echo javascript_include_tag('updateCheck') ?>

  <?php echo javascript_tag(<<<EOF
Qubit.updateCheck.url = '$updateCheckUrl';
Qubit.updateCheck.currentVersion = '$currentVersion';
Qubit.updateCheck.data = $data;
Qubit.updateCheck.notificationMessage = '$notificationMessage';
Qubit.updateCheck.cookiePath = '$cookiePath';
EOF
) ?>

<?php else: ?>

  <div id="update-check"><span><?php echo __($notificationMessage, array('%1%' => $lastVersion)) ?></span></div>

<?php endif; ?>
