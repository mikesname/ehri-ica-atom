<div class="form-item">
  <label for=""><?php echo __('Add new child levels') ?></label>
  <table class="inline multiRow">
    <thead>
      <tr>
        <th style="width: 20%">
          <?php echo __('Identifier') ?>
        </th><th style="width: 20%">
          <?php echo __('Level') ?>
        </th><th style="width: 60%">
          <?php echo __('Title') ?>
        </th>
      </tr>
    </thead><tbody>
      <tr>
        <td>
          <?php echo input_tag('updateChildLevels[0][identifier]') ?>
        </td><td>
          <?php echo object_select_tag(new QubitInformationObject, 'getLevelOfDescriptionId', array(
            'include_blank' => true,
            'name' => 'updateChildLevels[0][levelOfDescription]',
            'related_class' => 'QubitTerm',
            'peer_method' => 'getLevelsOfDescription')) ?>
        </td><td>
          <?php echo input_tag('updateChildLevels[0][title]') ?>
        </td>
      </tr>
    </tbody>
  </table>
</div>
