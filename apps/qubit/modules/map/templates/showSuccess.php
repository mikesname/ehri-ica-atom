<div class="pageTitle"><?php echo __('map'); ?></div>

<table class="detail">
<tbody>

<?php if ($mapMetadata->getTitle())
  {
  if ($editCredentials)
    {
    echo '<tr><td colspan="2" class="headerCell">'.link_to($mapMetadata->getTitle(), 'map/edit/?id='.$mapMetadata->getId()).'</td></tr>' ;
    }
  else
    {
    echo '<tr><td colspan="2" class="headerCell">'.$mapMetadata->getTitle().'</td></tr>' ;
    }
  }
?>

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
<?php if ($editCredentials) { echo link_to(__('edit'), 'map/edit?id='.$mapMetadata->getId()); } ?>
</div>
