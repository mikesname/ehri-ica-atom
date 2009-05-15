<div class="pageTitle"><?php echo __('edit Contact Information') ?></div>

<?php echo form_tag(array('module' => 'actor', 'action' => 'editContactInformation')) ?>

<?php echo input_hidden_tag('template', 'isdiah') ?>

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
</tbody>
</table>

<div class="form-item">
<label for="street address"><?php echo __('Street address') ?></label>
<?php echo object_textarea_tag($contactInformation, 'getStreetAddress', array ('size' => '30x3'))?>
</div>

<div class="form-item">
<label for="city"><?php echo __('City') ?></label>
<?php if (strlen($sourceCultureValue = $contactInformation->getCity(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $contactInformation->getSourceCulture()): ?>
    <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
    <?php endif; ?>
<?php echo object_input_tag($contactInformation, 'getCity') ?>
</div>

<div class="form-item">
<label for="region/province"><?php echo __('Region/Province') ?></label>
<?php if (strlen($sourceCultureValue = $contactInformation->getRegion(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $contactInformation->getSourceCulture()): ?>
    <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
    <?php endif; ?>
<?php echo object_input_tag($contactInformation, 'getRegion') ?>
</div>

<div class="form-item">
<label for="country"><?php echo __('Country') ?></label>
<?php echo object_select_country_tag($contactInformation, 'getCountryCode', array('include_blank' => true)) ?>
</div>

<div class="form-item">
<label for="postal code"><?php echo __('Postal Code') ?></label>
<?php echo object_input_tag($contactInformation, 'getPostalCode') ?>
</div>

<div class="form-item">
<label for="latitude"><?php echo __('Latitude') ?></label>
<?php echo object_input_tag($contactInformation, 'getLatitude', array (
  'size' => 20,
)) ?>
</div>

<div class="form-item">
<label for="longtitude"><?php echo __('Longtitude') ?></label>
<?php echo object_input_tag($contactInformation, 'getLongtitude', array (
  'size' => 20,
)) ?>
</div>

<div class="form-item">
<label for="telephone"><?php echo __('Telephone') ?></label>
<?php echo object_input_tag($contactInformation, 'getTelephone') ?>
</div>

<div class="form-item">
<label for="fax"> <?php echo __('Fax') ?></label>
<?php echo object_input_tag($contactInformation, 'getFax') ?>
</div>

<div class="form-item">
<label for="email"><?php echo __('Email') ?></label>
<?php echo object_input_tag($contactInformation, 'getEmail') ?>
</div>

<div class="form-item">
<label for="website"><?php echo __('Website') ?></label>
<?php echo object_input_tag($contactInformation, 'getWebsite') ?>
</div>

<div class="form-item">
<label for="contact person"><?php echo __('Contact Person') ?></label>
<?php echo object_input_tag($contactInformation, 'getContactPerson') ?>
</div>

<div class="form-item">
<label for="primary contact"><?php echo __('Primary contact?') ?></label>
<?php echo object_checkbox_tag($contactInformation, 'getPrimaryContact', array('style' => 'border: 0; width: 20px;')) ?>
</div>

<div class="form-item">
<label for="contact type"><?php echo __('Contact type') ?> </label>
<?php if (strlen($sourceCultureValue = $contactInformation->getContactType(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $contactInformation->getSourceCulture()): ?>
    <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
    <?php endif; ?>
<?php echo object_input_tag($contactInformation, 'getContactType') ?>
</div>

<div class="form-item">
<label for="note"><?php echo __('Note') ?></label>
<?php if (strlen($sourceCultureValue = $contactInformation->getNote(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $contactInformation->getSourceCulture()): ?>
    <div class="default-translation"><?php echo nl2br($sourceCultureValue) ?></div>
    <?php endif; ?>
<?php echo object_textarea_tag($contactInformation, 'getNote', array('class' => 'resizable', 'size' => '30x3'))?>
</div>



<!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
<div id="button-block-bump"></div>

<div id="button-block" style="height: 4em;">

<div class="menu-action">
<?php if ($contactInformation->getId()): ?>
    &nbsp;
    <?php if ($repositoryReroute)
      {
      echo link_to(__('delete'), 'actor/deleteContactInformation?contactInformationId='.$contactInformation->getId().'&returnTemplate=isdiah&repositoryReroute='.$repositoryReroute, 'post=true&confirm='.__('are you sure?'));
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
      <?php echo submit_tag(__('save')) ?>
    <?php else: ?>
      <?php echo submit_tag(__('create')) ?>
    <?php endif; ?>

</div>
</div>
</form>
