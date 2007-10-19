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

<tr><th>Id: </th>
<td><?php echo $contactInformation->getId() ?></td></tr>

<tr><th>Contact type: </th>
<td><?php echo object_input_tag($contactInformation, 'getContactType') ?></td></tr>

<tr><th>Primary contact?</th>
<td><?php echo object_checkbox_tag($contactInformation, 'getPrimaryContact', array('style' => 'border: 0;')) ?></td></tr>

<tr><th>Street address:</th><td><?php echo object_textarea_tag($contactInformation, 'getStreetAddress', array ('size' => '30x3'))?></td></tr>

<tr><th>City:</th><td><?php echo object_input_tag($contactInformation, 'getCity') ?></td></tr>

<tr><th>Region/Province:</th><td><?php echo object_input_tag($contactInformation, 'getRegion') ?></td></tr>

<tr><th>Country:</th><td><?php echo object_select_tag($contactInformation, 'getCountryId', array ('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getCountries')) ?></td></tr>

<tr><th>Postal Code:</th><td><?php echo object_input_tag($contactInformation, 'getPostalCode') ?></td></tr>

<tr>
  <th>Longtitude:</th>
  <td><?php echo object_input_tag($contactInformation, 'getLongtitude', array (
  'size' => 20,
)) ?></td>
</tr>
<tr>
  <th>Latitude:</th>
  <td><?php echo object_input_tag($contactInformation, 'getLatitude', array (
  'size' => 20,
)) ?></td>
</tr>

<tr><th>Telephone:</th><td><?php echo object_input_tag($contactInformation, 'getTelephone') ?></td></tr>

<tr><th>Fax:</th><td><?php echo object_input_tag($contactInformation, 'getFax') ?></td></tr>

<tr><th>Email:</th><td><?php echo object_input_tag($contactInformation, 'getEmail') ?></td></tr>

<tr><th>Website:</th><td><?php echo object_input_tag($contactInformation, 'getWebsite') ?></td></tr>

<tr><th>Note:</td><td><?php echo input_tag('contactInformationNote')?></td></tr>

</tbody>
</table>


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
<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
</div>
</form>
