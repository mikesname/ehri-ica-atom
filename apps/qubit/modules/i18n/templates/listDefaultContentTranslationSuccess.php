<div class="pageTitle"><?php echo __('Default content translation') ?></div>

<?php echo form_tag('i18n/update') ?>
<?php echo input_hidden_tag('fieldset', 'static_pages') ?>
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Static pages') ?></div>

<?php foreach ($staticPages as $staticPage): ?>
<fieldset class="collapsible collapsed" style="margin-top: 5px;">
    <legend><?php echo $staticPage->permalink ?></legend>
<table class="list">
  <thead>
    <tr>
      <th><?php echo __('Source content') ?></th>
      <th><?php echo __('Translated content') ?></th>
    </tr>
  </thead>

  <tbody>
    <tr>
    <td><div class="default-translation"><?php echo $staticPage->getTitle(array('culture' => 'en')) ?></div></td>
    <td><input name="static_page_title<?php echo $staticPage->id ?>" value="<?php echo $staticPage->title ?>"/></td>
    </tr>
    <tr>
    <td><div class="default-translation" style="overflow: auto; width: 200px; valign: top;"><?php echo $staticPage->getContent(array('culture' => 'en')) ?></div></td>
    <td valign="top"><?php echo textarea_tag('static_page_content'.$staticPage->id, $staticPage->content, array('size' => '30x20', 'style' => 'font-size: 11px;')) ?></td>
    </tr>
    <tr><td colspan="3"><div style="float: right; margin: 3px 8px 0 0;"><input class="form-submit" type="submit" value="<?php echo __('Save') ?>"/></div></td></tr>
  </tbody>
</table>
</fieldset>
<?php endforeach; ?>
</form>

<?php echo form_tag('i18n/update') ?>
<?php echo input_hidden_tag('fieldset', 'taxonomy') ?>
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Taxonomies') ?></div>
<fieldset class="collapsible collapsed">
    <legend><?php echo __('Taxonomies') ?></legend>
<table class="list">
  <thead>
    <tr>
      <th><?php echo __('Source content') ?></th>
      <th><?php echo __('Translated content') ?></th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($taxonomies as $taxonomy): ?>
    <tr>
    <td><div class="default-translation"><?php echo $taxonomy->getName(array('culture' => 'en')) ?></div></td>
    <td><input name="taxonomy_<?php echo $taxonomy->id ?>" value="<?php echo $taxonomy->name ?>"/></td>
    </tr>
  <?php endforeach; ?>
    <tr><td colspan="3"><div style="float: right; margin: 3px 8px 0 0;"><input class="form-submit" type="submit" value="<?php echo __('Save') ?>"/></div></td></tr>
  </tbody>
</table>
</fieldset>
</form>

<?php echo form_tag('i18n/update') ?>
<?php echo input_hidden_tag('fieldset', 'terms') ?>
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Terms') ?></div>
<?php foreach ($taxonomies as $taxonomy): ?>
<fieldset class="collapsible collapsed">
    <legend><?php if (is_null($name = $taxonomy->name)) $name = $taxonomy->getName(array('sourceCulture' => true)); echo $name ?></legend>
  <?php $terms = $taxonomy->terms ?>
  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('Source content') ?></th>
        <th><?php echo __('Translated content') ?></th>
      </tr>
    </thead>

    <tbody>
     <?php foreach ($terms as $term): ?>
     <tr>
     <td><div class="default-translation"><?php echo $term->getName(array('culture' => 'en')) ?></div></td>
     <td><input name="term_<?php echo $term->id ?>" value="<?php echo $term->name ?>"/></td>
     </tr>
     <?php endforeach; ?>
  </tbody>
</table>
<div style="float: right; margin: 3px 8px 0 0;"><input class="form-submit" type="submit" value="<?php echo __('Save') ?>"/></div>
</fieldset>
<?php endforeach; ?>

</form>
