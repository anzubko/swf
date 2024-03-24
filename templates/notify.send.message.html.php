<?php require __DIR__ . '/notify.html.php' ?>

<?php $this->contents = function () { ?>
  <p><?= $this->h($this->message) ?></p>
<?php } ?>
