<div class="pageTitle"><?php echo __('view').' '.__('authority file') ?></div>

<table class="detail">
<tbody>


<?php if($actor->getAuthorizedFormOfName())
  {
    if($editCredentials)
      {
      echo '<tr><td colspan="2" class="headerCell">'.link_to($actor->getAuthorizedFormOfName(), 'actor/edit?id='.$actor->getId()).'</td></tr>' ;
      }
    else
      {
      echo '<tr><td colspan="2" class="headerCell">'.$actor->getAuthorizedFormOfName().'</b></td></tr>' ;
      }
   } ?>

<?php if($actor->getTypeOfEntityId())
  {
  echo '<tr><th>Type of entity: </th><td>';
  echo $actor->getTypeOfEntity();
  echo '</td></tr>';
  }
?>

<?php if($otherNames)
  {
  echo '<tr><th>Other Names:</th><td>';
  foreach($otherNames as $otherName)
    {
    echo $otherName['name'].' ('.$otherName['nameType'].')';
    if($otherName['note'])
      {
      echo '<span class="note">--'.$otherName['note'].'</span>';
      }
    echo '<br />';
    }
  echo '</td></tr>';
  }
  ?>

<?php if($actor->getIdentifiers())
  { echo '<tr><th>Identifiers for corporate bodies: </th><td>'.$actor->getIdentifiers().'</td></tr>' ;
  }
?>

<?php if($datesOfExistence)
  {
  echo '<tr><th>Dates of existence: </th><td>'.$datesOfExistence.'</td></tr>';
  }
?>

<?php if($actor->getHistory()) { echo
'<tr><th>History: </th>
<td>'.nl2br($actor->getHistory()).'</td></tr>' ;} ?>

<?php if($places)
  {
  echo '<tr><th>Places: </th><td>'.$places.'</td></tr>';
  }
?>

<?php if($actor->getLegalStatus()) { echo
'<tr><th>Legal status: </th>
<td>'.$actor->getLegalStatus().'</td></tr>' ;} ?>

<?php if($actor->getFunctions()) { echo
'<tr><th>Functions occupations activities: </th>
<td>'.$actor->getFunctions().'</td></tr>' ;} ?>

<?php if($actor->getMandates()) { echo
'<tr><th>Mandates or sources of authority: </th>
<td>'.$actor->getMandates().'</td></tr>' ;} ?>

<?php if($actor->getInternalStructures()) { echo
'<tr><th>Internal structures or genealogy: </th>
<td>'.$actor->getInternalStructures().'</td></tr>' ;} ?>

<?php if($actor->getGeneralContext()) { echo
'<tr><th>General context: </th>
<td>'.$actor->getGeneralContext().'</td></tr>' ;} ?>

<?php if($relatedActors)
  {
  echo '<tr><th>Related corporate bodies persons families: </th><td>'.$relatedActors.'</td></tr>';
  }
?>

<?php if($actor->getAuthorityRecordIdentifier()) { echo
'<tr><th>Authority record identifier: </th>
<td>'.$actor->getAuthorityRecordIdentifier().'</td></tr>' ;} ?>

<?php if($actor->getInstitutionIdentifier()) { echo
'<tr><th>Institution identifier: </th>
<td>'.$actor->getInstitutionIdentifier().'</td></tr>' ;} ?>

<?php if($actor->getRules()) { echo
'<tr><th>Rules or conventions: </th>
<td>'.$actor->getRules().'</td></tr>' ;} ?>

<?php if($actor->getStatus()) { echo
'<tr><th>Status: </th>
<td>'.$actor->getStatus().'</td></tr>' ;} ?>

<?php if($actor->getLevelOfDetail()) { echo
'<tr><th>Level of detail: </th>
<td>'.$actor->getLevelOfDetail().'</td></tr>' ;} ?>

<?php if($datesOfChanges)
  {
  echo '<tr><th>Dates of creation revision deletion: </th><td>'.$datesOfChanges.'</td></tr>';
  }
?>

<?php if($languages)
  {
  echo '<tr><th>Language of authority record: </th><td>';
  foreach($languages as $language)
    {
    echo $language['termName'];
    echo '<br />';
    }
  echo '</td></tr>' ;
  }
?>

<?php if($scripts)
  {
  echo '<tr><th>Script of authority record: </th><td>';
  foreach($scripts as $script)
    {
    echo $script['termName'];
    echo '<br />';
    }
  echo '</td></tr>' ;
  }
?>

<?php if($actor->getSources()) { echo
'<tr><th>Sources: </th>
<td>'.$actor->getSources().'</td></tr>' ;} ?>

<?php if($notes)
  {
  echo '<tr><th>Notes: </th><td>';
  foreach($notes as $note)
    {
    echo $note['noteType'].': '.$note['note'].'<br />';
    }
  echo '</td></tr>';
  }
?>

</tbody>
</table>


<?php if($editCredentials): ?>
  <div class="menu-action">
  <?php echo link_to(__('edit'), 'actor/edit?id='.$actor->getId()) ?>
  </div>
<?php endif; ?>
