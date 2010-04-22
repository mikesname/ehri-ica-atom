<h1><?php echo __('List %1%', array('%1%' => render_title($taxonomy))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th><?php echo __('Name') ?></th>
    </tr>
  </thead><tbody>
    <?php foreach ($terms as $item): ?>
      <tr>
        <td>
          <?php if (0 < count($preferred = $item->getEquivalentTerms(array('direction' => 'use')))): ?>
            <?php echo link_to(__('%1% (use: %2%)', array('%1%' => render_title($item), '%2%' => render_title($preferred[0]))), array($preferred[0], 'module' => 'term')) ?>
          <?php else: ?>
            <?php echo link_to(render_title($item), array($item, 'module' => 'term')) ?>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
