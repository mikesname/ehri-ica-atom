<div id="search-sidebar">
<?php echo form_tag('search/keyword', 'class=sidebarForm') ?>
<table><tr>
<td><?php echo input_tag('search_query', $query, 'class="textbox"'); ?></td><td><?php echo my_submit_tag(__('search')) ?></td></tr>
</table>
</form>
</div>
