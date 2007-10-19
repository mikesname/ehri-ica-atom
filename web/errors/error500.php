<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="title" content="qubit 500 error page" />

<link rel="shortcut icon" href="/favicon.ico" />

<!--[if lt IE 7.]>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/ie.css" />
<![endif]-->

</head>
<body style="background-color: #ffffff;">

<img src="../images/qubit-logo-medium.gif"><br />

<hr />

<h1>Sorry, there was an internal server error.</h1>
<p>
<a href="javascript:history.go(-1)">Go back a page</a><br />
<a href="/">Visit the home page</a>
</p>
<p><em>500 Error : internal server error</em></p>

<hr />
<h1>Apesadumbrado, habìa un error interno del servidor.</h1>
<p>
<a href="javascript:history.go(-1)">Va detrás una página</a><br />
<a href="/">Visitar el Home Page</a>
</p>
<p><em>Error 500: error interno del servidor</em></p>

<hr />
<h1>Désolé, il y avait une erreur interne de serveur.</h1>
<p>
<a href="javascript:history.go(-1)">Disparaissent en arrière une page</a><br />
<a href="/">Visiter la page d'accueil</a>
</p>
<p><em>Erreur 500 : erreur interne de serveur</em>

<hr />
<h1>Verontschuldigingen, er was een interne serverfout.</h1>
<p>
<a href="javascript:history.go(-1)">Ga een pagina terug</a><br />
<a href="/">Bezoek de homepage</a>
</p>
<p><em>500 Fout: interne serverfout</em>



</body>
</html>
