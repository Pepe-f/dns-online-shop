<?php

use dns\View;
/** @var $this View */
?>
<?php $this->getPart('parts/header'); ?>

<?= $this->content ?>

<?php $this->getPart('parts/footer'); ?>
