<div class="pageTitle"><?php echo __('Map'); ?></div>

<table class="detail">
<tbody>

<?php if ($mapMetadata->getTitle()): ?>
  <tr><th colspan="2">

  <?php if ($editCredentials)
      {
      echo link_to($mapMetadata->getTitle(), 'map/edit/?id='.$mapMetadata->id);
      }
    else
      {
      echo $mapMetadata->getTitle();
      }
    ?>

  </th></tr>
<?php endif; ?>

<tr><td colspan="2">
<?php $map->printMap(); ?>
</td></tr>

<?php if ($mapMetadata->getDescription())
  {
  echo '<tr><td colspan="2">'.$mapMetadata->getDescription().'</td></tr>' ;
  }
?>

</tbody>
</table>

<div class="menu-action">
<?php if ($editCredentials): ?>
  <?php echo link_to(__('Edit'), 'map/edit?id='.$mapMetadata->id) ?>
<?php endif; ?>
</div>
