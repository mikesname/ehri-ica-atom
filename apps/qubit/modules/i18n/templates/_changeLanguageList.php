<ul class="language-list">
  <?php foreach (sfConfig::getAll() as $name => $value): ?>
    <?php if ('app_i18n_languages' == substr($name, 0, 18)): ?>
      <li<?php if ($sf_user->getCulture() == $value): ?> class="active"<?php endif; ?>><?php echo link_to(format_language($value, $value), array('sf_culture' => $value) + $sf_request->getParameterHolder()->getAll()) ?></li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>
