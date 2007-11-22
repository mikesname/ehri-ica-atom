<div class="pageTitle">view archival institution</div>

<table class="detail">
<tbody>

<?php if ($editCredentials)
    {
    echo '<tr><td colspan="2" class="headerCell">'.link_to($repository, 'repository/edit/?id='.$repository->getId()).'</b></td></tr>' ;
    }
  else
    {
    echo '<tr><td colspan="2" class="headerCell">'.$repository.'</b></td></tr>' ;
    }
?>

<?php if ($repository->getIdentifier()) { echo
'<tr><th>Identifier: </th>
<td>'.$repository->getIdentifier().'</td></tr>' ;} ?>

<tr><th>Authorized Form of Name:</th><td><?php echo $repository ?></td></th>

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
    echo '<br />';
    }
  echo '</td></tr>';
  }
  ?>

<?php if ($repository->getRepositoryTypeId())
    {
    echo '<tr><th>Type:</th><td>'.$repository->getTermRelatedByRepositoryTypeId().'</td></tr>';
    }
 ?>


<?php if ($contactInformation)
    {
    echo '<tr><th>Contact Info:</th><td>';
      foreach ($contactInformation as $contact)
      {
      echo '<table class="inline" style="margin-bottom: 15px;"><tr><td style="border-top: 2px solid #cccccc; border-bottom: 1px solid #cccccc;">'.$contact->getContactType() ;
      echo ($contact->getPrimaryContact()) ? ' (primary contact)' : '';
      echo '</td></tr></table>';
      echo '<div style="padding-left: 10px; margin-bottom: 10px;">';
      echo $contact->getContactInformationString();
      echo ($contact->getNote()) ? '<p><span class="note">--'.$contact->getNote().'</span>' : '';
      echo '</div>';
      }
    echo '</td></tr>';
    }
?>

<?php if ($repository->getOfficersInCharge())
  {
  echo '<tr><th>Officers in charge:</th><td>'.nl2br($repository->getOfficersInCharge()).'</td></tr>' ;
  }
?>


<?php if ($repository->getGeoculturalContext())
  {
  echo '<th>Geographical and cultural context:</th><td>'.nl2br($repository->getGeoculturalContext()).'</td></tr>';
  }
?>

<?php if ($history)
  {
  echo '<tr><th>History:</th><td>'.$history.'</td></tr>';
  }
?>

<?php if ($structure)
  {
  echo '<tr><th>Structure:</th><td>'.$structure.'</td></tr>';
  }
?>

<?php if ($repository->getCollectingPolicies())
  {
  echo '<tr><th>Collecting policies:</th><td>'.nl2br($repository->getCollectingPolicies()).'</td></tr>';
  }
?>

<?php if ($repository->getBuildings())
  {
  echo '<tr><th>Building(s):</th><td>'.nl2br($repository->getBuildings()).'</td></tr>';
  }
?>

<?php if ($repository->getHoldings())
  {
  echo '<tr><th>Archival and other holdings:</th><td>'.nl2br($repository->getHoldings()).'</td></tr>';
  }
?>

<?php if ($repository->getFindingAids())
  {
  echo '<tr><th>Finding aids and publications:</th><td>'.nl2br($repository->getFindingAids()).'</td></tr>';
  }
?>

<?php if ($repository->getOpeningTimes())
  {
  echo '<tr><th>Opening times:</th><td>'.nl2br($repository->getOpeningTimes()).'</td></tr>';
  }
?>

<?php if ($repository->getAccessConditions())
  {
  echo '<tr><th>Conditions and requirements:</th><td>'.nl2br($repository->getAccessConditions()).'</td></tr>';
  }
?>

<?php if ($repository->getDisabledAccess())
  {
  echo '<tr><th>Disabled access:</th><td>'.nl2br($repository->getDisabledAccess()).'</td></tr>';
  }
?>

<?php if ($repository->getTransport())
  {
  echo '<tr><th>Transport:</th><td>'.nl2br($repository->getTransport()).'</td></tr>';
  }
?>


<?php if ($repository->getResearchServices())
  {
  echo '<tr><th>Research services:</th><td>'.nl2br($repository->getResearchServices()).'</td></tr>';
  }
?>

<?php if ($repository->getReproductionServices())
  {
  echo '<tr><th>Reproduction services:</th><td>'.nl2br($repository->getReproductionServices()).'</td></tr>';
  }
?>

<?php if ($repository->getPublicFacilities())
  {
  echo '<tr><th>Public facilities:</th><td>'.nl2br($repository->getPublicFacilities()).'</td></tr>';
  }
?>


<?php if ($repository->getDescriptionIdentifier())
  {
  echo '<tr><th>Description identifier:</th><td>'.nl2br($repository->getDescriptionIdentifier()).'</td></tr>';
  }
?>

<?php if ($repository->getInstitutionIdentifier())
  {
  echo '<tr><th>Institution identifier:</th><td>'.nl2br($repository->getInstitutionIdentifier()).'</td></tr>';
  }
?>

<?php if ($repository->getRules())
  {
  echo '<tr><th>Rules or conventions:</th><td>'.nl2br($repository->getRules()).'</td></tr>';
  }
?>

<?php if ($repository->getStatusId())
  {
  echo '<tr><th>Status:</th><td>'.nl2br($repository->getTermRelatedByStatusId()).'</td></tr>';
  }
?>

<?php if ($repository->getLevelOfDetailId())
  {
  echo '<tr><th>Level of detail:</th><td>'.nl2br($repository->getTermRelatedByLevelOfDetailId()).'</td></tr>';
  }
?>

<?php if ($languages)
  {
  echo '<tr><th>Language(s) of Institution Description:</th><td>';
  foreach ($languages as $language)
    {
    echo $language['termName'].'<br />';
    }
  echo '<td></tr>';
  }
?>

<?php if ($scripts)
  {
  echo '<tr><th>Script(s) of Institution Description:</th><td>';
  foreach ($scripts as $script)
    {
    echo $script['termName'].'<br />';
    }
  echo '<td></tr>';
  }
?>

<?php if ($repository->getSources())
  {
  echo '<tr><th>Sources:</th><td>'.nl2br($repository->getSources()).'</td></tr>';
  }
?>

<?php if ($notes)
  {
  echo '<tr><th>Notes:</th><td>';
  foreach ($notes as $note)
    {
    echo $note['noteType'].': '.$note['note'].'<br /><span class="note">-- '.$note['noteAuthor'].', '.$note['updated'].'</span><p>';
    }
  echo '</td></tr>';
  }
?>

</tbody>
</table>



<div class="menu-action">
<?php if ($editCredentials) { echo link_to(__('edit'), 'repository/edit?id='.$repository->getId()); } ?>
</div>