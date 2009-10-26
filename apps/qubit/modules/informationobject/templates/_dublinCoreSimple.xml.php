<dc:title><?php echo htmlspecialchars($informationObject->getTitle()) ?></dc:title>
<?php foreach ($informationObject->getCreators() as $creator): ?>
<dc:creator><?php echo htmlspecialchars($creator) ?></dc:creator>
<?php endforeach; ?>
<?php if (count($dcSubjects = QubitDc::getSubjects($informationObject)) > 0): ?>
  <?php foreach ($dcSubjects as $dcSubject): ?>
<dc:subject><?php echo htmlspecialchars($dcSubject) ?></dc:subject>
  <?php endforeach; ?>
<?php endif; ?>
<?php if ($informationObject->getScopeAndContent()): ?>
<dc:description><?php echo htmlspecialchars(nl2br($informationObject->getScopeAndContent())) ?></dc:description>
<?php endif; ?>
<?php foreach ($informationObject->getPublishers() as $publisher): ?>
<dc:publisher><?php echo htmlspecialchars($publisher) ?></dc:publisher>
<?php endforeach; ?>
<?php foreach ($informationObject->getContributors() as $contributor): ?>
<dc:contributor><?php echo htmlspecialchars($contributor) ?></dc:contributor>
<?php endforeach; ?>
<?php foreach (QubitDc::getDates($informationObject) as $dcDate): ?>
<dc:date><?php echo htmlspecialchars($dcDate) ?></dc:date>
<?php endforeach; ?>
<?php if (count($dcTypes = QubitDc::getTypes($informationObject)) > 0): ?>
  <?php foreach ($dcTypes as $dcType): ?>
<dc:type><?php echo htmlspecialchars($dcType) ?></dc:type>
  <?php endforeach; ?>
<?php endif; ?>
<?php if (count($dcFormats = QubitDc::getFormats($informationObject)) > 0): ?>
  <?php foreach ($dcFormats as $dcFormat): ?>
<dc:format><?php echo htmlspecialchars($dcFormat) ?></dc:format>
  <?php endforeach; ?>
<?php endif; ?>
<?php if ($informationObject->getIdentifier()): ?>
<dc:identifier><?php echo htmlspecialchars(QubitDc::getIdentifier($informationObject)) ?></dc:identifier>
<?php endif; ?>
<?php if ($source = $informationObject->getLocationOfOriginals()): ?>
<dc:source><?php echo htmlspecialchars(nl2br($source)) ?></dc:source>
<?php endif; ?>
<?php if (count($languages = $informationObject->getProperties($name = 'information_object_language')) > 0): ?>
  <?php foreach ($languages as $languageCode): ?>
<dc:language><?php echo htmlspecialchars($languageCode->getValue()) ?></dc:language>
  <?php endforeach; ?>
<?php endif; ?>
<?php if ($dcRelation['text'] !== ''): ?>
<dc:relation><?php echo htmlspecialchars($dcRelation['text']) ?></dc:relation>
<?php endif; ?>
<?php if ($dcRelation['identifier']): ?>
<dc:relation><?php echo htmlspecialchars($dcRelation['identifier']) ?></dc:relation>
<?php endif; ?>
<?php foreach (QubitDc::getCoverage($informationObject, array('temporal' => true)) as $coverageTemporal): ?>
<dc:coverage><?php echo htmlspecialchars($coverageTemporal) ?></dc:coverage>
<?php endforeach; ?>
<?php foreach (QubitDc::getCoverage($informationObject, array('spatial' => true)) as $coverageSpatial): ?>
<dc:coverage><?php echo htmlspecialchars($coverageSpatial) ?></dc:coverage>
<?php endforeach; ?>
<?php if ($accessConditions = $informationObject->getAccessConditions()): ?>
<dc:rights><?php echo htmlspecialchars(nl2br($accessConditions)) ?></dc:rights>
<?php endif; ?>
<?php if ($reproductionConditions = $informationObject->getReproductionConditions()): ?>
<dc:rights><?php echo htmlspecialchars(nl2br($reproductionConditions)) ?></dc:rights>
<?php endif; ?>
