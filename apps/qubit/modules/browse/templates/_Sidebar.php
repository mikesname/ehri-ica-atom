<div id="browse-sidebar">
<?php echo form_tag('browse/list', 'class=sidebarForm') ?>
<table class="sidebar">
<tr>
<td><?php echo select_tag('browseList', options_for_select(
		array(	'subject' => __(sfConfig::get('app_ui_label_subject')),
					'actor' => __(sfConfig::get('app_ui_label_actor')),
					'repository' => __(sfConfig::get('app_ui_label_repository')),
					'language' => __('language')),
					$browseBy), 'class="selectbox"'); ?>
</td>
<td><?php echo my_submit_tag(__('browse')) ?></td>
</tr>
</table>
</form>
</div>
