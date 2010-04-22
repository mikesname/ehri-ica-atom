<div class="field">
  <h3><?php echo __('Place access points') ?></h3>
  <div>
    <ul>
      <?php foreach ($informationObject->getPlaceAccessPoints() as $place): ?>
        <li><?php echo link_to($place->term, array($place->term, 'module' => 'term', 'action' => 'browseTerm')) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
