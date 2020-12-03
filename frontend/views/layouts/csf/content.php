<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>

<div >
<!-- Main content -->
<section class="content">
  <?= Alert::widget() ?>
  <?= $content ?>
</section>
<!-- /.content -->
</div>