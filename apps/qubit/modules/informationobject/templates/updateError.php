<div class="pageTitle"></div>

<ul>
  <?php foreach ($sf_request->getErrors() as $error): ?>
    <li><?php echo $error ?></li>
  <?php endforeach; ?>
</ul>
