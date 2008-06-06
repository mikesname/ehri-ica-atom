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
  		<?php if ($sf_user->getCulture() != sfConfig::get('sf_default_culture')): ?>
	  		<div class="default-translation" id="title"><?php echo $staticPage->getTitle(array('culture' => sfConfig::get('sf_default_culture'))) ?></div>
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
  		<?php if ($sf_user->getCulture() != sfConfig::get('sf_default_culture')): ?>
	  		<div class="default-translation" id="content"><?php echo nl2br($staticPage->getContent(array('culture' => sfConfig::get('sf_default_culture')))) ?></div>
	  	<?php endif; ?>
		<?php echo object_textarea_tag($staticPage, 'getContent', array ('size' => '30x10')) ?>
	</td>
</tr>
</tbody>
</table>

<div class="menu-action">
	<?php if ($staticPage->getId()): ?>
		&#160;<?php echo link_to(__('delete'), 'staticpage/delete?id='.$staticPage->getId(), 'post=true&confirm='.__('are you sure?')) ?>
		&#160;<?php echo link_to(__('cancel'), 'staticpage/list') ?>
	<?php else: ?>
		&#160;<?php echo link_to(__('cancel'), 'staticpage/list') ?>
	<?php endif; ?>
    <?php if ($staticPage->getId()): ?>
      <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    <?php else: ?>
      <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
    <?php endif; ?>
</div>

</form>
