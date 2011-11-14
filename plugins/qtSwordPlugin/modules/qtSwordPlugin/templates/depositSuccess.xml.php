<?php use_helper('Date') ?>
<?php echo '<?xml version="1.0" encoding="'.sfConfig::get('sf_charset', 'UTF-8').'" ?>' ?>
<entry xmlns="http://www.w3.org/2005/Atom"
       xmlns:sword="http://purl.org/net/sword/">

  <title><?php echo render_title($informationObject) ?></title>

  <!-- id / date -->
  <id><?php echo $informationObject->id.' / ' . format_date($informationObject->createdAt, 's') ?></id>

  <updated><?php echo format_date($informationObject->createdAt, 's') ?></updated>

  <author>
    <name><?php echo $user->user ?></name>
  </author>

  <?php
    /*
      TODO. See X-On-Behalf-Of [2] and medation
      <contributor><name><?php echo $.. ?></name></contributor>

      <category>...<category>

      <content type="application/zip" src="../foobar.zip"/>

      <summary type="text">...</summary>

      <sword:treatment>Treatment description</sword:treatment>

      <link rel="edit-media" href="http://foobar" />
    */
  ?>

  <generator uri="<?php echo url_for('@homepage', true) ?>" version="<?php echo qubitConfiguration::VERSION ?>">Qubit <?php echo qubitConfiguration::VERSION ?></generator>

  <link rel="edit" href="<?php echo url_for(array($informationObject, 'module' => 'informationobject'), true) ?>" />

  <sword:noOp>false</sword:noOp>

  <sword:packaging><?php echo $packageFormat ?></sword:packaging>

  <sword:userAgent><?php echo $_SERVER['HTTP_USER_AGENT'] ?></sword:userAgent>

</entry>
