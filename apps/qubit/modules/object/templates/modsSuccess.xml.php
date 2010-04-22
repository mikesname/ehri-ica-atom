<mods xmlns="http://www.loc.gov/mods/v3"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.loc.gov/mods/v3 http://www.loc.gov/standards/mods/mods.xsd"
    ID="ID001" version="3.3">

<titleInfo>
  <title><?php echo htmlentities($baseObject->getTitle()) ?></title>
</titleInfo>

<?php if (count($modsNames = QubitMods::getNames($baseObject)) > 0): ?>
  <?php foreach ($modsNames as $modsName): ?>
<name type="<?php echo $modsName->getActor()->getEntityType()?>">
  <namePart><?php echo $modsName->getActor() ?></namePart>
  <role><?php echo $modsName->getType()->getRole() ?></role>
</name>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($modsTypes = QubitMods::getTypes($baseObject)) > 0): ?>
  <?php foreach ($modsTypes as $modsType): ?>
<typeOfResource><?php echo $modsType->getTerm() ?></typeOfResource>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($dates = $baseObject->getDates()) > 0) : ?>
<originInfo>
  <?php foreach ($dates as $date): ?>
    <?php if ($place = $date->getPlace()): ?>
<place><?php echo $place ?></place>
    <?php endif; ?>
    <?php if ($date->getTypeId() == QubitTerm::CREATION_ID): ?>
<dateCreated><?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?></dateCreated>
    <?php elseif ($date->getTypeId() == QubitTerm::PUBLICATION_ID): ?>
<dateIssued><?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?></dateIssued>
    <?php else: ?>
<dateOther><?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?><?php echo ' ('.$date->getType().')' ?></dateOther>
    <?php endif; ?>
  <?php endforeach; ?>
</originInfo>
<?php endif; ?>

<?php if (count($languageCodes = QubitMods::getLanguageCodes($baseObject)) > 0) : ?>
  <?php foreach ($languageCodes as $languageCode): ?>
<language><?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))); ?></language>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($digitalObject = QubitMODS::getDigitalObject($baseObject)): ?>
  <?php if ($digitalObject->getMimeType()): ?>
<physicalDescription><internetMediaType><?php echo $digitalObject->getMimeType() ?></internetMediaType></physicalDescription>
  <?php endif; ?>
<?php endif; ?>

<?php if (count($subjectAccessPoints = $baseObject->getSubjectAccessPoints()) > 0) : ?>
  <?php foreach ($subjectAccessPoints as $subject): ?>
<subject><?php echo $subject->getTerm() ?></subject>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($baseObject->getIdentifier()): ?>
<dc:identifier><?php echo htmlentities(QubitDc::getIdentifier($baseObject)) ?></dc:identifier>
<?php endif; ?>

<?php if ((QubitMODS::getDigitalObject($baseObject)) || ($baseObject->getRepository())): ?>
<location>
  <?php if ($digitalObject = QubitMODS::getDigitalObject($baseObject)): ?>
  <url usage="primary display">http://<?php echo $sf_request->getHost().$sf_request->getRelativeUrlRoot().$digitalObject->getFullPath() ?></url>
  <?php endif; ?>

  <?php if ($repository = $baseObject->getRepository()): ?>
    <?php if ($repository->getIdentifier()): ?>
      <physicalLocation><?php echo $repository->getIdentifier() ?></physicalLocation>
    <?php endif; ?>
    <?php if ($repository->__toString()): ?>
      <physicalLocation><?php echo $repository->__toString() ?></physicalLocation>
    <?php endif; ?>
    <?php if ($contactInformation = $repository->getPrimaryContact()): ?>
      <physicalLocation><?php echo $contactInformation->getCity() ?><?php if ($contactInformation->getCity()): ?><?php echo ', '?><?php endif; ?>
      <?php echo $contactInformation->getRegion() ?><?php if ($contactInformation->getRegion() && $contactInformation->getCountryCode()): ?><?php echo ', ' ?><?php endif; ?>
      <?php echo format_country($contactInformation->getCountryCode()) ?></physicalLocation>
    <?php endif; ?>
  <?php endif; ?>
</location>
<?php endif; ?>

<?php if (count($children = $baseObject->getChildren()) > 0): ?>
  <?php foreach ($children as $relatedItem): ?>
<relatedItem type="constituent" ID="<?php echo $relatedItem->getIdentifier() ?>">
  <?php echo QubitMods::getLabel($relatedItem); ?>
</relatedItem>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (strlen($value = $baseObject->getAccessConditions(array('cultureFallback' => true))) > 0) : ?>
<accessCondition><?php echo $value ?></accessCondition>
<?php endif; ?>

<recordInfo>
  <recordCreationDate><?php echo $baseObject->getCreatedAt() ?></recordCreationDate>
  <?php if ($baseObject->getCreatedAt() != $baseObject->getUpdatedAt()): ?>
  <recordChangeDate><?php echo $baseObject->getUpdatedAt() ?></recordChangeDate>
  <?php endif; ?>
</recordInfo>

</mods>
