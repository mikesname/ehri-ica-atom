<div class="pageTitle"><?php echo __('add/edit static page'); ?></div>

<?php echo form_tag('staticpage/update') ?>

<?php echo object_input_hidden_tag($staticPage, 'getId') ?>

<table class="detail">
<tbody>
<tr>
  <td colspan="2" class="headerCell">
  <?php echo ($staticPage->getTitle()) ? link_to($staticPage->getTitle(),'staticpage/static?permalink='.$staticPage->getPermalink()): ''; ?>
  </td>
</tr>
<tr>
  <th><?php echo __('title'); ?></th>
    <td>
      <?php if (strlen($sourceCultureValue = $staticPage->getTitle(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $staticPage->getSourceCulture()): ?>
      <div class="default-translation" id="title"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($staticPage, 'getTitle', array ('size' => 20)) ?>
    </td>
</tr>
<tr>
  <th><?php echo __('permalink'); ?></th>
  <td><?php echo $staticPage->getPermalink() ?></td>
</tr>
<tr>
  <th><?php echo __('content'); ?></th>
  <td>
      <?php if (strlen($sourceCultureValue = $staticPage->getContent(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $staticPage->getSourceCulture()): ?>
      <div class="default-translation" id="title"><?php echo nl2br($sourceCultureValue) ?></div>
      <?php endif; ?>
    <?php echo object_textarea_tag($staticPage, 'getContent', array ('class' => 'resizable', 'size' => '30x10')) ?>
  </td>
</tr>
</tbody>
</table>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block">
<div class="menu-action">
  <?php echo link_to(__('Cancel'), 'staticpage/list') ?>
  <?php if ($staticPage->getId()): ?>
    <?php echo submit_tag(__('Save')) ?>
  <?php else: ?>
    <?php echo submit_tag(__('Create')) ?>
  <?php endif; ?>
</div>

</div>

</form>
