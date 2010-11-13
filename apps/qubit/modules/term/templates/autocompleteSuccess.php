<table>
  <tbody>
    <?php foreach ($terms as $item): ?>
      <tr>
        <td>
          <?php if ($item instanceof QubitTerm): ?>
            <?php echo link_to(render_title($item), array($item, 'module' => 'term')) ?>
          <?php else: ?>
            <?php echo link_to(__('%1% (use: %2%)', array('%1%' => $item[1], '%2%' => render_title($item[0]))), url_for(array($item[0], 'module' => 'term'))) ?>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
