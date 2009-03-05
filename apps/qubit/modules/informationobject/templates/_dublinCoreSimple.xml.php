<!-- This is a Qubit export for the 15 Dublin Core elements know collectively as 'simple Dublin Core'.
     It uses a template that follows the best practices outlined in 'Using Dublin Core - The Elements', see
     http://dublincore.org/documents/usageguide/elements.shtml. Since Dublin Core does not prescribe a specific
     order for the 15 elements, they are ordered according to the OAI DC schema see http://www.openarchives.org/OAI/2.0/oai_dc.xsd -->

          <dc:title><?php echo htmlentities($informationObject->getTitle()) ?></dc:title>

<?php foreach ($informationObject->getCreators() as $creator): ?>
          <dc:creator><?php echo htmlentities($creator) ?></dc:creator>
<?php endforeach; ?>

<?php if (count($dcSubjects = QubitDc::getSubjects($informationObject)) > 0): ?>
  <?php foreach ($dcSubjects as $dcSubject): ?>
        <dc:subject><?php echo htmlentities($dcSubject) ?></dc:subject>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($informationObject->getScopeAndContent()): ?>
          <dc:description><?php echo htmlentities($informationObject->getScopeAndContent()) ?></dc:description>
<?php endif; ?>

<?php foreach ($informationObject->getPublishers() as $publisher): ?>
          <dc:publisher><?php echo htmlentities($publisher) ?></dc:publisher>
<?php endforeach; ?>

<?php foreach ($informationObject->getContributors() as $contributor): ?>
          <dc:contributor><?php echo htmlentities($contributor) ?></dc:contributor>
<?php endforeach; ?>

<?php foreach (QubitDc::getDates($informationObject) as $dcDate): ?>
          <dc:date><?php echo htmlentities($dcDate) ?></dc:date>
<?php endforeach; ?>

<?php if (count($dcTypes = QubitDc::getTypes($informationObject)) > 0): ?>
  <?php foreach ($dcTypes as $dcType): ?>
        <dc:type><?php echo htmlentities($dcType) ?></dc:type>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($dcFormats = QubitDc::getFormats($informationObject)) > 0): ?>
  <?php foreach ($dcFormats as $dcFormat): ?>
        <dc:format><?php echo htmlentities($dcFormat) ?></dc:format>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($informationObject->getIdentifier()): ?>
          <dc:identifier><?php echo htmlentities(QubitDc::getIdentifier($informationObject)) ?></dc:identifier>
<?php endif; ?>

<?php if ($source = $informationObject->getLocationOfOriginals()): ?>
          <dc:source><?php echo htmlentities($source) ?></dc:source>
<?php endif; ?>

<?php if (count($languages = $informationObject->getProperties($name = 'information_object_language')) > 0): ?>
  <?php foreach ($languages as $languageCode): ?>
          <dc:language><?php echo htmlentities($languageCode->getValue()) ?></dc:language>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($dcRelation['text'] !== ''): ?>
          <dc:relation><?php echo htmlentities($dcRelation['text']) ?></dc:relation>
<?php endif; ?>
<?php if ($dcRelation['identifier']): ?>
          <dc:relation><?php echo htmlentities($dcRelation['identifier']) ?></dc:relation>
<?php endif; ?>

<?php foreach (QubitDc::getCoverage($informationObject, array('temporal' => true)) as $coverageTemporal): ?>
          <dc:coverage><?php echo htmlentities($coverageTemporal) ?></dc:coverage>
<?php endforeach; ?>
<?php foreach (QubitDc::getCoverage($informationObject, array('spatial' => true)) as $coverageSpatial): ?>
          <dc:coverage><?php echo htmlentities($coverageSpatial) ?></dc:coverage>
<?php endforeach; ?>

<?php if ($accessConditions = $informationObject->getAccessConditions()): ?>
          <dc:rights><?php echo htmlentities($accessConditions) ?></dc:rights>
<?php endif; ?>

<?php if ($reproductionConditions = $informationObject->getReproductionConditions()): ?>
          <dc:rights><?php echo htmlentities($reproductionConditions) ?></dc:rights>
<?php endif; ?>
