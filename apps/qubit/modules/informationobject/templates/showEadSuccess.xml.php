<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE ead PUBLIC "+//ISBN 1-931666-00-8//DTD ead.dtd (Encoded Archival Description (EAD) Version 2002)//EN" "http://lcweb2.loc.gov/xmlcommon/dtds/ead2002/ead.dtd">

<ead>

<eadheader langencoding="iso639-2b" countryencoding="iso3166-1" dateencoding="iso8601" repositoryencoding="iso15511" scriptencoding="iso15924" relatedencoding="DC">

<eadid countrycode="<?php if ($informationObject->getRepository()): ?><?php if(0 < strlen($country = $informationObject->getRepository()->getCountryCode())): ?><?php echo $country ?><?php endif; ?><?php endif; ?>" mainagencycode="<?php if ($informationObject->getRepository()): ?><?php if (0 < strlen($country)): ?><?php echo $country.'-' ?><?php endif; ?><?php if (0 < strlen($agency =  $informationObject->getRepository()->getIdentifier())): ?><?php echo $agency ?><?php endif; ?><?php endif; ?>" url="<?php echo url_for(array('module' => 'informationobject', 'action' => 'show', 'id' =>$informationObject->getId(), 'sf_format' => 'xml'), $absolute = true) ?>" encodinganalog="Identifier"><?php echo $informationObject->getId() ?></eadid>

<filedesc>
  <titlestmt>
    <?php if (0 < strlen($value = $informationObject->getTitle(array('cultureFallback' => true)))): ?>
    <titleproper encodinganalog="Title"><?php echo htmlspecialchars($value) ?></titleproper><?php endif; ?>
    <?php if (0 < count($archivistsNotes = $informationObject->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID)))): ?><?php foreach ($archivistsNotes as $note): ?><author encodinganalog="Creator"><?php echo htmlspecialchars(nl2br($note)) ?></author><?php endforeach; ?><?php endif; ?>
  </titlestmt>
  <?php if (0 < strlen($value = $informationObject->getEdition(array('cultureFallback' => true)))): ?>
  <editionstmt>
    <edition><?php echo htmlspecialchars($value) ?></edition>
  </editionstmt>
  <?php endif; ?>
  <?php if ($value = $informationObject->getRepository()): ?>
  <publicationstmt>
    <publisher encodinganalog="Publisher"><?php echo htmlspecialchars($value->__toString()) ?></publisher>
    <?php if ($address = $value->getPrimaryContact()): ?> 
    <address>
      <?php if (0 < strlen($addressline = $address->getStreetAddress())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getCity())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getRegion())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $informationObject->getRepositoryCountry())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getPostalCode())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getTelephone())): ?>      
      <addressline><?php echo __('telephone: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getFax())): ?>      
      <addressline><?php echo __('fax: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getEmail())): ?>      
      <addressline><?php echo __('email: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getWebsite())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
    </address><?php endif; ?>
    <date normal="<?php echo $publicationDate ?>" encodinganalog="Date"><?php echo htmlspecialchars($publicationDate) ?></date>
  </publicationstmt><?php endif; ?>
</filedesc>

<profiledesc>
  <creation><?php echo __('Generated by ') ?><?php echo sfConfig::get('app_version') ?>
    <date normal="<?php echo gmdate('o-m-d') ?>"><?php echo gmdate('o-m-d H:s:e') ?></date>
  </creation>
  <langusage>
    <?php if ($exportLanguage != $sourceLanguage): ?>
    <language langcode="<?php echo ($iso6392 = $iso639convertor->getID3($exportLanguage)) ? strtolower($iso6392) : $exportLanguage ?>" encodinganalog="Language"><?php echo format_language($exportLanguage) ?></language><?php endif; ?>
    <language langcode="<?php echo ($iso6392 = $iso639convertor->getID3($sourceLanguage)) ? strtolower($iso6392) : $sourceLanguage ?>" encodinganalog="Language"><?php echo format_language($sourceLanguage) ?></language>
  </langusage>
  <?php if (0 < strlen($rules = $informationObject->getRules(array('cultureFallback' => true)))): ?>
  <descrules encodinganalog="3.7.2"><?php echo htmlspecialchars($rules) ?></descrules>
  <?php endif; ?>
</profiledesc>
</eadheader>

<frontmatter></frontmatter>

<archdesc <?php if ($informationObject->levelOfDescriptionId):?>level="<?php if (in_array(strtolower($levelOfDescription = $informationObject->getLevelOfDescription()->getName(array('culture' => 'en'))), $eadLevels)): ?><?php echo strtolower($levelOfDescription).'"' ?><?php else: ?><?php echo 'otherlevel" otherlevel="'.$levelOfDescription.'"' ?><?php endif; ?><?php endif; ?> relatedencoding="ISAD(G)v2">
  <did>
  <?php if (0 < strlen($value = $informationObject->getTitle(array('cultureFallback' => true)))): ?>
  <unittitle encodinganalog="3.1.2"><?php echo htmlspecialchars($value) ?></unittitle><?php endif; ?>
  <?php if (0 < strlen($informationObject->getIdentifier())): ?><unitid <?php if ($informationObject->getRepository()): ?><?php if ($repocode = $informationObject->getRepository()->getIdentifier()): ?><?php echo 'repositorycode="'.htmlspecialchars($repocode).'" ' ?><?php endif; ?><?php if ($countrycode = $informationObject->getRepository()->getCountryCode()): ?><?php echo 'countrycode="'.$countrycode.'"' ?><?php endif;?><?php endif; ?> encodinganalog="3.1.1"><?php echo htmlspecialchars(QubitIsad::getReferenceCode($informationObject)) ?></unitid><?php endif; ?>
  <?php foreach ($informationObject->getDates() as $date): ?> 
  <unitdate <?php if ($type = $date->getType()->__toString()): ?><?php echo 'datechar="'.strtolower($type).'" ' ?><?php endif; ?><?php if ($startdate = $date->getStartDate()): ?><?php echo 'normal="'?><?php echo collapse_date($startdate) ?><?php if ($enddate = $date->getEndDate()): ?><?php echo '/'?><?php echo collapse_date($enddate) ?><?php endif; ?><?php echo '"' ?><?php endif; ?> encodinganalog="3.1.3"><?php echo htmlspecialchars(date_display($date)) ?></unitdate><?php endforeach; ?>
  <?php if (0 < count($creators = $informationObject->getCreators())): ?>
  <origination encodinganalog="3.2.1">
  <?php foreach ($creators as $creator): ?>
    <?php if ($type = $creator->getEntityTypeId()): ?>
      <?php if ($type == QubitTerm::PERSON_ID): ?>
        <persname><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></persname><?php endif; ?>
      <?php if ($type == QubitTerm::FAMILY_ID): ?>
        <famname><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></famname><?php endif; ?>
      <?php if ($type == QubitTerm::CORPORATE_BODY_ID): ?>
        <corpname><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></corpname><?php endif; ?>
    <?php else: ?>
      <name><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></name><?php endif; ?>
  <?php endforeach; ?>
  </origination><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getExtentAndMedium(array('cultureFallback' => true)))): ?>
  <physdesc><extent encodinganalog="3.1.5"><?php echo htmlspecialchars(nl2br($value)) ?></extent></physdesc><?php endif; ?>
  <?php if ($value = $informationObject->getRepository()): ?>
  <repository>
    <corpname><?php echo htmlspecialchars($value->__toString()) ?></corpname>
    <?php if ($address = $value->getPrimaryContact()): ?> 
    <address>
      <?php if (0 < strlen($addressline = $address->getStreetAddress())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getCity())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getRegion())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $informationObject->getRepositoryCountry())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getPostalCode())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getTelephone())): ?>      
      <addressline><?php echo __('telephone: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getFax())): ?>      
      <addressline><?php echo __('fax: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getEmail())): ?>      
      <addressline><?php echo __('email: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getWebsite())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
    </address><?php endif; ?>
  </repository><?php endif; ?>
  <?php if (0 < count($langmaterial = $informationObject->language)): ?>
  <langmaterial encodinganalog="3.4.3">
  <?php foreach ($langmaterial as $languageCode): ?>
    <language langcode="<?php echo ($iso6392 = $iso639convertor->getID3($languageCode)) ? strtolower($iso6392) : $languageCode ?>"><?php echo format_language($languageCode) ?></language><?php endforeach; ?>
  </langmaterial><?php endif; ?>
  <?php if (0 < count($notes = $informationObject->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID)))): ?><?php foreach ($notes as $note): ?><note type="<?php echo htmlspecialchars($note->getType(array('cultureFallback' => true))) ?>" encodinganalog="3.6.1"><p><?php echo htmlspecialchars($note->getContent(array('cultureFallback' => true))) ?></p></note><?php endforeach; ?><?php endif; ?>
  </did>
  <?php foreach ($informationObject->getCreators() as $creator): ?>
    <?php if ($value = $creator->getHistory(array('cultureFallback' => true))): ?>
  <bioghist encodinganalog="3.2.2"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></bioghist><?php endif; ?><?php endforeach; ?>
  <?php if (0 < strlen($value = $informationObject->getScopeAndContent(array('cultureFallback' => true)))): ?>
  <scopecontent encodinganalog="3.3.1"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></scopecontent><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getArrangement(array('cultureFallback' => true)))): ?>  
  <arrangement encodinganalog="3.3.4"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></arrangement><?php endif; ?>
  <?php if ((0 < count($materialtypes = $informationObject->getMaterialTypes())) ||
            (0 < count($subjects = $informationObject->getSubjectAccessPoints())) ||
            (0 < count($places = $informationObject->getPlaceAccessPoints())) || 
            (0 < count($informationObject->getActors()))): ?>
  <controlaccess>
  <?php foreach ($informationObject->getActorEvents() as $event): ?>
    <?php if ($event->getActor()->getEntityTypeId() == QubitTerm::PERSON_ID): ?>
    <persname role="<?php echo $event->getType()->getRole(array('cultureFallback' => true)) ?>"><?php echo htmlspecialchars(render_title($event->getActor())) ?></persname>
     <?php elseif ($event->getActor()->getEntityTypeId() == QubitTerm::FAMILY_ID): ?>
    <famname role="<?php echo $event->getType()->getRole(array('cultureFallback' => true)) ?>"><?php echo htmlspecialchars(render_title($event->getActor())) ?></famname>
    <?php else: ?>
    <corpname role="<?php echo $event->getType()->getRole(array('cultureFallback' => true)) ?>"><?php echo htmlspecialchars(render_title($event->getActor())) ?></corpname>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php foreach ($materialtypes as $materialtype): ?>
    <genreform><?php echo htmlspecialchars($materialtype->getTerm()) ?></genreform>
  <?php endforeach; ?>
  <?php foreach ($subjects as $subject): ?>
    <subject><?php echo htmlspecialchars($subject->getTerm()) ?></subject>
  <?php endforeach; ?>
  <?php foreach ($places as $place): ?>
    <geogname><?php echo htmlspecialchars($place->getTerm()) ?></geogname>
  <?php endforeach; ?>
  </controlaccess>
  <?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getPhysicalCharacteristics(array('cultureFallback' => true)))): ?>
  <phystech encodinganalog="3.4.3"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></phystech><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getAppraisal(array('cultureFallback' => true)))): ?>
  <appraisal encodinganalog="3.3.2"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></appraisal><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getAcquisition(array('cultureFallback' => true)))): ?>
  <acqinfo encodinganalog="3.2.4"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></acqinfo><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getAccruals(array('cultureFallback' => true)))): ?>
  <accruals encodinganalog="3.3.3"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></accruals><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getArchivalHistory(array('cultureFallback' => true)))): ?>
  <custodhist encodinganalog="3.2.3"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></custodhist><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getRevisionHistory(array('cultureFallback' => true)))): ?>  
  <processinfo><p><?php echo htmlspecialchars(nl2br($value)) ?></p></processinfo><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getLocationOfOriginals(array('cultureFallback' => true)))): ?>
  <originalsloc encodinganalog="3.5.1"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></originalsloc><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getLocationOfCopies(array('cultureFallback' => true)))): ?>
  <altformavail encodinganalog="3.5.2"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></altformavail><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getRelatedUnitsOfDescription(array('cultureFallback' => true)))): ?>
  <relatedmaterial encodinganalog="3.5.3"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></relatedmaterial><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true)))): ?>
  <accessrestrict encodinganalog="3.4.1"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></accessrestrict><?php endif; ?>  
  <?php if (0 < strlen($value = $informationObject->getReproductionConditions(array('cultureFallback' => true)))): ?>
  <userestrict encodinganalog="3.4.2"><p><?php echo htmlspecialchars(nl2br($value))  ?></p></userestrict><?php endif; ?>
  <?php if (0 < strlen($value = $informationObject->getFindingAids(array('cultureFallback' => true)))): ?>
  <otherfindaid encodinganalog="3.4.5"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></otherfindaid><?php endif; ?>
  <?php if (0 < count($publicationNotes = $informationObject->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID)))): ?><?php foreach ($publicationNotes as $note): ?><bibliography encodinganalog="3.5.4"><p><?php echo htmlspecialchars(nl2br($note)) ?></p></bibliography><?php endforeach; ?><?php endif; ?>

    <dsc type="combined"><?php $nestedRgt = array() ?><?php foreach ($informationObject->getDescendants()->orderBy('lft') as $descendant): ?>
    <c <?php if ($descendant->levelOfDescriptionId):?>level="<?php if (in_array(strtolower($levelOfDescription = $descendant->getLevelOfDescription()->getName(array('culture' => 'en'))), $eadLevels)): ?><?php echo strtolower($levelOfDescription).'"' ?><?php else: ?><?php echo 'otherlevel" otherlevel="'.$levelOfDescription.'"' ?><?php endif; ?><?php endif; ?>>
    <did>
    <?php foreach ($descendant->getPhysicalObjects() as $physicalObject): ?><?php if ($physicalObject->getLocation(array('cultureFallback' => true))): ?>
    <physloc><?php echo htmlspecialchars($physicalObject->getLocation(array('cultureFallback' => true))) ?></physloc><?php endif; ?>
    <?php if ($physicalObject->getName(array('cultureFallback' => true))): ?>
    <container type="<?php echo str_replace(' ', '', $physicalObject->getType()) ?>"><?php echo htmlspecialchars($physicalObject->getName(array('cultureFallback' => true))) ?></container><?php endif; ?>
    <?php endforeach; ?>

    <?php if (0 < strlen($value = $descendant->getTitle(array('cultureFallback' => true)))): ?>
    <unittitle encodinganalog="3.1.2"><?php echo htmlspecialchars($value) ?></unittitle><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getIdentifier())): ?><unitid <?php if ($descendant->getRepository()): ?><?php if ($repocode = $descendant->getRepository()->getIdentifier()): ?><?php echo 'repositorycode="'.htmlspecialchars($repocode).'" ' ?><?php endif; ?><?php if ($countrycode = $descendant->getRepository()->getCountryCode()): ?><?php echo 'countrycode="'.$countrycode.'"' ?><?php endif;?><?php endif; ?> encodinganalog="3.1.1"><?php echo htmlspecialchars($value) ?></unitid><?php endif; ?>
    <?php foreach ($descendant->getDates() as $date): ?> 
    <unitdate <?php if ($type = $date->getType()->__toString()): ?><?php echo 'datechar="'.strtolower($type).'" ' ?><?php endif; ?><?php if ($startdate = $date->getStartDate()): ?><?php echo 'normal="'?><?php echo collapse_date($startdate) ?><?php if ($enddate = $date->getEndDate()): ?><?php echo '/'?><?php echo collapse_date($enddate) ?><?php endif; ?><?php echo '"' ?><?php endif; ?> encodinganalog="3.1.3"><?php echo htmlspecialchars(date_display($date)) ?></unitdate><?php endforeach; ?>
    <?php if (0 < count($creators = $descendant->getCreators())): ?>
    <origination encodinganalog="3.2.1">
    <?php foreach ($creators as $creator): ?>
    <?php if ($type = $creator->getEntityTypeId()): ?>
      <?php if ($type == QubitTerm::PERSON_ID): ?>
      <persname><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></persname><?php endif; ?>
      <?php if ($type == QubitTerm::FAMILY_ID): ?>
      <famname><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></famname><?php endif; ?>
      <?php if ($type == QubitTerm::CORPORATE_BODY_ID): ?>
      <corpname><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></corpname><?php endif; ?>
    <?php else: ?>
      <name><?php echo htmlspecialchars($creator->getAuthorizedFormOfName(array('cultureFallback' => true))) ?></name><?php endif; ?>
    <?php endforeach; ?>
    </origination><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getExtentAndMedium(array('cultureFallback' => true)))): ?>
    <physdesc><extent encodinganalog="3.1.5"><?php echo htmlspecialchars(nl2br($value)) ?></extent></physdesc><?php endif; ?>
    <?php if ($value = $descendant->getRepository()): ?>
    <repository>
      <corpname><?php echo htmlspecialchars($value->__toString()) ?></corpname>
      <?php if ($address = $value->getPrimaryContact()): ?> 
      <address>
      <?php if (0 < strlen($addressline = $address->getStreetAddress())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getCity())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getRegion())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $informationObject->getRepositoryCountry())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getPostalCode())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getTelephone())): ?>      
      <addressline><?php echo __('telephone: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getFax())): ?>      
      <addressline><?php echo __('fax: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getEmail())): ?>      
      <addressline><?php echo __('email: ').htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      <?php if (0 < strlen($addressline = $address->getWebsite())): ?>      
      <addressline><?php echo htmlspecialchars($addressline) ?></addressline><?php endif; ?>
      </address><?php endif; ?>
    </repository><?php endif; ?>
    <?php if (0 < count($langmaterial = $descendant->language)): ?>
    <langmaterial encodinganalog="3.4.3">
    <?php foreach ($langmaterial as $languageCode): ?>
      <language langcode="<?php echo ($iso6392 = $iso639convertor->getID3($languageCode)) ? strtolower($iso6392) : $languageCode ?>"><?php echo format_language($languageCode) ?></language><?php endforeach; ?>
    </langmaterial><?php endif; ?>
    <?php if (0 < count($notes = $descendant->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID)))): ?><?php foreach ($notes as $note): ?><note type="<?php echo htmlspecialchars($note->getType(array('cultureFallback' => true))) ?>" encodinganalog="3.6.1"><p><?php echo htmlspecialchars($note->getContent(array('cultureFallback' => true))) ?></p></note><?php endforeach; ?><?php endif; ?>
    </did>
    <?php foreach ($descendant->getCreators() as $creator): ?>
    <?php if ($value = $creator->getHistory(array('cultureFallback' => true))): ?>
    <bioghist encodinganalog="3.2.2"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></bioghist><?php endif; ?><?php endforeach; ?>
    <?php if (0 < strlen($value = $descendant->getScopeAndContent(array('cultureFallback' => true)))): ?>
    <scopecontent encodinganalog="3.3.1"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></scopecontent><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getArrangement(array('cultureFallback' => true)))): ?>  
    <arrangement encodinganalog="3.3.4"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></arrangement><?php endif; ?>
    <?php if ((0 < count($materialtypes = $descendant->getMaterialTypes())) ||
            (0 < count($subjects = $descendant->getSubjectAccessPoints())) ||
            (0 < count($places = $descendant->getPlaceAccessPoints())) || 
            (0 < count($descendant->getActors()))): ?>
    <controlaccess>
    <?php foreach ($descendant->getActorEvents() as $event): ?>
      <?php if ($event->getActor()->getEntityTypeId() == QubitTerm::PERSON_ID): ?>
      <persname role="<?php echo $event->getType()->getRole() ?>"><?php echo htmlspecialchars(render_title($event->getActor(array('cultureFallback' => true)))) ?> </persname>
      <?php elseif ($event->getActor()->getEntityTypeId() == QubitTerm::FAMILY_ID): ?>
      <famname role="<?php echo $event->getType()->getRole() ?>"><?php echo htmlspecialchars(render_title($event->getActor(array('cultureFallback' => true)))) ?> </famname>
      <?php else: ?>
      <corpname role="<?php echo $event->getType()->getRole() ?>"><?php echo htmlspecialchars(render_title($event->getActor(array('cultureFallback' => true)))) ?> </corpname>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php foreach ($materialtypes as $materialtype): ?>
        <genreform><?php echo htmlspecialchars($materialtype->getTerm()) ?></genreform>
      <?php endforeach; ?>
      <?php foreach ($subjects as $subject): ?>
        <subject><?php echo htmlspecialchars($subject->getTerm()) ?></subject>
      <?php endforeach; ?>
      <?php foreach ($places as $place): ?>
        <geogname><?php echo htmlspecialchars($place->getTerm()) ?></geogname>
      <?php endforeach; ?>
    </controlaccess><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getPhysicalCharacteristics(array('cultureFallback' => true)))): ?>
    <phystech encodinganalog="3.4.4"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></phystech><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getAppraisal(array('cultureFallback' => true)))): ?>
    <appraisal encodinganalog="3.3.2"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></appraisal><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getAcquisition(array('cultureFallback' => true)))): ?>
    <acqinfo encodinganalog="3.2.4"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></acqinfo><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getAccruals(array('cultureFallback' => true)))): ?>
    <accruals encodinganalog="3.3.3"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></accruals><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getArchivalHistory(array('cultureFallback' => true)))): ?>
    <custodhist encodinganalog="3.2.3"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></custodhist><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getRevisionHistory(array('cultureFallback' => true)))): ?>  
    <processinfo><p><?php echo htmlspecialchars(nl2br($value)) ?></p></processinfo><?php endif; ?>
    <?php if (0 < count($archivistsNotes = $descendant->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID)))): ?><?php foreach ($archivistsNotes as $note): ?><processinfo><p><?php echo htmlspecialchars(nl2br($note)) ?></p></processinfo><?php endforeach; ?><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getLocationOfOriginals(array('cultureFallback' => true)))): ?>
    <originalsloc encodinganalog="3.5.1"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></originalsloc><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getLocationOfCopies(array('cultureFallback' => true)))): ?>
    <altformavail encodinganalog="3.5.2"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></altformavail><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getRelatedUnitsOfDescription(array('cultureFallback' => true)))): ?>
    <relatedmaterial encodinganalog="3.5.3"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></relatedmaterial><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getAccessConditions(array('cultureFallback' => true)))): ?>
    <accessrestrict encodinganalog="3.4.1"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></accessrestrict><?php endif; ?>  
    <?php if (0 < strlen($value = $descendant->getReproductionConditions(array('cultureFallback' => true)))): ?>
    <userestrict encodinganalog="3.4.2"><p><?php echo htmlspecialchars(nl2br($value))  ?></p></userestrict><?php endif; ?>
    <?php if (0 < strlen($value = $descendant->getFindingAids(array('cultureFallback' => true)))): ?>
    <otherfindaid encodinganalog="3.4.5"><p><?php echo htmlspecialchars(nl2br($value)) ?></p></otherfindaid><?php endif; ?>
    <?php if (0 < count($publicationNotes = $descendant->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID)))): ?><?php foreach ($publicationNotes as $note): ?><bibliography encodinganalog="3.5.4"><p><?php echo htmlspecialchars(nl2br($note)) ?></p></bibliography><?php endforeach; ?><?php endif; ?>

  <?php if ($descendant->getRgt() == $descendant->getLft() + 1): ?>
  </c>
  <?php else: ?>
  <?php array_push($nestedRgt, $descendant->getRgt()) ?>
  <?php endif; ?>

  <?php // close <c> tag when we reach end of child list ?>
  <?php $rgt = $descendant->getRgt() ?>
  <?php while (count($nestedRgt) > 0 && $rgt + 1 == $nestedRgt[count($nestedRgt) - 1]): ?>
  <?php $rgt = array_pop($nestedRgt); ?>
  </c>
  <?php endwhile; ?>
  <?php endforeach; ?>

  </dsc>
</archdesc>
</ead>
