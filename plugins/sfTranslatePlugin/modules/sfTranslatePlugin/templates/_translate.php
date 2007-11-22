<?php use_helper('Javascript') ?>
<?php use_helper('Text') ?>

<div id="l10n-client">
  <div class="labels">
    <span id="l10n-client-hide"><?php echo __('X') ?></span>
    <span id="l10n-client-show"><?php echo __('Translate') ?></span>
    <div class="label strings">
      <h2><?php echo __('Page Text') ?></h2>
    </div>
    <div class="label source">
      <h2><?php echo __('Source') ?></h2>
    </div>
    <div class="label translation">
      <h2><?php echo __('%language% Translation', array('%language%' => format_language($sf_user->getCulture()))) ?></h2>
    </div>
  </div>
  <div id="l10n-client-string-select">
    <ul class="string-list">
      <?php foreach ($messages as $source => $target): ?>
        <li><?php echo truncate_text(esc_entities(empty($target) ? $source : $target)) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div id="l10n-client-string-editor">
    <?php echo form_tag('sfTranslatePlugin/translate', array('id' => 'l10n-client-form')) ?>
      <div class="source">
      </div>
      <div class="translation">
      </div>
      <?php echo my_submit_tag('save translation', array('style' => 'margin: 5px 20px 0 0; float: right; width: 150px;')) ?>
    </form>
  </div>
</div>
<?php echo javascript_tag('jQuery.extend(Drupal, {
  l10nSourceMessages: '.json_encode(array_keys($messages)).',
  l10nTargetMessages: '.json_encode(array_values($messages)).'});') ?>
