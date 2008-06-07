<div class="pageTitle">edit ContactInformation</div>

<?php echo form_tag('actor/updateContactInformation') ?>

<?php echo input_hidden_tag('template', 'isiah') ?>

<?php if ($repositoryReroute)
  {
  echo input_hidden_tag('repositoryReroute', $repositoryReroute);
  }
  ?>

<?php echo object_input_hidden_tag($contactInformation, 'getId') ?>

<table class="detail">
<tbody>

<tr><td colspan="2" class="headerCell">
  <?php echo ($contactInformation->getActorId()) ? link_to($contactInformation->getActor(), 'actor/edit?id='.$contactInformation->getActorId()) : ''; ?>
</td></tr>

<tr><th><?php echo __('Contact type') ?> </th>
<td><?php echo object_input_tag($contactInformation, 'getContactType') ?></td></tr>

<tr><th><?php echo __('Primary contact?') ?></th>
<td><?php echo object_checkbox_tag($contactInformation, 'getPrimaryContact', array('style' => 'border: 0; width: 20px;')) ?></td></tr>

<tr><th><?php echo __('Street address') ?></th><td><?php echo object_textarea_tag($contactInformation, 'getStreetAddress', array ('size' => '30x3'))?></td></tr>

<tr><th><?php echo __('City') ?></th><td><?php echo object_input_tag($contactInformation, 'getCity') ?></td></tr>

<tr><th><?php echo __('Region/Province') ?></th><td><?php echo object_input_tag($contactInformation, 'getRegion') ?></td></tr>

<tr><th><?php echo __('Country') ?></th><td><?php echo object_select_country_tag($contactInformation, 'getCountryCode', array('include_blank' => true)) ?></td></tr>

<tr><th><?php echo __('Postal Code') ?></th><td><?php echo object_input_tag($contactInformation, 'getPostalCode') ?></td></tr>

<tr>
  <th><?php echo __('Latitude') ?></th>
  <td><?php echo object_input_tag($contactInformation, 'getLatitude', array (
  'size' => 20,
)) ?></td>
</tr>
<tr>
  <th><?php echo __('Longtitude') ?></th>
  <td><?php echo object_input_tag($contactInformation, 'getLongtitude', array (
  'size' => 20,
)) ?></td>
</tr>

<tr><th><?php echo __('Telephone') ?></th><td><?php echo object_input_tag($contactInformation, 'getTelephone') ?></td></tr>

<tr><th><?php echo __('Fax') ?></th><td><?php echo object_input_tag($contactInformation, 'getFax') ?></td></tr>

<tr><th><?php echo __('Email') ?></th><td><?php echo object_input_tag($contactInformation, 'getEmail') ?></td></tr>

<tr><th><?php echo __('Website') ?></th><td><?php echo object_input_tag($contactInformation, 'getWebsite') ?></td></tr>

<tr><th><?php echo __('Note') ?></td><td><?php echo object_input_tag($contactInformation, 'getNote')?></td></tr>

</tbody>
</table>

</form>

<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block" style="height: 4em;">

<div class="menu-action">
<?php if ($contactInformation->getId()): ?>
    &nbsp;
    <?php if ($repositoryReroute)
      {
      echo link_to(__('delete'), 'actor/deleteContactInformation?contactInformationId='.$contactInformation->getId().'&returnTemplate=isiah&repositoryReroute='.$repositoryReroute, 'post=true&confirm='.__('are you sure?'));
      }
    else
      {
      echo link_to(__('delete'), 'actor/deleteContactInformation?contactInformationId='.$contactInformation->getId().'&returnTemplate=isaar');
      }
    ; ?>
  &nbsp;
  <?php if ($repositoryReroute)
      {
      echo link_to(__('cancel'), 'repository/edit?id='.$repositoryReroute);
      }
    else
      {
      echo link_to(__('cancel'), 'actor/edit?id='.$contactInformation->getActorId());
      }
    ; ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('cancel'), 'actor/edit?id='.$contactInformation->getActorId()) ?>
<?php endif; ?>

    <?php if ($contactInformation->getId()): ?>
      <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
    <?php else: ?>
      <?php echo my_submit_tag(__('create'), array('style' => 'width: auto;')) ?>
    <?php endif; ?>

</div>
</div>

