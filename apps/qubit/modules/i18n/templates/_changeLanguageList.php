<div class="language-list">

  <?php foreach($i18nLanguages as $language): ?>


      <?php echo link_to($language->getTermName(), $sf_context->getRouting()->getCurrentInternalUri(), array('query_string' => 'sf_culture='.$language->getCodeAlpha(), 'class' => 'test')) ?>

  <?php endforeach; ?>
</div>