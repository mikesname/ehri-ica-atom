<div class="pageTitle">edit Authority File</div>

<?php echo form_tag('actor/update') ?>

<?php echo input_hidden_tag('template', 'isaar') ?>

<?php if ($repositoryReroute)
  {
  echo input_hidden_tag('repositoryReroute', $repositoryReroute);
  }
  ?>

<?php echo object_input_hidden_tag($actor, 'getId') ?>

<table class="detail">
<tbody>

<?php if ($actor->getAuthorizedFormOfName())
  {
  echo '<tr><td colspan="2" class="headerCell">'.link_to($actor->getAuthorizedFormOfName(),'actor/show?id='.$actor->getId()).'</td></tr>' ;
  }
?>

<tr><td class="subHeaderCell" colspan="2">Identity Area</td></tr>


<tr><th>Id: </th>
<td><?php echo $actor->getId() ?></td></tr>

<tr>
  <th>Authorized form of name:</th>
  <td><?php echo object_input_tag($actor, 'getAuthorizedFormOfName', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th>Type of entity:</th>
  <td><?php echo object_select_tag($actor, 'getTypeOfEntityId', array (
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getAuthorityFileEntityTypes'
)) ?></td>
</tr>

<tr><th>Other Names:</th><td>
<table class="inline"><tr>
<td class="headerCell" style="width:40%;">name</td>
<td class="headerCell" style="width:20%;">type</td>
<td class="headerCell" style="width:35%;">note</td>
<td class="headerCell" style="width:5%;"></td>
</tr>

<?php foreach ($otherNames as $otherName): ?>
    <?php echo '<tr><td>'.$otherName['name'].'</td><td>'.$otherName['nameType'].'</td><td>'.$otherName['note'].'</td><td style="text-align: center;">'.link_to(image_tag('delete', 'align=top'), 'actor/deleteOtherName?otherNameId='.$otherName['id'].'&ReturnTemplate=isaar').'</td></tr>' ?>
 <?php endforeach; ?>

<tr><td>
<?php echo object_input_tag($newName, 'getName', array (
  'size' => 10,
)) ?></td>
<td>
<?php echo object_select_tag($newName, 'getNameTypeId', array (
  'name' => 'name_type_id',
  'id' => 'name_type_id',
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getActorNameTypes',
  'style' => 'width: 95px;')) ?>
</td>
<td>
<?php echo object_input_tag($newName, 'getNameNote', array (
  'size' => 10,
)) ?></td>
<td style="text-align: center;"><?php echo submit_image_tag('add', 'class=submitAdd') ?></td>
</tr></table>
</td></tr>


<tr>
  <th>Identifiers for corporate bodies:</th>
  <td><?php echo object_input_tag($actor, 'getIdentifiers', array (
  'size' => 20,
)) ?></td>
</tr>

<tr><td class="subHeaderCell" colspan="2">Description Area</td></tr>

<tr>
  <th>Dates of existence:</th>
  <td></td>
</tr>

<tr>
  <th>History:</th>
  <td><?php echo object_textarea_tag($actor, 'getHistory', array (
  'size' => '30x10',
)) ?></td>
</tr>

<tr>
  <th>Places:</th>
  <td></td>
</tr>

<tr>
  <th>Legal status:</th>
  <td><?php echo object_textarea_tag($actor, 'getLegalStatus', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>
  <th>Functions occupations activities:</th>
  <td><?php echo object_textarea_tag($actor, 'getFunctions', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>
  <th>Mandates or sources of authority:</th>
  <td><?php echo object_textarea_tag($actor, 'getMandates', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>
  <th>Internal structures or genealogy:</th>
  <td><?php echo object_textarea_tag($actor, 'getInternalStructures', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>
  <th>General context:</th>
  <td><?php echo object_textarea_tag($actor, 'getGeneralContext', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr><td class="subHeaderCell" colspan="2">Relationship Area</td></tr>
<tr><th>Relationships:</th><td></td></tr>

<tr><td class="subHeaderCell" colspan="2">Control Area</td></tr>

<tr>
  <th>Authority record identifier:</th>
  <td><?php echo object_input_tag($actor, 'getAuthorityRecordIdentifier', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th>Institution identifier:</th>
  <td><?php echo object_input_tag($actor, 'getInstitutionIdentifier', array (
  'size' => 20,
)) ?></td>
</tr>

<tr>
  <th>Rules or conventions:</th>
  <td><?php echo object_textarea_tag($actor, 'getRules', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>
  <th>Status:</th>
  <td><?php echo object_select_tag($actor, 'getStatusId', array (
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getAuthorityFileStatus'
)) ?></td>
</tr>

<tr>
  <th>Level of detail:</th>
  <td><?php echo object_select_tag($actor, 'getLevelOfDetailId', array (
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getAuthorityFileDetail'
)) ?></td>
</tr>

<tr>
  <th>Dates of creation, revision, deletion:</th>
  <td></td>
</tr>

<tr><th>Language(s) of authority record:</th>

<td style="font: normal 12px/12px Verdana, Arial, Sans-Serif;">


<?php foreach ($languages as $language): ?>
  <?php echo $language['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteTermRelationship?TermRelationshipId='.$language['relationshipId'].'&ReturnTemplate=isaar') ?><br />
<?php endforeach; ?>

<?php echo object_select_tag($newLanguage, 'getTermId', array (
  'name' => 'language_id',
  'id' => 'language_id',
  'related_class' => 'Term',
  'include_blank' => true,
  'peer_method' => 'getLanguages')) ?>
</td></tr>

<tr><th>Script(s) of authority record:</th>
<td style="font: normal 12px/12px Verdana, Arial, Sans-Serif;">
<?php foreach ($scripts as $script): ?>
  <?php echo $script['termName'] ?>&nbsp;<?php echo link_to(image_tag('delete', 'align=top'), 'actor/deleteTermRelationship?TermRelationshipId='.$script['relationshipId'].'&ReturnTemplate=isaar') ?><br />
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
  <td><?php echo object_textarea_tag($actor, 'getSources', array (
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
    echo '<tr><td>'.$note['note'].'<br /><span class="note">-- '.$note['noteAuthor'].', '.$note['updated'].'</span></td><td>'.$note['noteType'].'</td><td style="text-align: center;">'.link_to(image_tag('delete', 'align=top'), 'actor/deleteNote?noteId='.$note['noteId'].'&ReturnTemplate=isaar').'</td></tr>';
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


</tbody>
</table>


<div class="menu-action">
<?php if ($actor->getId()): ?>
  &nbsp;<?php echo link_to(__('delete'), 'actor/delete?id='.$actor->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  &nbsp;<?php echo link_to(__('cancel'), 'actor/show?id='.$actor->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to(__('cancel'), 'actor/create') ?>
<?php endif; ?>
<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
</div>
</form>

<div class="menu-extra">
	<?php echo link_to(__('list').' '.__('all').' '.__('authority files'), 'actor/list&template=isaar'); ?>
</div>
