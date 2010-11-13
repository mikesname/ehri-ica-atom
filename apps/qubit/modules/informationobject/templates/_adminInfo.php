<div class="admin-info">
  <table>
    <tr>
      <td>
        <?php echo $form->publicationStatus->label(__('Publication status'))->renderRow() ?>
      </td><td>

        <h3><?php echo __('Source language') ?></h3>

        <?php if (isset($resource->sourceCulture)): ?>
          <?php if ($sf_user->getCulture() == $resource->sourceCulture): ?>
            <?php echo format_language($resource->sourceCulture) ?>
          <?php else: ?>
            <div class="default-translation">
              <?php echo link_to(format_language($resource->sourceCulture), array('sf_culture' => $resource->sourceCulture) + $sf_request->getParameterHolder()->getAll()) ?>
            </div>
          <?php endif; ?>
        <?php else: ?>
          <?php echo format_language($sf_user->getCulture()) ?>
        <?php endif; ?>

      </td>
    </tr>
  </table>
</div>
