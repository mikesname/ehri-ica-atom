  <?php if ($sf_request->hasError('actor_id')) echo '<div class="form_error">'.$sf_request->getError('actor_id').'</div><br />'; ?>

<div class="pageTitle">edit Repository</div>

<?php echo form_tag('repository/update', 'class=mainForm name=mainForm') ?>
<?php echo input_hidden_tag('template', 'isiah') ?>
<?php echo object_input_hidden_tag($repository, 'getId') ?>


<table class="detail">
<tbody>


<?php if ($repository->getActorId()) echo '<tr><td colspan="2" class="headerCell">'.link_to($repository,'/repository/show?id='.$repository->getId()).'</b></td></tr>' ; ?>

<tr><td class="subHeaderCell" colspan="2">Identity Area</td></tr>


<tr><th>Id: </th>
<td><?php echo $repository->getId() ?></td></tr>

<tr><th>Identifier:</th>
  <td><?php echo object_input_tag($repository, 'getIdentifier', array (
  'size' => 20,
)) ?></td></tr>

<tr><th>Authorized Form of Name:</th>
<td>
  <?php if ($sf_request->hasError('actor_id'))
  {
  echo '<div class="form_error">'.$sf_request->getError('actor_id').'</div><br />';
  } ?>

  <?php if ($repository->getActorId())
    {
    echo link_to($repository->getActor(), 'actor/edit?id='.$repository->getActorId().'&repositoryReroute='.$repository->getId());

    echo input_hidden_tag('actor_id', $repository->getActorId());
    }
    else
    {
    echo '<table class="inline"><tr><td class="headerCell" style="width:40%;">existing name</td><td class="headerCell" style="width:55%;"><i>or</i> add new name</td><td class="headerCell" style="width:5%;"></td></tr><tr><td>'.object_select_tag($repository, 'getActorId', array (
    'related_class' => 'Actor',
    'include_blank' => true,
    'peer_method' => 'getActors')).'</td><td>'.input_tag('NewActorAuthorizedName').'</td><td>'.submit_image_tag('add', 'class=submitAdd').'</td></tr></table>';
    }
    ?>
  </td></tr>

<?php if ($otherNames)
  {
  echo '<tr><th>Other Names:</th><td>';
  foreach ($otherNames as $otherName)
    {
    echo $otherName['name'].' ('.$otherName['nameType'].')';
    if ($otherName['note'])
      {
      echo '<span class="note">--'.$otherName['note'].'</span>';
      }
    echo '   '.link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$repository->getActorId());
    echo '<br />';
    }
  echo '</td></tr>';
  }
  ?>

<tr><th>Type:</th>
    <td><?php echo object_select_tag($repository, 'getRepositoryTypeId', array (
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getRepositoryTypes'
)) ?></td>

<tr><td class="subHeaderCell" colspan="2">Contact Area</td></tr>

<tr><th>Contact Info:</th><td>
  <?php if ($contactInformation)
    {
      foreach ($contactInformation as $contact)
      {
      echo '<table class="inline" style="margin-bottom: 15px;"><tr><td style="border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">'.$contact->getContactType() ;
      echo ($contact->getPrimaryContact()) ? ' (primary contact)' : '';
      echo '</td><td style="width:20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">'.link_to(image_tag('pencil', 'align=top'), 'actor/editContactInformation?id='.$contact->getId().'&repositoryReroute='.$repository->getId()).'</td>';
      echo '<td style="width:20px; border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">'.link_to(image_tag('delete', 'align=top'), 'actor/deleteContactInformation?contactInformationId='.$contact->getId().'&returnTemplate=isiah&repositoryReroute='.$repository->getId()).'</td></tr></table>';
      echo '<div style="padding-left: 10px; margin-bottom: 10px;">';
      echo $contact->getContactInformationString();
      echo ($contact->getNote()) ? '<p><span class="note">--'.$contact->getNote().'</span>' : '';
      echo '</div>';
      }
    echo '<table class="inline">';
    echo '<tr><td class="headerCell" colspan="4" style="margin-top: 5px; border-top: 2px solid #999999; width:95%">new contact information</td><td align="right" style="border-top: 2px solid #999999;">'.submit_image_tag('add', 'class=submitAdd').'</tr></table>';
    } ?>

  <?php
      echo '<table class="inline"><tr><td class="headerCell">Contact type:</td><td>'.object_input_tag($newContactInformation, 'getContactType', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Primary contact?</td><td>'.object_checkbox_tag($newContactInformation, 'getPrimaryContact', array('style' => 'border: 0;')).'</td></tr>';
      echo '<tr><td class="headerCell">Street address:</td><td>'.object_textarea_tag($newContactInformation, 'getStreetAddress', array ('size' => '30x3')).'</td></tr>';
      echo '<tr><td class="headerCell">City:</td><td>'.object_input_tag($newContactInformation, 'getCity', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Region/Province:</td><td>'.object_input_tag($newContactInformation, 'getRegion', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Country:</td><td>'.object_select_tag($newContactInformation, 'getCountryId', array ('related_class' => 'Term', 'include_blank' => true, 'peer_method' => 'getCountries')).'</td></tr>';
      echo '<tr><td class="headerCell">Postal Code:</td><td>'.object_input_tag($newContactInformation, 'getPostalCode', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Telephone:</td><td>'.object_input_tag($newContactInformation, 'getTelephone', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Fax:</td><td>'.object_input_tag($newContactInformation, 'getFax', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Email:</td><td>'.object_input_tag($newContactInformation, 'getEmail', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Website:</td><td>'.object_input_tag($newContactInformation, 'getWebsite', array ('size' => 20,)).'</td></tr>';
      echo '<tr><td class="headerCell">Note:</td><td>'.input_tag('contactInformationNote').'</td></tr>';
      echo '</table>';
      ?>

</td></tr>

<tr><th>Officers in charge:</th>
  <td><?php echo object_input_tag($repository, 'getOfficersInCharge', array (
  'size' => 20,
)) ?></td>
</tr>

<tr><td class="subHeaderCell" colspan="2">Description Area</td></tr>

<th>Geographical and cultural context:</th>
  <td><?php echo object_textarea_tag($repository, 'getGeoculturalContext', array (
  'size' => '30x3',
)) ?></td>

<?php if ($history)
  {
  echo '<tr><th>History:</th><td><table class="inline" style="width:98%;"><tr><td style="width:95%; border:0;">'.nl2br($history).'</td><td style="border:0;">'.link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$repository->getActorId().'&repositoryReroute='.$repository->getId()).'</td></tr></table></td></tr>';
  } ?>

<?php if ($structure)
  {
  echo '<tr><th>Structure:</th><td><table class="inline" style="width:98%;"><tr><td style="width:95%; border:0;">'.nl2br($structure).'</td><td style="border:0;">'.link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$repository->getActorId().'&repositoryReroute='.$repository->getId()).'</td></tr></table></td></tr>';
  } ?>

<tr><th>Collecting policies:</th>
  <td><?php echo object_textarea_tag($repository, 'getCollectingPolicies', array (
  'size' => '30x3',
)) ?></td></tr>

<tr><th>Building(s):</th>
  <td><?php echo object_input_tag($repository, 'getBuildings', array (
  'size' => 20,
)) ?></td></tr>

<tr><th>Archival and other holdings:</th>
  <td><?php echo object_textarea_tag($repository, 'getHoldings', array (
  'size' => '30x3',
)) ?></td></tr>

<tr><th>Finding aids and publications:</th>
  <td><?php echo object_textarea_tag($repository, 'getFindingAids', array (
  'size' => '30x3',
)) ?></td></tr>

<tr><td class="subHeaderCell" colspan="2">Access Area</td></tr>

<tr><th>Opening times:</th>
  <td><?php echo object_textarea_tag($repository, 'getOpeningTimes', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><th>Conditions and requirements:</th>
  <td><?php echo object_textarea_tag($repository, 'getAccessConditions', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><th>Disabled access:</th>
  <td><?php echo object_textarea_tag($repository, 'getDisabledAccess', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><th>Transport:</th>
  <td><?php echo object_textarea_tag($repository, 'getTransport', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><td class="subHeaderCell" colspan="2">Services Area</td></tr>

<tr><th>Research services:</th>
  <td><?php echo object_textarea_tag($repository, 'getResearchServices', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><th>Reproduction services:</th>
  <td><?php echo object_textarea_tag($repository, 'getReproductionServices', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><th>Public facilities:</th>
  <td><?php echo object_textarea_tag($repository, 'getPublicFacilities', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><td class="subHeaderCell" colspan="2">Control Area</td></tr>

<tr>
  <th>Description identifier:</th>
  <td><?php echo object_input_tag($repository, 'getDescriptionIdentifier', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th>Institution identifier:</th>
  <td><?php echo object_input_tag($repository, 'getInstitutionIdentifier', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th>Rules or conventions:</th>
  <td><?php echo object_textarea_tag($repository, 'getRules', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>
  <th>Status:</th>
  <td><?php echo object_select_tag($repository, 'getStatusId', array (
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getAuthorityFileStatus'
)) ?></td>
</tr>

<tr>
  <th>Level of detail:</th>
  <td><?php echo object_select_tag($repository, 'getLevelOfDetailId', array (
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getAuthorityFileDetail'
)) ?></td>
</tr>

<tr>
  <th>Dates of creation, revision, deletion:</th>
  <td></td>
</tr>

<tr><th>Language(s) of Institution Description:</th>

<td style="font: normal 12px/12px Verdana, Arial, Sans-Serif;">


<?php foreach ($languages as $language): ?>
  <?php echo $language['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'repository/deleteTermRelationship?TermRelationshipId='.$language['relationshipId'].'&ReturnTemplate=isiah') ?><br />
<?php endforeach; ?>

<?php echo object_select_tag($newLanguage, 'getTermId', array (
  'name' => 'language_id',
  'id' => 'language_id',
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getLanguages')) ?>
</td></tr>

<tr><th>Script(s) of Institution Description:</th>
<td style="font: normal 12px/12px Verdana, Arial, Sans-Serif;">
<?php foreach ($scripts as $script): ?>
  <?php echo $script['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'repository/deleteTermRelationship?TermRelationshipId='.$script['relationshipId'].'&ReturnTemplate=isiah') ?><br />
<?php endforeach; ?>


<?php echo object_select_tag($newScript, 'getTermId', array (
  'name' => 'script_id',
  'id' => 'script_id',
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getScripts')) ?>
</td></tr>


<tr>
  <th>Sources:</th>
  <td><?php echo object_textarea_tag($repository, 'getSources', array (
  'size' => '30x3',
)) ?></td>
</tr>


<tr><th>Notes:</th><td>
<table class="inline">
<tr>
<td class="headerCell" style="width:65%;">note</td>
<td class="headerCell" style="width:30%">note type</td>
<td class="headerCell" style="width:5%;"></td>
</tr>

<?php foreach ($notes as $note)
    {
    echo '<tr><td>'.$note['note'].'<br /><span class="note">-- '.$note['noteAuthor'].', '.$note['updated'].'</span></td><td>'.$note['noteType'].'</td><td style="text-align: center;">'.link_to(image_tag('delete', 'align=top'), 'actor/deleteNote?noteId='.$note['noteId'].'&ReturnTemplate=isiah').'</td></tr>';
    } ?>

<tr valign="top">


<td>
<?php echo object_textarea_tag($newNote, 'getNote', array (
'size' => '10x1',)) ?></td>

<td >
<?php echo object_select_tag($newNote, 'getNoteTypeId', array (
  'name' => 'note_type_id',
  'id' => 'note_type_id',
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getNoteTypes',
  'style' => 'width: 120px;')) ?>
</td>

<td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>


</tr></table>

</td></tr>





<?php if ($repository->getCreatedAt()): ?>
<tr><th>Created at: </th>
<td><?php echo $repository->getCreatedAt() ?></td></tr>
<tr><th>Updated at: </th>
<td><?php echo $repository->getUpdatedAt() ?></td></tr>
<?php endif; ?>

</tbody>
</table>

<div class="menu-action">
<?php if ($repository->getId()): ?>
  &nbsp;<?php echo link_to(__('delete'), 'repository/delete?id='.$repository->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  &nbsp;<?php echo link_to(__('cancel'), 'repository/show?id='.$repository->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('cancel'), 'repository/list') ?>
<?php endif; ?>
<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
</div>
</form>

<div class="menu-extra">
	<?php echo link_to(__('list').' '.__('all').' '.__('repositories'), 'repository/list'); ?>
</div>
