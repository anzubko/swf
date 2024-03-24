<?php require __DIR__ . '/regular.html.php' ?>

<?php $this->title = $this->registry->name ?>

<?php $this->contents = function () { ?>
  <p><?= $this->h($this->phrase) ?></p>
<?php } ?>
