<h1><?php echo __('Import complete') ?></h1>

<h1 class="label"><?php echo __('The following top-level terms were imported') ?></h2>

<?php echo $form->renderFormTag(url_for(array('module' => 'sfSkosPlugin', 'action' => 'import'))) ?>

  <ul>
    <?php for ($i = 0; $i < ($termsPerPage <= count($topLevelTerms) ? $termsPerPage : count($topLevelTerms)); $i++): ?>
      <?php $term = $topLevelTerms[$i] ?>
      <li><?php echo link_to($term->__toString(), url_for(array($term, 'module' => 'term'))) ?></li>
    <?php endfor; ?>
  </ul>

  <div>
    <?php echo __('A total of %1% terms were imported in %2%s', array('%1%' => count($terms), '%2%' => $timer->elapsed())) ?>
  </div>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('View %1%', array('%1%' => $taxonomy->__toString())), array($taxonomy, 'module' => 'taxonomy')) ?></li>
        <li><?php echo link_to(__('Import more %1%', array('%1%' => $taxonomy->__toString())), array($taxonomy, 'module' => 'sfSkosPlugin', 'action' => 'import')) ?></li>
      </ul>
    </div>

  </div>

</form>