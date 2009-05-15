<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>

<dc xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:schemaLocation="http://purl.org/dc/elements/1.1/">

<dc:title><?php echo htmlentities($baseObject->getTitle()) ?></dc:title>

<?php foreach ($baseObject->getCreators() as $creator): ?>
          <dc:creator><?php echo htmlentities($creator->__toString()) ?></dc:creator>
<?php endforeach; ?>

<?php if (count($dcSubjects = QubitDc::getSubjects($baseObject)) > 0): ?>
  <?php foreach ($dcSubjects as $dcSubject): ?>
        <dc:subject><?php echo htmlentities($dcSubject->__toString()) ?></dc:subject>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($baseObject->getScopeAndContent()): ?>
          <dc:description><?php echo htmlentities($baseObject->getScopeAndContent()) ?></dc:description>
<?php endif; ?>

<?php foreach ($baseObject->getPublishers() as $publisher): ?>
          <dc:publisher><?php echo htmlentities($publisher) ?></dc:publisher>
<?php endforeach; ?>

<?php foreach ($baseObject->getContributors() as $contributor): ?>
          <dc:contributor><?php echo htmlentities($contributor->__toString()) ?></dc:contributor>
<?php endforeach; ?>

<?php foreach (QubitDc::getDates($baseObject) as $dcDate): ?>
          <dc:date><?php echo htmlentities($dcDate) ?></dc:date>
<?php endforeach; ?>

<?php if (count($dcTypes = QubitDc::getTypes($baseObject)) > 0): ?>
  <?php foreach ($dcTypes as $dcType): ?>
        <dc:type><?php echo htmlentities($dcType->__toString()) ?></dc:type>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($dcFormats = QubitDc::getFormats($baseObject)) > 0): ?>
  <?php foreach ($dcFormats as $dcFormat): ?>
        <dc:format><?php echo htmlentities($dcFormat) ?></dc:format>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($baseObject->getIdentifier()): ?>
          <dc:identifier><?php echo htmlentities(QubitDc::getIdentifier($baseObject)) ?></dc:identifier>
<?php endif; ?>

<?php if ($source = $baseObject->getLocationOfOriginals()): ?>
          <dc:source><?php echo htmlentities($source) ?></dc:source>
<?php endif; ?>

<?php if (count($languages = $baseObject->getProperties($name = 'information_object_language')) > 0): ?>
  <?php foreach ($languages as $languageCode): ?>
          <dc:language><?php echo htmlentities($languageCode->getValue()) ?></dc:language>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($dcRelation = QubitDc::getRelation($baseObject)): ?>

<?php if ($dcRelation['text'] !== ''): ?>
          <dc:relation><?php echo htmlentities($dcRelation['text']) ?></dc:relation>
<?php endif; ?>

<?php if ($dcRelation['property']): ?>
          <dc:relation><?php echo htmlentities($dcRelation['property']) ?></dc:relation>
<?php endif; ?>

<?php endif; ?>

<?php foreach (QubitDc::getCoverage($baseObject, array('temporal' => true)) as $coverageTemporal): ?>
          <dc:coverage><?php echo htmlentities($coverageTemporal) ?></dc:coverage>
<?php endforeach; ?>
<?php foreach (QubitDc::getCoverage($baseObject, array('spatial' => true)) as $coverageSpatial): ?>
          <dc:coverage><?php echo htmlentities($coverageSpatial) ?></dc:coverage>
<?php endforeach; ?>

<?php if ($accessConditions = $baseObject->getAccessConditions()): ?>
          <dc:rights><?php echo htmlentities($accessConditions) ?></dc:rights>
<?php endif; ?>

<?php if ($reproductionConditions = $baseObject->getReproductionConditions()): ?>
          <dc:rights><?php echo htmlentities($reproductionConditions) ?></dc:rights>
<?php endif; ?>

</dc>

