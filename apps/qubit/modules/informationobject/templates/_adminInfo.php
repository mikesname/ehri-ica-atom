<div class="admin-info">
  <table>
    <tr>
      <td>
        <?php echo $form->publicationStatus->label(__('Publication status'))->renderRow() ?>
      </td><td>
        <div class="form-item">
          <label for="source language"><?php echo __('Source language') ?></label>
          <?php if (isset($informationObject->sourceCulture)): ?>
            <?php if ($sf_user->getCulture() == $informationObject->sourceCulture): ?>
              <?php echo format_language($informationObject->sourceCulture) ?>
            <?php else: ?>
              <div class="default-translation">
                <?php echo link_to(format_language($informationObject->sourceCulture), array('sf_culture' => $informationObject->sourceCulture) + $sf_request->getParameterHolder()->getAll()) ?>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <?php echo format_language($sf_user->getCulture()) ?>
          <?php endif; ?>
        </div>
      </td>
    </tr>
  </table>
</div>
