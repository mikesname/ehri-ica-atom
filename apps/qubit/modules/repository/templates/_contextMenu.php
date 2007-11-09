<div class="context-column-box">
<div class="contextMenu">
  <div class="label" style="margin-bottom: 3px;">
    <?php echo sfConfig::get('app_ui_label_holdings') ?>
  </div>

  <?php foreach ($repositoryHoldings as $holding): ?>
  <div class="node" style="border-bottom: 1px solid #cccccc; padding-bottom: 2px;">
    <div style="padding-left: 17px;" <?php if ($holding->hasChildren()) { echo 'class="plus"'; } ?>>
    <?php echo link_to($holding, 'informationobject/show?id='.$holding->getId()) ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
</div>
