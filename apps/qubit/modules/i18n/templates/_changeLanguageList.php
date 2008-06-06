<div class="language-list">
  <?php foreach ($enabledI18nLanguages as $key => $language): ?>
    <?php if ($key == $sf_user->getCulture()): ?>
      <?php echo link_to($language, $sf_data->getRaw('sf_context')->getRouting()->getCurrentInternalUri(), array('query_string' => 'sf_culture='.$key, 'class' => 'active')) ?>
    <?php else: ?>
      <?php echo link_to($language, $sf_data->getRaw('sf_context')->getRouting()->getCurrentInternalUri(), array('query_string' => 'sf_culture='.$key)) ?>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
