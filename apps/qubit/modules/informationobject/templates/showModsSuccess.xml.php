<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>

<mods xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns="http://www.loc.gov/mods/v3"    
    xsi:schemaLocation="http://www.loc.gov/standards/mods/v3/ mods-3-3.xsd"
    version="3.3">

<titleInfo><title><?php echo htmlspecialchars($informationObject->getTitle()) ?></title></titleInfo>
<?php if (count($modsNames = QubitMods::getNames($informationObject)) > 0): ?>
  <?php foreach ($modsNames as $modsName): ?>
<name type="<?php echo $modsName->getActor()->getEntityType()?>">
  <namePart><?php echo htmlspecialchars($modsName->getActor()) ?></namePart>
  <role><?php echo $modsName->getType()->getRole() ?></role>
</name><?php endforeach; ?><?php endif; ?>
<?php if (count($modsTypes = QubitMods::getTypes($informationObject)) > 0): ?>
  <?php foreach ($modsTypes as $modsType): ?>
<typeOfResource><?php echo htmlspecialchars($modsType->getTerm()) ?></typeOfResource><?php endforeach; ?><?php endif; ?>
<?php if (count($dates = $informationObject->getDates()) > 0) : ?>
<originInfo><?php foreach ($dates as $date): ?><?php if ($place = $date->getPlace()): ?>
<place><?php echo $place ?></place><?php endif; ?>
    <?php if ($date->getTypeId() == QubitTerm::CREATION_ID): ?>
<dateCreated><?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?></dateCreated>
    <?php elseif ($date->getTypeId() == QubitTerm::PUBLICATION_ID): ?>
<dateIssued><?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?></dateIssued>
    <?php else: ?>
<dateOther><?php echo $date->getDateDisplay(array('cultureFallback' => true)) ?><?php echo ' ('.$date->getType().')' ?></dateOther><?php endif; ?><?php endforeach; ?>
</originInfo><?php endif; ?>
<?php if (count($languageCodes = QubitMods::getLanguageCodes($informationObject)) > 0) : ?>
  <?php foreach ($languageCodes as $languageCode): ?>
<language><?php echo format_language($languageCode->getValue(array('sourceCulture'=>true))); ?></language><?php endforeach; ?><?php endif; ?>
<?php if ($digitalObject = QubitMODS::getDigitalObject($informationObject)): ?><?php if ($digitalObject->getMimeType()): ?>
<physicalDescription><internetMediaType><?php echo $digitalObject->getMimeType() ?></internetMediaType></physicalDescription><?php endif; ?><?php endif; ?>
<?php if (count($subjectAccessPoints = $informationObject->getSubjectAccessPoints()) > 0) : ?>
  <?php foreach ($subjectAccessPoints as $subject): ?>
<subject><?php echo htmlspecialchars($subject->getTerm()) ?></subject><?php endforeach; ?><?php endif; ?>
<?php if ($informationObject->getIdentifier()): ?>
<identifier><?php echo htmlspecialchars(QubitDc::getIdentifier($informationObject)) ?></identifier><?php endif; ?>
<?php if ((QubitMODS::getDigitalObject($informationObject)) || ($informationObject->getRepository())): ?>
<location><?php if ($digitalObject = QubitMODS::getDigitalObject($informationObject)): ?><url usage="primary display">http://<?php echo $sf_request->getHost().$sf_request->getRelativeUrlRoot().$digitalObject->getFullPath() ?></url><?php endif; ?>
  <?php if ($repository = $informationObject->getRepository()): ?>
    <?php if ($repository->getIdentifier()): ?>
<physicalLocation><?php echo $repository->getIdentifier() ?></physicalLocation><?php endif; ?><?php if ($repository->__toString()): ?>      <physicalLocation><?php echo htmlspecialchars($repository->__toString()) ?></physicalLocation><?php endif; ?>
<?php if ($contactInformation = $repository->getPrimaryContact()): ?>
<physicalLocation><?php echo $contactInformation->getCity() ?><?php if ($contactInformation->getCity()): ?><?php echo ', '?><?php endif; ?><?php echo $contactInformation->getRegion() ?><?php if ($contactInformation->getRegion() && $contactInformation->getCountryCode()): ?><?php echo ', ' ?><?php endif; ?><?php echo format_country($contactInformation->getCountryCode()) ?></physicalLocation><?php endif; ?><?php endif; ?>
</location><?php endif; ?>
<?php if (count($children = $informationObject->getChildren()) > 0): ?>
  <?php foreach ($children as $relatedItem): ?>
<relatedItem type="constituent" ID="<?php echo $relatedItem->getIdentifier() ?>"><?php echo htmlspecialchars(QubitMods::getLabel($relatedItem)); ?></relatedItem> <?php endforeach; ?><?php endif; ?>
<?php if (strlen($value = $informationObject->getAccessConditions(array('cultureFallback' => true))) > 0) : ?><accessCondition><?php echo htmlspecialchars(nl2br($value)) ?></accessCondition><?php endif; ?>
<recordInfo>
<recordCreationDate><?php echo $informationObject->getCreatedAt() ?></recordCreationDate>
<?php if ($informationObject->getCreatedAt() != $informationObject->getUpdatedAt()): ?>
<recordChangeDate><?php echo $informationObject->getUpdatedAt() ?></recordChangeDate><?php endif; ?>
</recordInfo>
</mods>
