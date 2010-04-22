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
<dc:description><?php echo htmlspecialchars($informationObject->getScopeAndContent()) ?></dc:description>
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
<dc:identifier><?php echo url_for(array('module' => 'informationobject', 'id' =>$informationObject->getId()), $absolute = true) ?></dc:identifier>
<?php if ($source = $informationObject->getLocationOfOriginals()): ?>
<dc:source><?php echo htmlspecialchars($source) ?></dc:source>
<?php endif; ?>
<?php if (count($languages = $informationObject->getProperties($name = 'information_object_language')) > 0): ?>
  <?php foreach ($languages as $languageCode): ?>
<dc:language><?php echo htmlspecialchars($languageCode->getValue()) ?></dc:language>
  <?php endforeach; ?>
<?php endif; ?>
<?php if ($informationObject->getRepository()): ?>
<dc:relation><?php echo htmlspecialchars($informationObject->getRepository()) ?></dc:relation>
<dc:relation><?php echo url_for(array('module' => 'repository', 'id' => $informationObject->getRepository()->id), $absolute = true) ?></dc:relation>
<?php endif; ?>
<?php foreach (QubitDc::getCoverage($informationObject, array('spatial' => true)) as $coverageSpatial): ?>
<dc:coverage><?php echo htmlspecialchars($coverageSpatial) ?></dc:coverage>
<?php endforeach; ?>
<?php if ($accessConditions = $informationObject->getAccessConditions()): ?>
<dc:rights><?php echo htmlspecialchars($accessConditions) ?></dc:rights>
<?php endif; ?>
<?php if ($reproductionConditions = $informationObject->getReproductionConditions()): ?>
<dc:rights><?php echo htmlspecialchars($reproductionConditions) ?></dc:rights>
<?php endif; ?>
