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

<div id="button-block" style="height: 8em;">
<div class="menu-action">
  <?php if ($staticPage->getId()): ?>
    &#160;<?php echo link_to(__('delete'), 'staticpage/delete?id='.$staticPage->getId(), 'post=true&confirm='.__('are you sure?')) ?>
    &#160;<?php echo link_to(__('cancel'), 'staticpage/list') ?>
  <?php else: ?>
    &#160;<?php echo link_to(__('cancel'), 'staticpage/list') ?>
  <?php endif; ?>
    <?php if ($staticPage->getId()): ?>
      <?php echo submit_tag(__('save')) ?>
    <?php else: ?>
      <?php echo submit_tag(__('create')) ?>
    <?php endif; ?>
</div>

<div class="menu-extra" style="padding-top: 5px;">
<?php echo link_to(__('add new static page'), 'staticpage/create') ?>
</div>

</div>

</form>
