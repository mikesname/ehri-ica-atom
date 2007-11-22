<div id="browse-sidebar">
<?php echo form_tag('browse/list', 'class=sidebarForm') ?>
<table class="sidebar">
<tr>
<td><?php echo select_tag('browseList', options_for_select(
		array(	'subject' => __('subject'),
					'actor' => __('authority file'),
					'repository' => __('archival institution'),
					'language' => __('language')),
					$browseBy), 'class="selectbox"'); ?>
</td>
<td><?php echo my_submit_tag(__('browse')) ?></td>
</tr>
</table>
</form>
</div>
