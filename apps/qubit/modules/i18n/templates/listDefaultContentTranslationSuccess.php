<div class="pageTitle"><?php echo __('Default content translation'); ?></div>

<?php echo form_tag('i18n/update') ?>
<?php echo input_hidden_tag('fieldset', 'static_pages') ?>
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Static pages')?></div>

<?php foreach ($staticPages as $staticPage): ?>
<fieldset class="collapsible collapsed" style="margin-top: 5px;">
    <legend><?php echo $staticPage->getPermalink() ?></legend>
<table class="list">
  <thead>
    <tr>
      <th><?php echo __('Source content')?></th>
      <th><?php echo __('Translated content')?></th>
    </tr>
  </thead>

  <tbody>
    <tr>
    <td><div class="default-translation"><?php echo $staticPage->getTitle(array('culture' => 'en'))?></div></td>
    <td><?php echo input_tag('static_page_title'.$staticPage->getId(), $staticPage->getTitle())?></td>
    </tr>
    <tr>
    <td><div class="default-translation" style="overflow: auto; width: 200px; valign: top;"><?php echo $staticPage->getContent(array('culture' => 'en')) ?></div></td>
    <td valign="top"><?php echo textarea_tag('static_page_content'.$staticPage->getId(), $staticPage->getContent(), array('size' => '30x20', 'style' => 'font-size: 11px;'))?></td>
    </tr>
    <tr><td colspan="3"><div style="float: right; margin: 3px 8px 0 0;"><?php echo submit_tag(__('Save')) ?></div></td></tr>
  </tbody>
</table>
</fieldset>
<?php endforeach; ?>
</form>

<?php echo form_tag('i18n/update') ?>
<?php echo input_hidden_tag('fieldset', 'taxonomy') ?>
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Taxonomies')?></div>
<fieldset class="collapsible collapsed">
    <legend><?php echo __('Taxonomies') ?></legend>
<table class="list">
  <thead>
    <tr>
      <th><?php echo __('Source content')?></th>
      <th><?php echo __('Translated content')?></th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($taxonomies as $taxonomy): ?>
    <tr>
    <td><div class="default-translation"><?php echo $taxonomy->getName(array('culture' => 'en'))?></div></td>
    <td><?php echo input_tag('taxonomy_'.$taxonomy->getId(), $taxonomy->getName())?></td>
    </tr>
  <?php endforeach; ?>
    <tr><td colspan="3"><div style="float: right; margin: 3px 8px 0 0;"><?php echo submit_tag(__('Save')) ?></div></td></tr>
  </tbody>
</table>
</fieldset>
</form>

<?php echo form_tag('i18n/update') ?>
<?php echo input_hidden_tag('fieldset', 'terms') ?>
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Terms')?></div>
<?php foreach ($taxonomies as $taxonomy): ?>
<fieldset class="collapsible collapsed">
    <legend><?php if (is_null($name = $taxonomy->getName())) $name = $taxonomy->getName(array('sourceCulture' => true)); echo $name ?></legend>
  <?php $terms = $taxonomy->getTerms(); ?>
  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('Source content')?></th>
        <th><?php echo __('Translated content')?></th>
      </tr>
    </thead>

    <tbody>
     <?php foreach ($terms as $term): ?>
     <tr>
     <td><div class="default-translation"><?php echo $term->getName(array('culture' => 'en'))?></div></td>
     <td><?php echo input_tag('term_'.$term->getId(), $term->getName())?></td>
     </tr>
     <?php endforeach; ?>
  </tbody>
</table>
<div style="float: right; margin: 3px 8px 0 0;"><?php echo submit_tag(__('Save')) ?></div>
</fieldset>
<?php endforeach; ?>

</form>
