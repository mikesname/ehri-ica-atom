<div class="pageTitle">Harvested Sites</div>
<table class="list">
<thead>
  <tr>
      <th>
            <a href="/Qubit/web/actor/list/role/all/sort/nameDown/page/1">Repository Name</a>
            <img style="padding-bottom: 3px" src="/Qubit/web/images/up.gif" alt="Up" />
      </th>
      <th>Harvest</th>
      <th>Delete</th>
  </tr>
</thead>
<tbody>



<?php foreach($repositories as $rep): ?>
  <tr>
      <td>
        <div>
          <a href="<?php echo $rep->getUri();?>?verb=Identify"><?php echo $rep->getName(); ?></a><br>Last Harvest: <?php $harvest = QubitOaiHarvest::getLastHarvestByID($rep->getId()); echo $harvest->getLastHarvest();;?>
        </div>
      </td>
      <td>
      <?php foreach($rep->getOaiHarvests() as $harvestJob): ?>
        <a href ="<?php echo url_for('oai/harvest')?>/next/<?php echo $harvestJob->getId().'/'?>">Harvest</a>
      <?php endforeach; ?>
        </td><td><a href ="<?php echo url_for('oai/deleteRepository').'/'.$rep->getId().'/'?>">Delete</a></td>

  </tr>
<?php endforeach; ?>

</tbody>
</table>
<br>
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Add New Repository') ?></div>
  <form action="<?php echo url_for('oai/harvesterList') ?>" method="POST">

      <table class="List">
      <thead>
    <tr>
      <th width="30%"><?php echo __('name')?></th>
      <th><?php echo __('value')?></th>
    </tr>

      </thead>
      <tbody>
            <?php echo $form ?>
    <tr>
            <td>&nbsp;</td>
            <td>
              <div style="float: right; margin: 3px 8px 0 0;">
                <?php echo submit_tag(__('Save')) ?>
              </div>
            </td>
          </tr>

      </tbody>
</table>
      </form>
</div>
