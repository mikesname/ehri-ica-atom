<div id="language-sidebar">
<form class="sidebarForm" method="post" action="<?php echo $currentURI; ?>">
<table class="sidebar">
	<tr>
	<td><?php echo select_tag('sf_culture', options_for_select(array('en' => 'english', 'fr' => 'français'), $language), 'class="selectbox"'); ?></td>
	<td><?php echo my_submit_tag(__('change')) ?></td>
	</tr>
</table>
</form>
</div>