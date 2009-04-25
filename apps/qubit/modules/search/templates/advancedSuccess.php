<div class="pageTitle"><?php echo __('advanced search'); ?></div>

<div id="search-form">
<?php echo form_tag('search/advanced', 'id=searchform') ?>
<table><tr>
<td><?php echo input_tag('search_query', $query, 'class="textbox"'); ?></td>
<td><?php echo submit_tag('search', array('class' => 'form-submit')) ?></td>
</tr></table>
</form>
</div>

<!-- use a Javascript hack to set the focus on the search box -->
<script type="text/javascript">
document.forms[0][0].focus();
</script>

<div style="border-bottom: 1px solid #000000; margin: 40px 0 10px 0;"></div>

<div id="search-info">
<?php if ($query) echo __("search for '%1%' resulted in %2% results", array('%1%' => $query, '%2%' => count($hits))); ?>
</div>

<?php foreach ($hits as $hit): ?>

  <div class="search-results">

    <h2><?php echo link_to($hit->display_title, 'informationobject/show?id='.$hit->informationObjectId) ?></h2>

    <div class="CRUD_summary">
      <?php echo truncate_text($hit->display_scopeandcontent, 250) ?>
    </div>

  </div>

<?php endforeach; ?>
