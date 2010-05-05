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
<?php foreach (QubitDc::getDates($informationObject, array('export' => true)) as $dcDate): ?>
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
<dc:identifier><?php echo url_for(array('module' => 'informationobject', 'id' =>$informationObject->getId()), $absolute = true) ?></dc:identifier>
<dc:identifier><?php echo htmlspecialchars($informationObject->identifier) ?></dc:identifier>
<?php endif; ?>
<?php if ($source = $informationObject->getLocationOfOriginals()): ?>
<dc:source><?php echo htmlspecialchars($source) ?></dc:source>
<?php endif; ?>
<?php foreach ($informationObject->language as $code): ?>
<dc:language><?php echo format_language($code) ?></dc:language>
<?php endforeach; ?>
<?php if ($informationObject->getRepository()): ?>
<dc:relation><?php echo url_for(array('module' => 'repository', 'id' => $informationObject->getRepository()->id), $absolute = true) ?></dc:relation>
<dc:relation><?php echo htmlspecialchars($informationObject->getRepository()) ?></dc:relation>
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
