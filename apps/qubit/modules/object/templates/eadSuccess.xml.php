<!DOCTYPE ead PUBLIC "+//ISBN 1-931666-00-8//DTD ead.dtd (Encoded Archival Description (EAD) Version 2002)//EN" "http://xml.coverpages.org/EADv20-dtd.txt">

<ead relatedencoding="MARC21">

<eadheader langencoding="iso639-1" countryencoding="iso3166-1" dateencoding="iso8601" repositoryencoding="iso15511" scriptencoding="iso15924">

<eadid
      countrycode="<?php if ($baseObject->getRepository()): ?><?php echo htmlentities($baseObject->getRepository()->getCountryCode()) ?><?php endif; ?>"
      mainagencycode="<?php if ($baseObject->getRepository()): ?> <?php echo htmlentities($baseObject->getRepository()->getCountryCode().'-'.$baseObject->getRepository()->getIdentifier()) ?><?php endif; ?>"
      encodinganalog="856$u"
      url="<?php echo url_for('informationobject/show?id='.$baseObject->getId(), $absolute = true) ?>">
      <?php echo htmlentities($baseObject->getId().' ('.gmdate('o-m-d H:s:e').')') ?>
</eadid>

<filedesc>
  <titlestmt>
    <titleproper encodinganalog="245$a"><?php echo htmlentities(__('Finding Aid').' - '.$baseObject->getTitle()) ?>
    </titleproper>
    <subtitle></subtitle>
    <author encodinganalog="245$c"><?php echo htmlentities(($baseObject->getRevisionHistory())) ?></author>
    <sponsor></sponsor>
  </titlestmt>

  <editionstmt>
    <edition encodinganalog="250$a"><?php echo htmlentities(($baseObject->getEdition())) ?></edition>
  </editionstmt>

  <publicationstmt>
    <?php if ($baseObject->getRepository()): ?>
    <publisher encodinganalog="260$b"><?php echo htmlentities($baseObject->getRepository()->__toString()) ?></publisher>
    <date encodinganalog="260$c"></date>
    <address encodinganalog="260$a">
      <addressline><?php echo htmlentities($baseObject->getRepository()) ?></addressline>
      <addressline><?php echo htmlentities($baseObject->getRepository()->getPrimaryContact()->getStreetAddress()) ?></addressline>
      <addressline><?php echo htmlentities($baseObject->getRepository()->getPrimaryContact()->getCity().', '.$baseObject->getRepository()->getPrimaryContact()->getRegion()) ?></addressline>
      <addressline><?php echo htmlentities($baseObject->getRepositoryCountry().'  '.$baseObject->getRepository()->getPrimaryContact()->getPostalCode()) ?></addressline>
      <addressline><?php echo htmlentities(__('Telephone').': '.$baseObject->getRepository()->getPrimaryContact()->getTelephone()) ?></addressline>
      <addressline><?php echo htmlentities(__('Fax').': '.$baseObject->getRepository()->getPrimaryContact()->getFax()) ?></addressline>
      <addressline><?php echo htmlentities(__('Email').': '.$baseObject->getRepository()->getPrimaryContact()->getEmail()) ?></addressline>
      <addressline><?php echo htmlentities(__('Website').': '.$baseObject->getRepository()->getPrimaryContact()->getWebsite()) ?></addressline>
    </address>
    <?php endif; ?>
  </publicationstmt>

  <seriesstmt></seriesstmt>
  <notestmt></notestmt>
</filedesc>

<profiledesc>
  <creation><date/></creation>
  <langusage>
    <?php foreach ($baseObject->getProperties('language_of_information_object_description') as $languageCode): ?>
      <language langcode="<?php echo $languageCode->getValue() ?>"><?php echo htmlentities(format_language($languageCode->getValue())) ?></language>
    <?php endforeach; ?>
  </langusage>
  <descrules><?php echo htmlentities($baseObject->getRules()) ?></descrules>
</profiledesc>

<revisiondesc></revisiondesc>

</eadheader>



<frontmatter></frontmatter>



<archdesc level="<?php echo htmlentities($baseObject->getLevelOfDescription()->__toString()) ?>" type="">


<did>

<origination>
  <?php foreach ($baseObject->getCreators() as $creator): ?>
    <?php if ($type = $creator->getEntityTypeId()): ?>
      <?php if ($type == QubitTerm::PERSON_ID): ?>
        <persname><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></persname>
      <?php endif; ?>
      <?php if ($type == QubitTerm::FAMILY_ID): ?>
        <famname><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></famname>
      <?php endif; ?>
      <?php if ($type == QubitTerm::CORPORATE_BODY_ID): ?>
        <corpname><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></corpname>
      <?php endif; ?>
    <?php else: ?>
      <name encodinganalog="100"><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></name>
    <?php endif; ?>
  <?php endforeach; ?>
</origination>

<unittitle encodinganalog="245$a"><?php echo htmlentities($baseObject->getTitle()) ?></unittitle>

<unitid encodinganalog="099"
<?php if ($baseObject->getRepository()): ?>
repositorycode="<?php echo htmlentities($baseObject->getRepository()->getIdentifier()) ?>"
countrycode="<?php echo htmlentities($baseObject->getRepository()->getCountryCode()) ?>"
<?php endif; ?>
><?php echo htmlentities($baseObject->getIdentifier()) ?></unitid>

<?php foreach ($baseObject->getCreationEvents() as $event): ?>
<unitdate type="" encodinganalog="245$f" datechar="<?php echo htmlentities($event->getType()->__toString()) ?>" normal="<?php echo htmlentities($event->getStartDate()) ?><?php if ($event->getEndDate()): ?>/<?php echo htmlentities($event->getEndDate()) ?><?php endif; ?>">
<?php echo htmlentities($event->getDateDisplay()) ?>
</unitdate>
<?php endforeach; ?>

<physdesc encodinganalog="300$a">
  <extent><?php echo htmlentities($baseObject->getExtentAndMedium()) ?></extent>
  <phystech><?php echo htmlentities($baseObject->getPhysicalCharacteristics()) ?></phystech>
</physdesc>

<repository encodinganalog="852$a">
  <?php if ($baseObject->getRepository()): ?>
  <corpname encodinganalog="110"><?php echo htmlentities($baseObject->getRepository()) ?></corpname>
    <address encodinganalog="260$a">
      <addressline><?php echo htmlentities($baseObject->getRepository()) ?></addressline>
      <addressline><?php echo htmlentities($baseObject->getRepository()->getPrimaryContact()->getStreetAddress()) ?></addressline>
      <addressline><?php echo htmlentities($baseObject->getRepository()->getPrimaryContact()->getCity().', '.$baseObject->getRepository()->getPrimaryContact()->getRegion()) ?></addressline>
      <addressline><?php echo htmlentities($baseObject->getRepositoryCountry().'  '.$baseObject->getRepository()->getPrimaryContact()->getPostalCode()) ?></addressline>
      <addressline><?php echo htmlentities(__('Telephone').': '.$baseObject->getRepository()->getPrimaryContact()->getTelephone()) ?></addressline>
      <addressline><?php echo htmlentities(__('Fax').': '.$baseObject->getRepository()->getPrimaryContact()->getFax()) ?></addressline>
      <addressline><?php echo htmlentities(__('Email').': '.$baseObject->getRepository()->getPrimaryContact()->getEmail()) ?></addressline>
      <addressline><?php echo htmlentities(__('Website').': '.$baseObject->getRepository()->getPrimaryContact()->getWebsite()) ?></addressline>
    </address>
  <?php endif; ?>
</repository>

<langmaterial encodinganalog="546$a">
  <?php foreach ($baseObject->getProperties('language_of_information_object_description') as $languageCode): ?>
    <language langcode="<?php echo $languageCode->getValue() ?>"><?php echo htmlentities(format_language($languageCode->getValue())) ?>
    </language>
  <?php endforeach; ?>
</langmaterial>

<materialspec />

<?php foreach ($baseObject->getNotes() as $note): ?>
  <note type="<?php echo htmlentities($note->getType()) ?>"><?php echo htmlentities($note->getContent()) ?></note>
<?php endforeach; ?>


</did>


<?php foreach ($baseObject->getCreators() as $creator): ?>
  <?php if ($creator->getHistory()): ?>
  <bioghist encodinganalog="545">
    <?php echo htmlentities($creator->getHistory()) ?>
  </bioghist>
  <?php endif; ?>
<?php endforeach; ?>

<scopecontent encodinganalog="520"><?php echo htmlentities($baseObject->getScopeAndContent()) ?></scopecontent>

<arrangement encodinganalog="351"><?php echo htmlentities($baseObject->getArrangement()) ?></arrangement>

<controlaccess>
  <?php foreach ($baseObject->getActorEvents() as $event): ?>
    <?php if ($event->getActor()->getEntityTypeId() == QubitTerm::PERSON_ID): ?>
      <persname role="<?php echo htmlentities($event->getType()->getRole()) ?>"><?php echo htmlentities(render_title($event->getActor())) ?> </persname>
     <?php elseif ($event->getActor()->getEntityTypeId() == QubitTerm::FAMILY_ID): ?>
      <famname role="<?php echo htmlentities($event->getType()->getRole()) ?>"><?php echo htmlentities(render_title($event->getActor())) ?> </famname>
    <?php else: ?>
      <corpname role="<?php echo htmlentities($event->getType()->getRole()) ?>"><?php echo htmlentities(render_title($event->getActor())) ?> </corpname>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php foreach ($baseObject->getMaterialTypes() as $materialtype): ?>
    <genreform><?php echo htmlentities($materialtype->getTerm()) ?></genreform>
  <?php endforeach; ?>
  <?php foreach ($baseObject->getSubjectAccessPoints() as $subject): ?>
    <subject><?php echo htmlentities($subject->getTerm()) ?></subject>
  <?php endforeach; ?>
  <?php foreach ($baseObject->getPlaceAccessPoints() as $place): ?>
    <geogname><?php echo htmlentities($place->getTerm()) ?></geogname>
  <?php endforeach; ?>
  <occupation />
  <function />
  <title />
</controlaccess>

<accessrestrict encodinganalog="506"><?php echo htmlentities($baseObject->getAccessConditions()) ?></accessrestrict>

<accruals encodinganalog="584"><?php echo htmlentities($baseObject->getAccruals()) ?></accruals>

<acqinfo encodinganalog="541"><?php echo htmlentities($baseObject->getAcquisition()) ?></acqinfo>

<altformavail><?php echo htmlentities($baseObject->getLocationOfCopies()) ?></altformavail>

<appraisal encodinganalog="583"><?php echo htmlentities($baseObject->getAppraisal()) ?></appraisal>

<custodhist encodinganalog="561"><?php echo htmlentities($baseObject->getArchivalHistory()) ?></custodhist>

<processinfo encodinganalog="583"><?php echo htmlentities($baseObject->getRevisionHistory()) ?></processinfo>

<userestrict><?php echo htmlentities($baseObject->getReproductionConditions()) ?></userestrict>

<originalsloc><?php echo htmlentities($baseObject->getLocationOfOriginals()) ?></originalsloc>

<relatedmaterial encodinganalog="544 1"><?php echo htmlentities($baseObject->getRelatedUnitsOfDescription()) ?></relatedmaterial>

<separatedmaterial encodinganalog="544 0" />

<otherfindaid encodinganalog="555"><?php echo htmlentities($baseObject->getFindingAids()) ?></otherfindaid>


<dsc type="combined">
<?php $nestedRgt = array() ?>
<?php foreach ($baseObject->getDescendants()->orderBy('lft') as $descendant): ?>
<c level="<?php echo htmlentities($descendant->getLevelOfDescription()) ?>">

<did>

<?php foreach ($descendant->getPhysicalObjects() as $physicalObject): ?>
<?php if ($physicalObject->getLocation()): ?>
  <physloc><?php echo $physicalObject->getLocation() ?></physloc>
<?php endif; ?>
<?php if ($physicalObject->getName()): ?>
  <container type="<?php echo $physicalObject->getType() ?>"><?php echo $physicalObject->getName() ?></container>
<?php endif; ?>
<?php endforeach; ?>

<origination>
  <?php foreach ($descendant->getCreators() as $creator): ?>
    <?php if ($type = $creator->getEntityTypeId()): ?>
      <?php if ($type == QubitTerm::PERSON_ID): ?>
        <persname><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></persname>
      <?php endif; ?>
      <?php if ($type == QubitTerm::FAMILY_ID): ?>
        <famname><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></famname>
      <?php endif; ?>
      <?php if ($type == QubitTerm::CORPORATE_BODY_ID): ?>
        <corpname><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></corpname>
      <?php endif; ?>
    <?php else: ?>
      <name encodinganalog="100"><?php echo htmlentities($creator->getAuthorizedFormOfName()) ?></name>
    <?php endif; ?>
  <?php endforeach; ?>
</origination>

<unittitle encodinganalog="245$a"><?php echo htmlentities($descendant->getTitle()) ?></unittitle>

<unitid encodinganalog="099"
<?php if ($descendant->getRepository()): ?>
repositorycode="<?php echo htmlentities($descendant->getRepository()->getIdentifier()) ?>"
countrycode="<?php echo htmlentities($descendant->getRepository()->getCountryCode()) ?>"
<?php endif; ?>
><?php echo htmlentities($descendant->getIdentifier()) ?></unitid>

<?php foreach ($descendant->getCreationEvents() as $event): ?>
<unitdate type="" encodinganalog="245$f" datechar="<?php echo htmlentities($event->getType()) ?>" normal="<?php echo htmlentities($event->getStartDate()) ?><?php if ($event->getEndDate()): ?>/<?php echo htmlentities($event->getEndDate()) ?><?php endif; ?>">
<?php echo htmlentities($event->getDateDisplay()) ?>
</unitdate>
<?php endforeach; ?>

<physdesc encodinganalog="300$a">
  <extent><?php echo htmlentities($descendant->getExtentAndMedium()) ?></extent>
  <phystech><?php echo htmlentities($descendant->getPhysicalCharacteristics()) ?></phystech>
</physdesc>

<repository encodinganalog="852$a">
  <?php if ($descendant->getRepository()): ?>
  <corpname encodinganalog="110"><?php echo htmlentities($descendant->getRepository()) ?></corpname>
    <address encodinganalog="260$a">
      <addressline><?php echo htmlentities($descendant->getRepository()) ?></addressline>
      <addressline><?php echo htmlentities($descendant->getRepository()->getPrimaryContact()->getStreetAddress()) ?></addressline>
      <addressline><?php echo htmlentities($descendant->getRepository()->getPrimaryContact()->getCity().', '.$descendant->getRepository()->getPrimaryContact()->getRegion()) ?></addressline>
      <addressline><?php echo htmlentities($descendant->getRepositoryCountry().'  '.$descendant->getRepository()->getPrimaryContact()->getPostalCode()) ?></addressline>
      <addressline><?php echo htmlentities(__('Telephone').': '.$descendant->getRepository()->getPrimaryContact()->getTelephone()) ?></addressline>
      <addressline><?php echo htmlentities(__('Fax').': '.$descendant->getRepository()->getPrimaryContact()->getFax()) ?></addressline>
      <addressline><?php echo htmlentities(__('Email').': '.$descendant->getRepository()->getPrimaryContact()->getEmail()) ?></addressline>
      <addressline><?php echo htmlentities(__('Website').': '.$descendant->getRepository()->getPrimaryContact()->getWebsite()) ?></addressline>
    </address>
  <?php endif; ?>
</repository>

<langmaterial encodinganalog="546$a">
  <?php foreach ($descendant->getProperties('language_of_information_object_description') as $languageCode): ?>
    <language langcode="<?php echo $languageCode->getValue() ?>"><?php echo htmlentities(format_language($languageCode->getValue())) ?>
    </language>
  <?php endforeach; ?>
</langmaterial>

<materialspec />

<?php foreach ($descendant->getNotes() as $note): ?>
  <note type="<?php echo htmlentities($note->getType()) ?>"><?php echo htmlentities($note->getContent()) ?></note>
<?php endforeach; ?>

</did>


<?php foreach ($descendant->getCreators() as $creator): ?>
  <?php if ($creator->getHistory()): ?>
  <bioghist encodinganalog="545">
    <?php echo htmlentities($creator->getHistory()) ?>
  </bioghist>
  <?php endif; ?>
<?php endforeach; ?>

<scopecontent encodinganalog="520"><?php echo htmlentities($descendant->getScopeAndContent()) ?></scopecontent>

<arrangement encodinganalog="351"><?php echo htmlentities($descendant->getArrangement()) ?></arrangement>

<controlaccess>
  <?php foreach ($descendant->getActorEvents() as $event): ?>
    <?php if ($event->getActor()->getEntityTypeId() == QubitTerm::PERSON_ID): ?>
      <persname role="<?php echo htmlentities($event->getType()->getRole()) ?>"><?php echo htmlentities(render_title($event->getActor())) ?> </persname>
     <?php elseif ($event->getActor()->getEntityTypeId() == QubitTerm::FAMILY_ID): ?>
      <famname role="<?php echo htmlentities($event->getType()->getRole()) ?>"><?php echo htmlentities(render_title($event->getActor())) ?> </famname>
    <?php else: ?>
      <corpname role="<?php echo htmlentities($event->getType()->getRole()) ?>"><?php echo htmlentities(render_title($event->getActor())) ?> </corpname>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php foreach ($descendant->getMaterialTypes() as $materialtype): ?>
    <genreform><?php echo htmlentities($materialtype->getTerm()) ?></genreform>
  <?php endforeach; ?>
  <?php foreach ($descendant->getSubjectAccessPoints() as $subject): ?>
    <subject><?php echo htmlentities($subject->getTerm()) ?></subject>
  <?php endforeach; ?>
  <?php foreach ($descendant->getPlaceAccessPoints() as $place): ?>
    <geogname><?php echo htmlentities($place->getTerm()) ?></geogname>
  <?php endforeach; ?>
  <occupation />
  <function />
  <title />
</controlaccess>

<accessrestrict encodinganalog="506"><?php echo htmlentities($descendant->getAccessConditions()) ?></accessrestrict>

<accruals encodinganalog="584"><?php echo htmlentities($descendant->getAccruals()) ?></accruals>

<acqinfo encodinganalog="541"><?php echo htmlentities($descendant->getAcquisition()) ?></acqinfo>

<altformavail><?php echo htmlentities($descendant->getLocationOfCopies()) ?></altformavail>

<appraisal encodinganalog="583"><?php echo htmlentities($descendant->getAppraisal()) ?></appraisal>

<custodhist encodinganalog="561"><?php echo htmlentities($descendant->getArchivalHistory()) ?></custodhist>

<processinfo encodinganalog="583"><?php echo htmlentities($descendant->getRevisionHistory()) ?></processinfo>

<userestrict><?php echo htmlentities($descendant->getReproductionConditions()) ?></userestrict>

<originalsloc><?php echo htmlentities($descendant->getLocationOfOriginals()) ?></originalsloc>

<relatedmaterial encodinganalog="544 1"><?php echo htmlentities($descendant->getRelatedUnitsOfDescription()) ?></relatedmaterial>

<separatedmaterial encodinganalog="544 0" />

<otherfindaid encodinganalog="555"><?php echo htmlentities($descendant->getFindingAids()) ?></otherfindaid>

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
